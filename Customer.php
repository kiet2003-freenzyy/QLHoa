<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Flowers-Website_Customer</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet">

     <!-- Icon Font Stylesheet -->
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <?php
    
    include("Database.php");
    $database = new Database();
    $pdo = $database->connect();
    session_start();
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

    $ma_kh = $ten_kh = $dia_chi = $dien_thoai = $email = $gioitinh = "";
    $isEditing = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['btn_Save'])) {
            $ma_kh = generate_ma_kh($pdo);
            $ten_kh = $_POST['ten_kh'];
            $dia_chi = $_POST['diachi_kh'];
            $gioitinh = $_POST['gioitinh_kh'];
            $dien_thoai = $_POST['sdt_kh'];
            $email = $_POST['email_kh'];
            $sql1 = "INSERT INTO Ds_kh(ma_kh, ten_kh, diachi_kh, gioitinh_kh, sdt_kh, email_kh) 
                     VALUES (:ma_kh, :ten_kh, :dia_chi, :gioitinh, :dien_thoai, :email)";
            $stmt = $pdo->prepare($sql1);
            $stmt->execute([
                ':ma_kh' => $ma_kh,
                ':ten_kh' => $ten_kh,
                ':dia_chi' => $dia_chi,
                ':gioitinh' => $gioitinh,
                ':dien_thoai' => $dien_thoai,
                ':email' => $email
            ]);
        } elseif (isset($_POST['btn_Update'])) {
            $ma_kh = $_POST['ma_kh'];
            $ten_kh = $_POST['ten_kh'];
            $dia_chi = $_POST['diachi_kh'];
            $gioitinh = $_POST['gioitinh_kh'];
            $dien_thoai = $_POST['sdt_kh'];
            $email = $_POST['email_kh'];
            $sql1 = "UPDATE Ds_kh SET ten_kh=:ten_kh, diachi_kh=:dia_chi, gioitinh_kh=:gioitinh, sdt_kh=:dien_thoai, email_kh=:email 
                     WHERE ma_kh=:ma_kh";
            $stmt = $pdo->prepare($sql1);
            $stmt->execute([
                ':ma_kh' => $ma_kh,
                ':ten_kh' => $ten_kh,
                ':dia_chi' => $dia_chi,
                ':gioitinh' => $gioitinh,
                ':dien_thoai' => $dien_thoai,
                ':email' => $email
            ]);
        }
    }

    if (isset($_GET['edit_id'])) {
        $ma_kh = $_GET['edit_id'];
        $sql = "SELECT * FROM Ds_kh WHERE ma_kh = :ma_kh";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':ma_kh' => $ma_kh]);
        $kh = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($kh) {
            $ten_kh = $kh['ten_kh'];
            $dia_chi = $kh['diachi_kh'];
            $gioitinh = $kh['gioitinh_kh'];
            $dien_thoai = $kh['sdt_kh'];
            $email = $kh['email_kh'];
            $isEditing = true;
        }
    }

    if (isset($_GET['add_new'])) {
        $ma_kh = $ten_kh = $dia_chi = $dien_thoai = $email = "";
        $isEditing = false;
    }

    if (isset($_GET['delete_id'])) {
        $ma_kh = $_GET['delete_id'];
        $sql = "DELETE FROM Ds_kh WHERE ma_kh = :ma_kh";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':ma_kh' => $ma_kh]);
    }
    ?>
     <?php 
        include 'header_ad.php'
    ?>

    <!-- Customer Form and List -->
    <div class="container center py-5" style="margin-top: 6%;"  id="registration-container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="bg-primary p-5">
                    <form method="post" action="">
                        <div class="row g-3">
                            <div class="col-12">
                                <input type="text" class="form-control bg-light border-0" placeholder="Tên khách hàng" name="ten_kh" value="<?php echo htmlspecialchars($ten_kh); ?>">
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control bg-light border-0" placeholder="Địa chỉ" name="diachi_kh" value="<?php echo htmlspecialchars($dia_chi); ?>">
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control bg-light border-0" placeholder="Số điện thoại" name="sdt_kh" value="<?php echo htmlspecialchars($dien_thoai); ?>">
                            </div>
                            <div class="col-12">
                                <input type="email" class="form-control bg-light border-0" placeholder="Email" name="email_kh" value="<?php echo htmlspecialchars($email); ?>">
                            </div>
                            <div class="col-12">
                                <label for="gioitinh_kh" class="form-label text-light">Giới tính:</label>
                                <select id="gioitinh_kh" class="form-select bg-light border-0" name="gioitinh_kh">
                                    <option value="Nam" <?php if ($gioitinh == 'Nam') echo 'selected'; ?>>Nam</option>
                                    <option value="Nữ" <?php if ($gioitinh == 'Nữ') echo 'selected'; ?>>Nữ</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <?php if ($isEditing): ?>
                                    <input type="hidden" name="ma_kh" value="<?php echo htmlspecialchars($ma_kh); ?>">
                                    <button class="btn btn-secondary w-100 py-3" type="submit" name="btn_Update">Cập nhật khách hàng</button>
                                <?php else: ?>
                                    <button class="btn btn-secondary w-100 py-3" type="submit" name="btn_Save">Lưu khách hàng</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Displaying customers -->
            <div class="col-lg-12 col-md-12 mt-4">
                <h2 class="text-center">Danh sách khách hàng</h2>
                <div class="bg-primary p-5">
                <table class="table table-hover text-light">
                            <thead>
                                <tr>
                                    <th>Mã KH</th>
                                    <th>Tên KH</th>
                                    <th>Địa chỉ</th>
                                    <th>Giới tính</th>
                                    <th>SĐT</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql3 = "SELECT * FROM ds_kh";
                                $stmt = $pdo->query($sql3);
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row['ma_kh']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['ten_kh']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['diachi_kh']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['gioitinh_kh']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['sdt_kh']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['email_kh']) . "</td>";
                                    echo "<td>";
                                    echo "<a href='Customer.php?edit_id=" . htmlspecialchars($row['ma_kh']) . "' class='btn btn-light btn-sm'><i class='fa-solid fa-user-pen'></i></a> ";
                                    echo "<a href='Customer.php?delete_id=" . htmlspecialchars($row['ma_kh']) . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Chắc chắn muốn xoá khách hàng này?');\"><i class='fa-solid fa-trash-can'></i></a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    <a href="?add_new=1" class="btn btn-secondary w-100 py-3">Thêm khách hàng mới</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Customer Form and List -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-secondary py-3 fs-4 back-to-top"><i class="fas fa-arrow-up"></i></a>

      <!-- JavaScript Libraries -->
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Lấy phần tử dropdown menu và button dropdown
            var dropdownMenu = document.getElementById("productDropdownMenu");
            var dropdownButton = document.getElementById("productDropdown");

            // Sự kiện click vào button dropdown
            dropdownButton.addEventListener("click", function() {
                // Kiểm tra nếu dropdown menu đang ẩn, thì hiển thị và ngược lại
                if (dropdownMenu.classList.contains("show")) {
                    dropdownMenu.classList.remove("show");
                } else {
                    dropdownMenu.classList.add("show");
                }
            });
        });
    </script>
</body>

</html>
