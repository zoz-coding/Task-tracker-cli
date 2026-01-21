<?php

	require_once "task.php";

	class TaskManager {
		private $data_base;
		
		public function __construct() {
			$this->data_base = __DIR__ . "/../data.json";
		}
		
		// this function will output our tasks //
		private function load_tasks() {
			// check if the json file is exist //
			if(!file_exists($this->data_base)) {
				return [];
			}
			$json_contents = file_get_contents($this->data_base);
			$tasks_list = json_decode($json_contents, true) ?: [];
			
			return $tasks_list;
		}
		
		private function save_tasks($tasks) {
			$json_content = json_encode($tasks, JSON_PRETTY_PRINT);
			// save the tasks in the json file //
			file_put_contents($this->data_base, json_encode(array_values($tasks), JSON_PRETTY_PRINT));
		}
		
		public function add_task($name, $description = "") {
			if($name == "") {
				echo "Error: the task name is empty\n";
			}
			
			$tasks = $this->load_tasks();
			
			// Generate the task id //
			$current_ids = array_column($tasks, "id");
			$new_id = count($current_ids) > 0 ? max($current_ids) + 1 : 1;
			
			$new_task = new Task($new_id, $name, $status = "Todo", $description, $createdAt = date("Y-m_d H:i:s"), $doneAt = null);
			
			// add new task to tasks list //
			$tasks[] = $new_task;
			
			$this->save_tasks($tasks);
			echo "Added successfully\n";
		}
		
		public function update_task($id, $new_name) {
			$tasks = $this->load_tasks();
			$task_found = false;
			
			foreach($tasks as &$task) {
				if($task["id"] == $id) {
					$task["name"] = $new_name;
					$task_found = true;
					break;
				}
			}
			
			if($task_found === true) {
				$this->save_tasks($tasks);
				echo "Task has been updated\n";
			} else {
				echo "Error: task is not found\n";
			}
		}
		
		public function delete_task($id) {
        $tasks = $this->load_tasks();
        $initial_count = count($tasks);

        // Keep all tasks EXCEPT the one with the matching ID
        $tasks = array_filter($tasks, function($task) use ($id) {
            return $task["id"] != $id;
        });

      if (count($tasks) < $initial_count) {
        // array_values resets the keys from [0, 2, 3] to [0, 1, 2]
        $this->save_tasks(array_values($tasks));
        echo "Task #$id deleted successfully.\n";
      } else {
        echo "Error: Task with ID $id not found.\n";
      }
    }
		
		public function mark($id, $status) {
      $tasks = $this->load_tasks();
      foreach ($tasks as &$t) {
				if ($t['id'] == $id) {
          $t['status'] = $status;
          if ($status === 'done') $t['doneAt'] = date("Y-m-d H:i:s");
						$this->save_tasks($tasks);
            echo "Task #$id marked as $status.\n";
            return;
        }
      }
      echo "Error: Task not found.\n";
    }

    public function list_tasks() {
			$tasks = $this->load_tasks();
      if (empty($tasks)) {
        echo "No tasks found.\n";
        return;
      }
      printf("%-3s | %-15s | %-12s | %-15s\n", "ID", "Name", "Status", "Created At");
      echo str_repeat("-", 55) . "\n";
      foreach ($tasks as $t) {
        printf("%-3d | %-15s | %-12s | %-15s\n", $t['id'], substr($t['name'], 0, 15), $t['status'], $t['createdAt']);
      }
		}
	}

?>