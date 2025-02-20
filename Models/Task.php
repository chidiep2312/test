<?php
require_once __DIR__ . '/../database.php';


class Task {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllTasks($user_id) {
        $stmt = $this->conn->prepare("SELECT * FROM tasks WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function addTask($user_id, $task) {
        $stmt = $this->conn->prepare("INSERT INTO tasks (user_id, task) VALUES (?, ?)");
        $stmt->bind_param("is", $user_id, $task);
        return $stmt->execute();
    }

    public function deleteTask($task_id, $user_id) {
        $stmt = $this->conn->prepare("DELETE FROM tasks WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ii", $task_id, $user_id);
        return $stmt->execute();
    }
}
?>
