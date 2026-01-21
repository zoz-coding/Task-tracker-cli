<?php

	// Inside main.php
	require_once "./classes/task_manager.php";

	function execute($argv) {
			$task_manager = new TaskManager();
			
			$command = $argv[1] ?? null;
			
			// check if commmand is null //
			if(!$command) {
				echo "Error\n";
				return;
			}
			
			switch($command) {
				case "add":
					$name = $argv[2] ?? "";
					$description = "";
					
					// Check if user provided the --description flag //
					if(isset($argv[3]) && $argv[3] === "--description") {
						$description = $argv[4] ?? "";
					}
					
					$task_manager->add_task($name, $description);
					break;
				case "update":
					$id = $argv[2] ?? null;
					$new_name = $argv[3] ?? "";
					
					// check if one of id or task name is null //
					if(!$id || !$new_name) {
						echo "Error: Update required data\n";
					} else {
						$task_manager->update_task($id, $new_name);
					}
					break;
				case "delete":
					$id = $argv[2] ?? null;
					
					if(!$id) {
						echo "Error: Delete required data\n";
					} else {
						$task_manager->delete_task($id);
					}
					break;
				case "mark-done":
					$task_manager->mark($argv[2] ?? 0, "done");
				case "list":
					$task_manager->list_tasks();
					break;
				
				default:
					echo "Error: Unknown command\n";
					break;
			}
		}

	execute($argv);

?>