<?php
require_once __DIR__ . '/../database.php';

class User {
    private $conn;

    public function __construct() {
        $database= new Database('localhost', 'test', 'root', 'PassWord123');
        $this->conn = $database->getConn();
    }

    public function checkEmailExists($email) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->rowCount() > 0;
    }

    public function register($username, $email, $password) {
        if ($this->checkEmailExists($email)) {
            return "Email đã tồn tại!";
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");

        if ($stmt->execute([$username, $email, $hashed_password])) {
            return true;
        } else {
            return "Đăng ký thất bại!";
        }
    }

    public function login($email, $password) {
        $stmt = $this->conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user; // Trả về thông tin người dùng nếu đăng nhập thành công
        } else {
            return false; // Đăng nhập thất bại
        }
    }
    public function change_infor($user_id, $new_username) {
        $stmt = $this->conn->prepare("UPDATE users SET username = ? WHERE id = ?");
        if ($stmt->execute([$new_username, $user_id])) {
            return true;
        } else {
            return "Cập nhật thất bại!";
        }
    }
}
?>
