<?php

	class Task {
		public $id;
		public $name;
		public $status;
		public $description;
		public $createdAt;
		public $doneAt;
		
		public function __construct($id, $name, $status, $description, $createdAt, $doneAt) {
			$this->id = $id;
			$this->name = $name;
			$this->status = $status;
			$this->description = $description;
			$this->createdAt = date("Y-m-d H:i:s");
			$this->doneAt = $doneAt;
		}
	}

?>