<?php
require_once __DIR__ . '/../Models/User.php';

class UserController {
    public function register() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            //kiểm tra dữ liệu đầu vào
            

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                die("Email không hợp lệ!");
            }

            if ($password !== $confirm_password) {
                die("Mật khẩu nhập lại không khớp!");
            }

            if (strlen($password) < 6) {
                die("Mật khẩu phải có ít nhất 6 ký tự!");
            }

            // đăng ký cho người dùngdùng
            $user = new User();
            $result = $user->register($username, $email, $password);

            if ($result === true) {
                header("Location: login.php"); // đăng ký thành công chuyển hướng sang đăng nhậpnhập
                exit();
            } else {
                die($result);
            }
        }
    }

    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];
            $password = $_POST['password'];
    
            // Kiểm tra nếu bỏ trống email hoặc mật khẩu
            if (empty($email) || empty($password)) {
                return "Vui lòng nhập đầy đủ thông tin!";
            }
    
            $user = new User();
            $loggInUser = $user->login($email, $password);
    
            if ($loggInUser) {
                session_start();
                $_SESSION['user_id'] = $loggInUser['id'];
                $_SESSION['username'] = $loggInUser['username'];
                $_SESSION['email'] = $email;
                header("Location: user.php");
                exit();
            } else {
                return "Sai email hoặc mật khẩu!";
            }
        }
        return null;
    }
    public function changeInfor() {
     
        if (!isset($_SESSION['user_id'])) {
            header("Location: login.php");
            exit();
        }
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user_id = $_SESSION['user_id'];
            $new_username = trim($_POST['username']);
    
            if (empty($new_username)) {
                die("Tên người dùng không được để trống!");
            }
    
            $user = new User();
            $result = $user->change_infor($user_id, $new_username);
    
            if ($result === true) {
                $_SESSION['username'] = $new_username; 
                header("Location: user.php");
                exit();
            } else {
                die($result);
            }
        }
    }
    
}
  

?>
