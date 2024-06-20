<?php
// Include the Database class file
include("Database.php");

session_start();

$loginAttempted = false;
$passwordMatch = false;
$username = '';
$password = '';

// Create an instance of the Database class
$database = new Database();
$conn = $database->connect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the SQL query
    $stmt = $conn->prepare('SELECT * FROM taikhoan WHERE ten_tk = ? and pass_tk = ?');
    $stmt->execute([$username, $password]);
    $user = $stmt->fetch();

    $loginAttempted = true;
   

    if ($user) {
        
        $_SESSION['taikhoan'] = $user['ten_tk'];
        $_SESSION['ma_tk'] = $user['ma_tk'];
        $_SESSION['success_message'] = 'Đăng nhập thành công!';

        if (isset($_SESSION['success_message'])) {
            echo '<script>alert("' . $_SESSION['success_message'] . '");</script>';
        }
        if (substr($user['ma_tk'], 0, 2) == "KH") {
            header('Location: index.php');
        } else {
            header('Location: Admin.php');
        }
    } else {
        $_SESSION['success_message'] = 'Đăng nhập thất bại';

        echo '<script>alert("' . $_SESSION['success_message'] . '");</script>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Đăng nhập tài khoản</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        .container {
            max-width: 500px;
            margin: 100px auto;
            /* Điều chỉnh kích thước của phần khung này */
            padding: 20px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            background-color: var(--bs-white);
        }

        .container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: var(--bs-primary);
        }

        .container form {
            display: flex;
            flex-direction: column;
        }

        .container label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        .container input {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid var(--bs-secondary);
            border-radius: 5px;
        }

        .container button {
            padding: 10px;
            background-color: var(--bs-primary);
            color: var(--bs-white);
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.5s;
        }

        .container button:hover {
            background-color: var(--bs-secondary);
        }

        .container label[for="tk"],
        .container input#tk,
        .container label[for="pass"],
        .container input#pass,
        .container button[type="submit"] {
            display: block;
        }

        /* Hide Navbar */
        .container-fluid.fixed-top.hide {
            display: none;
        }
    </style>
</head>

<body>
    <!-- Navbar Start -->
    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a href="index.php" class="navbar-brand">
                <h1 class="text-primary display-6">Flowers.</h1>
            </a>
            <button id="navbar-toggle" class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="shop_us.php" class="nav-item nav-link">Cửa Hàng</a>
                    <a href="contact.php" class="nav-item nav-link">Liên hệ</a>
                </div>
                <div class="d-flex m-3 me-0">
                    <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search text-primary"></i></button>
                    <a href="login.php" class="my-auto">
                        <i class="fas fa-user fa-2x"></i>
                    </a>
                </div>
            </div>
        </nav>
    </div>

    <!--</div>-->
    <!-- Navbar End -->
    <div class="container" id="registration-container">
        <h2>Đăng nhập tài khoản</h2>
        <form action="login.php" method="POST">
            <div class="input">
                <label for="username">Tài khoản</label>
                <input type="text" id="username" name="username" placeholder="Nhập tài khoản của bạn" required>
            </div>
            <div class="input">
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" placeholder="Nhập mật khẩu của bạn" required>
            </div>
            <div class="button">
                <button type="submit">Đăng nhập</button>
            </div>
        </form>
        <div class="text">
            <span>Bạn quên mật khẩu? <a href="repassword.php">Lấy lại mật khẩu</a></span>
        </div>
        <div class="text">
            <span>Nếu bạn chưa có tài khoản. Hãy bấm <a href="Dangky.php">Đăng ký ngay</a></span>
        </div>
    </div>

</body>

</html>