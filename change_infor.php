
<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
// Lấy thông tin từ session
$user_id = $_SESSION['user_id'] ?? "Chưa có ID";
$username = $_SESSION['username'] ?? "Chưa có tên";
$email = $_SESSION['email'] ?? "Chưa có email";


?>

<?php
require_once 'Controllers/UserController.php';

$user = new UserController();
$user->changeInfor();

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa thông tin</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Chỉnh sửa thông tin cá nhân</h2>
        <form action="change_infor.php" method="POST">
            
            <label for="username">Tên người dùng:</label>
            <input type="text" id="username" name="username" value="<?php echo $username; ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>" readonly>
            <button type="submit">Lưu</button>
        </form>
        <a href="user.php" >Quay lại trang cá nhân</a>
    </div>
</body>
</html>