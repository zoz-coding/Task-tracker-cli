# Task-tracker-cli
Task tracker that working in CLI (Command line interface) made by using php programming language

<a>https://roadmap.sh/projects/task-tracker</a>

```bash
# Adding a new task
php task-cli.php add "Buy groceries"
# Output: Task added successfully (ID: 1)

# Updating and deleting tasks
php task-cli.php update 1 "Buy groceries and cook dinner"
php task-cli.php delete 1

# Marking a task as in progress or done
php task-cli.php mark-in-progress 1
php task-cli.php mark-done 1

# Listing all tasks
php task-cli.php list

```
