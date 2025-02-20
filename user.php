

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

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin người dùng</title>
</head>
<body>
    <h2>Thông tin cá nhân</h2>
    <p><strong>ID:</strong> <?php echo $user_id; ?></p>
    <p><strong>Tên:</strong> <?php echo $username; ?></p>
    <p><strong>Email:</strong> <?php echo $email; ?></p>
    <a href="change_infor.php">Thay đổi thông tin</a>
    <a href="todolist.php">To do list</a>
</body>
</html>
