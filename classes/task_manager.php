<?php

	require "task.php";

	class TaskManager {
		private $data_base = "data.json";
		
		// this function will output our tasks //
		private function load_tasks() {
			// check if the json file is exist //
			if(!file_exists($this->data_base)) {
				return [];
			}
			$json_contents = file_get_contents($this->data_base);
			return json_decode($json_contents, true) ?: [];
		}
		
		private function save_tasks($tasks) {
			$json_content = json_encode($tasks, JSON_PRETTY_PRINT);
			// save the tasks in the json file //
			file_put_contents($this->data_base, $json_contents);
		}
		
		public function add_task($name) {
			if($name != "") {
				
			}
		}
	}

?>