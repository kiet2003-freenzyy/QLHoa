<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("Database.php");
$database = new Database();
$pdo = $database->connect();
function generate_ma_kh($pdo)
{
    $sql2 = "SELECT MAX(ma_kh) AS max_ma_kh FROM ds_kh";
    $stmt = $pdo->query($sql2);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $max_ma_kh = $row['max_ma_kh'];
    $last_id = intval(substr($max_ma_kh, 2));
    $new_id = $last_id + 1;
    return "KH" . str_pad($new_id, 3, "0", STR_PAD_LEFT);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ma_kh = generate_ma_kh($pdo);
    $ten_kh = $_POST['ten_kh'];
    $dia_chi = $_POST['diachi_kh'];
    $dien_thoai = $_POST['sdt_kh'];
    $email = $_POST['email_kh'];
    $gioitinh_kh = $_POST['gioitinh_kh'];
    $tk = $_POST["tk"];
    $pass = $_POST["pass"];


    $sql_check = "SELECT * FROM ds_kh WHERE sdt_kh = :sdt_kh OR email_kh = :email_kh";
    $stmt_check = $pdo->prepare($sql_check);
    $stmt_check->execute([
        ':sdt_kh' => $dien_thoai,
        ':email_kh' => $email,
    ]);

    if ($stmt_check->rowCount() > 0) {
        $message = "Số điện thoại, email đã được đăng ký!";
        $message_class = "error";
    } else {
        $sql_check = "SELECT * FROM taikhoan WHERE ten_tk = :ten_tk";
        $stmt_check = $pdo->prepare($sql_check);
        $stmt_check->execute([
            ':ten_tk' => $tk,
        ]);
        if ($stmt_check->rowCount() > 0) {
            $message = "Tên tài khoản đã được đăng ký!";
            $message_class = "error";
        } else {
            $sql1 = "INSERT INTO ds_kh(ma_kh, ten_kh, diachi_kh, sdt_kh, email_kh, gioitinh_kh) VALUES (:ma_kh, :ten_kh, :dia_chi, :dien_thoai, :email, :gioitinh_kh)";
            $stmt = $pdo->prepare($sql1);
            $stmt->execute([
                ':ma_kh' => $ma_kh,
                ':ten_kh' => $ten_kh,
                ':dia_chi' => $dia_chi,
                ':dien_thoai' => $dien_thoai,
                ':email' => $email,
                ':gioitinh_kh' => $gioitinh_kh,
            ]);

            $sql_tk = "INSERT INTO taikhoan (ten_tk, pass_tk, ma_tk) VALUES (:tk, :pass, :ma_tk)";
            $stmt_tk = $pdo->prepare($sql_tk);
            $stmt_tk->execute([
                ':tk' => $tk,
                ':pass' => $pass,
                ':ma_tk' => $ma_kh
            ]);

            $message = "Đăng ký thành công!";
            $message_class = "success";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Đăng kí tài khoản</title>
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
    <!--<div class="container-fluid fixed-top">-->
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

    <!-- Registration Form -->
    <div class="container" id="registration-container">
        <h2>Đăng ký tài khoản</h2>
        <?php if (isset($message)) : ?>
            <div class="color: red; <?php echo $message_class; ?>"><?php echo $message; ?></div>
        <?php endif; ?>
        <form action="Dangky.php" method="post">
            <label for="ten_kh">Họ và tên</label>
            <input type="text" id="ten_kh" name="ten_kh" required>

            <label for="diachi_kh">Địa chỉ</label>
            <input type="text" id="diachi_kh" name="diachi_kh" required>

            <label for="sdt_kh">Số điện thoại</label>
            <input type="tel" id="sdt_kh" name="sdt_kh" required>

            <label for="email_kh">Email</label>
            <input type="email" id="email_kh" name="email_kh" required>

            <label for="gioitinh_kh">Giới tính:</label>
            <select id="gioitinh_kh" class="form-select border-0" name="gioitinh_kh">
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
            </select>

            <label for="tk">Tên tài khoản</label>
            <input type="text" id="tk" name="tk" required>

            <label for="pass">Mật khẩu</label>
            <input type="password" id="pass" name="pass" required>

            <button type="submit">Đăng ký</button>
        </form>
    </div>
    <!-- Registration Form End -->

    <!-- Back to Top Button -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap."></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('navbar-toggle').addEventListener('click', function() {
                var navbar = document.querySelector('.container-fluid.fixed-top');
                var isHidden = navbar.classList.contains('hide');
                if (isHidden) {
                    navbar.classList.remove('hide');
                } else {
                    navbar.classList.add('hide');

                }
            });
        });
    </script>
    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>