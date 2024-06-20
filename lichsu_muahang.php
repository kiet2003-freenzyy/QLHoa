<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Flowers-Website_History Order</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
</head>


<body>
<?php
include('header_cus.php');
?>

    <?php
    include("Database.php");
    $database = new Database();
    $pdo = $database->connect();

    // Xóa hóa đơn
    if (isset($_GET['delete_hd_id'])) {
        $ma_hd = $_GET['delete_hd_id'];
        $sql2 = "DELETE FROM hoadon_hoa WHERE ma_hd = :ma_hd";
        $stmt2 = $pdo->prepare($sql2);
        $stmt2->execute([':ma_hd' => $ma_hd]);

        $sql1 = "DELETE FROM chitiet_hoadon WHERE ma_hd = :ma_hd";
        $stmt1 = $pdo->prepare($sql1);
        $stmt1->execute([':ma_hd' => $ma_hd]);

        $sql = "DELETE FROM hoa_don WHERE ma_hd = :ma_hd";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':ma_hd' => $ma_hd]);
    }

    // Định nghĩa mã khách hàng
    $ma_kh = $_SESSION["ma_tk"];

    $donhang = [];

    $sql = "SELECT * FROM hoa_don WHERE ma_kh = :ma_kh";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':ma_kh', $ma_kh, PDO::PARAM_STR);
    $stmt->execute();
    $donhang = $stmt->fetchAll(PDO::FETCH_ASSOC);

    ?>
    <!-- Customer Form and List -->
    <div class="container center py-5" style="margin-top: 6%;" id="registration-container">
        <div class="row justify-content-center">

        </div>

        <?php if (isset($error_message)) : ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>
        <!-- Displaying customers -->
        <div class="col-lg-12 col-md-12 mt-4">
            <h2 class="text-center">Lịch Sử Mua Hàng</h2>
            <div class="bg-primary p-5">
                <table class="table table-hover text-light">
                    <thead>
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Mã khách hàng</th>
                            <th>Tên người nhận</th>
                            <th>Địa chỉ</th>
                            <th>Điện Thoại</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái giao hàng</th>
                            <th>Feedback</th>
                            <th>Mã nhân viên</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($donhang)) {
                            foreach ($donhang as $row) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['ma_hd']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['ma_kh']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['ten_nguoinhan']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['diachi_nguoinhan']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['sdt_nguoinhan']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['tong_tien']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['trangthai_hd']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['feedback']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['ma_nv']) . "</td>";
                                echo "<td>";
                                echo "<a href='xemchitiet_kh.php?ma_hd=" . htmlspecialchars($row['ma_hd']) . "' class='btn btn-light btn-sm'>Chi tiết</a> ";
                                echo "</td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Customer Form and List -->
    <?php
    include('footer_ad.php');
    ?>
    <!-- Back to Top -->
    <a href="#" class="btn btn-secondary py-3 fs-4 back-to-top"><i class="fas fa-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>