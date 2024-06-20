<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="utf-8">
        <title>Layout</title>
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
        <style>
            .fixed-size {
            width: 200px; /* Chiều rộng cố định */
            height: 200px; /* Chiều cao cố định */
            object-fit: cover; /* Giữ tỉ lệ ảnh */
            }
        </style>
    

    </head>

<body>
    <?php
    
    include("Database.php");
    $database = new Database();
    $pdo = $database->connect();

    function generate_ma_nv($pdo) {
        $sql2 = "SELECT MAX(ma_nv) AS max_ma_nv FROM Ds_nv";
        $stmt = $pdo->query($sql2);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $max_ma_nv = $row['max_ma_nv'];
        $last_id = intval(substr($max_ma_nv, 2));
        $new_id = $last_id + 1;
        return "NV" . str_pad($new_id, 3, "0", STR_PAD_LEFT);
    }
    
    $ma_nv = $ten_nv = $ngay_sinh = $dia_chi = $chuc_vu = $dien_thoai = $gioitinh = "";
    $isEditing = false;
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['btn_Save'])) {
            $ma_nv = generate_ma_nv($pdo);
            $ten_nv = $_POST['ten_nv'];
            $ngay_sinh = $_POST['ngaysinh'];
            $dia_chi = $_POST['diachi_nv'];
            $gioitinh=$_POST['gioitinh_nv'];
            $chuc_vu = $_POST['chuc_vu'];
            $dien_thoai = $_POST['sdt_nv'];
            $sql1 = "INSERT INTO Ds_nv(ma_nv, ten_nv, ngaysinh, diachi_nv, gioitinh_nv, chuc_vu, sdt_nv)
                    VALUES (:ma_nv, :ten_nv, :ngay_sinh, :dia_chi, :gioitinh_nv, :chuc_vu, :dien_thoai)";
            $stmt = $pdo->prepare($sql1);
            $stmt->execute([
                ':ma_nv' => $ma_nv,
                ':ten_nv' => $ten_nv,
                ':ngay_sinh' => $ngay_sinh,
                ':dia_chi' => $dia_chi,
                'gioitinh_nv'=> $gioitinh,
                ':chuc_vu' => $chuc_vu,
                ':dien_thoai' => $dien_thoai
            ]);
        } elseif (isset($_POST['btn_Update'])) {
            $ma_nv = $_POST['ma_nv'];
            $ten_nv = $_POST['ten_nv'];
            $ngay_sinh = $_POST['ngaysinh'];
            $dia_chi = $_POST['diachi_nv'];
            $gioitinh=$_POST['gioitinh_nv'];
            $chuc_vu = $_POST['chuc_vu'];
            $dien_thoai = $_POST['sdt_nv'];
            $sql1 = "UPDATE Ds_nv SET ten_nv=:ten_nv, ngaysinh=:ngay_sinh, diachi_nv=:dia_chi, gioitinh_nv=:gioitinh, chuc_vu=:chuc_vu, sdt_nv=:dien_thoai WHERE ma_nv=:ma_nv";
            $stmt = $pdo->prepare($sql1);
            $stmt->execute([
                ':ma_nv' => $ma_nv,
                ':ten_nv' => $ten_nv,
                ':ngay_sinh' => $ngay_sinh,
                ':dia_chi' => $dia_chi,
                ':gioitinh'=>$gioitinh,
                ':chuc_vu' => $chuc_vu,
                ':dien_thoai' => $dien_thoai
            ]);
        }
    }
        //Sửa 1 nhân viên
    if (isset($_GET['edit_id'])) {
        $ma_nv = $_GET['edit_id'];
        $sql = "SELECT * FROM Ds_nv WHERE ma_nv = :ma_nv";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':ma_nv' => $ma_nv]);
        $nv = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($nv) {
            $ten_nv = $nv['ten_nv'];
            $ngay_sinh = $nv['ngaysinh'];
            $gioitinh=$nv['gioitinh_nv'];
            $dia_chi = $nv['diachi_nv'];
            $chuc_vu = $nv['chuc_vu'];
            $dien_thoai = $nv['sdt_nv'];
            $isEditing = true;
        }
    }
        
        //Làm mới để thêm nhân viên
    if (isset($_GET['add_new'])) {
        $ma_nv = $ten_nv = $ngay_sinh = $gioitinh = $dia_chi = $chuc_vu = $dien_thoai = $email = "";
        $isEditing = false;
    }	
        //Xóa 1 nhân viên	
        if (isset($_GET['delete_id'])) {
        $ma_nv = $_GET['delete_id'];
        $sql = "DELETE FROM Ds_nv WHERE ma_nv = :ma_nv";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':ma_nv' => $ma_nv]);
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
                                <input type="text" class="form-control bg-light border-0" placeholder="Tên nhân viên" name="ten_nv" value="<?php echo htmlspecialchars($ten_nv); ?>">
                            </div>
                            <div class="col-12">
                                <input type="date" class="form-control bg-light border-0" placeholder="Ngày sinh" name="ngaysinh" value="<?php echo htmlspecialchars($ngay_sinh); ?>">
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control bg-light border-0" placeholder="Địa chỉ" name="diachi_nv" value="<?php echo htmlspecialchars($dia_chi); ?>">
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control bg-light border-0" placeholder="Số điện thoại" name="sdt_nv" value="<?php echo htmlspecialchars($dien_thoai); ?>">
                            </div>
                           
                            <div class="col-12">
                                <label for="gioitinh_nv" class="form-label text-light">Giới tính:</label>
                                <select id="gioitinh_nv" class="form-select bg-light border-0" name="gioitinh_nv">
                                    <option value="Nam" <?php if ($gioitinh == 'Nam') echo 'selected'; ?>>Nam</option>
                                    <option value="Nữ" <?php if ($gioitinh == 'Nữ') echo 'selected'; ?>>Nữ</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="chuc_vu" class="form-label text-light">Chức vụ:</label>
                                <select id="chuc_vu" class="form-select bg-light border-0" name="chuc_vu">
                                    <option value="Nhân viên" <?php if ($chuc_vu == 'Nhân viên') echo 'selected'; ?>>Nhân viên</option>
                                    <option value="Shipper" <?php if ($chuc_vu == 'Shipper') echo 'selected'; ?>>Shipper</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <?php if ($isEditing): ?>
                                    <input type="hidden" name="ma_nv" value="<?php echo htmlspecialchars($ma_nv); ?>">
                                    <button class="btn btn-secondary w-100 py-3" type="submit" name="btn_Update">Cập nhật nhân viên</button>
                                <?php else: ?>
                                    <button class="btn btn-secondary w-100 py-3" type="submit" name="btn_Save">Lưu nhân viên</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Displaying customers -->
            <div class="col-lg-12 col-md-12 mt-4">
                <h2 class="text-center">Danh sách nhân viên</h2>
                <div class="bg-primary p-5">
                    <table class="table table-hover text-light">
                        <thead>
                            <tr>
                                     <th>Mã NV</th>
                                    <th>Tên NV</th>
                                    <th>Ngày Sinh</th>
                                    <th>Giới tính</th>
                                    <th>Địa Chỉ</th>
                                    <th>Chức Vụ</th>
                                    <th>Điện Thoại</th>
                                    <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql3 = "SELECT * FROM ds_nv";
                            $stmt = $pdo->query($sql3);
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['ma_nv']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['ten_nv']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['ngaysinh']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['gioitinh_nv']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['diachi_nv']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['chuc_vu']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['sdt_nv']) . "</td>";
                                echo "<td>";
                                echo "<a href='nhanvien.php?edit_id=" . htmlspecialchars($row['ma_nv']) . "'class='btn btn-light btn-sm'onclick=\"return confirm('Bạn muốn lưu nhân viên này ?');\"><i class='fa-solid fa-user-pen'></i></a> ";
                                echo "<a href='nhanvien.php?delete_id=" . htmlspecialchars($row['ma_nv']) . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Chắc chắn muốn xoá nhân viên này?');\"><i class='fa-solid fa-trash-can'></i></a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <a href="?add_new=1" class="btn btn-secondary w-100 py-3">Thêm nhân viên mới</a>
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
</body>

</html>
