<?php
// Include the Database class file if needed
include("Database.php");

// Start session
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the phone number from the form
    $phone = $_POST['phone'];

    // Generate a random verification code (you may need to adjust the length as needed)
    $verificationCode = mt_rand(100000, 999999);

    // Save the verification code in session or database
    $_SESSION['verification_code'] = $verificationCode;

    // TODO: Send the verification code to the phone number using an SMS service or API

    // Redirect to the page where users enter the verification code
    header('Location: enter_verification_code.php');
    exit();
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
        <h2>Enter your phone number to receive a verification code</h2>
    <form method="post">
        <label for="phone">Phone Number:</label>
        <input type="text" id="phone" name="phone" required>
        <button type="submit">Send Verification Code</button>
    </form>
    </div>
    

    <!--</div>-->
    <!-- Navbar End -->
</body>
</html>
