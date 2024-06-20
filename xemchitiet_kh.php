<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Xem Hoá Đơn</title>
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.rawgit.com/PascaleBeier/bootstrap-validate/v2.2.0/dist/bootstrap-validate.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        #Wrapper {
            margin-top: 20px;
        }

        #menu {
            margin-bottom: 20px;
        }

        #Content table {
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #Content table caption h1 {
            font-size: 1.5em;
            margin-bottom: 10px;
        }

        #Content table tr {
            transition: background-color 0.3s;
        }

        #Content table tr:hover {
            background-color: #f1f1f1;
        }

        #Footer {
            background-color: yellowgreen;
            color: white;
            padding: 10px 0;
            text-align: center;
        }

        #Footer a {
            color: white;
            text-decoration: underline;
        }

        .dd_mon img {
            width: 100%;
            height: 170px;
            object-fit: cover;
        }
    </style>
    <?php

    include("Database.php");
   
    $database = new Database();
    $pdo = $database->connect();
    session_start();

    

    $ma_hd = $_GET["ma_hd"];
    // Truy vấn dữ liệu từ ba bảng và kết hợp thông tin
    $sql = "SELECT h.*, ct.*, hh.ma_hoa, hh.so_luong 
        FROM hoa_don h
        JOIN chitiet_hoadon ct ON h.ma_hd = ct.ma_hd
        JOIN hoadon_hoa hh ON h.ma_hd = hh.ma_hd
        WHERE h.ma_hd = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$ma_hd]);
    $invoice = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // foreach ($invoice as $row) {
    //     print_r($row);
    //     print("<br>");
    // }
    // Kiểm tra nếu có dữ liệu POST được gửi đến
    ?>
</head>

<body>
    <?php
        include("header_cus.php");
    ?>
    <div class="container" style="margin-top: 6%;">
        <h1>Hóa Đơn</h1>
        <form method="post" action="edit_hoadon.php" onsubmit="return validateDeliveryDate();">
            <input type="hidden" name="ma_hd" value="<?php echo htmlspecialchars($invoice[0]['ma_hd']); ?>">
            <div class="form-group">
                <label for="ma_hd">Mã hóa đơn</label>
                <input type="text" class="form-control" id="ma_hd" name="ma_hd" value="<?php echo htmlspecialchars($invoice[0]['ma_hd']); ?>">
            </div>
            <div class="form-group">
                <label for="ma_kh">Mã Khách Hàng</label>
                <input type="text" class="form-control" id="ma_kh" name="ma_kh" value="<?php echo htmlspecialchars($invoice[0]['ma_kh']); ?>">
            </div>
            <div class="form-group">
                <label for="ten_nguoinhan">Tên Người Nhận</label>
                <input type="text" class="form-control" id="ten_nguoinhan" name="ten_nguoinhan" value="<?php echo htmlspecialchars($invoice[0]['ten_nguoinhan']); ?>">
            </div>
            <div class="form-group">
                <label for="diachi_nguoinhan">Địa Chỉ</label>
                <input type="text" class="form-control" id="diachi_nguoinhan" name="diachi_nguoinhan" value="<?php echo htmlspecialchars($invoice[0]['diachi_nguoinhan']); ?>">
            </div>
            <div class="form-group">
                <label for="sdt_nguoinhan">Số Điện Thoại</label>
                <input type="text" class="form-control" id="sdt_nguoinhan" name="sdt_nguoinhan" value="<?php echo htmlspecialchars($invoice[0]['sdt_nguoinhan']); ?>">
            </div>
            <div class="form-group">
                <label for="tong_tien">Tổng Tiền</label>
                <input type="text" class="form-control" id="tong_tien" name="tong_tien" value="<?php echo htmlspecialchars($invoice[0]['tong_tien']); ?>">
            </div>
            <div class="form-group">
                <label for="trangthai_hd">Trạng Thái</label>
                <input type="text" class="form-control" id="trangthai_hd" name="trangthai_hd" value="<?php echo htmlspecialchars($invoice[0]['trangthai_hd']); ?>">
            </div>
            <div class="form-group">
                <label for="feedback">Feedback</label>
                <input type="text" class="form-control" id="feedback" name="feedback" value="<?php echo htmlspecialchars($invoice[0]['feedback']); ?>">
            </div>
            <div class="form-group">
                <label for="ma_nv">Người giao hàng</label>
                <select class="form-control" id="ma_nv" name="ma_nv">
                    <?php
                    // Truy vấn cơ sở dữ liệu để lấy danh sách nhân viên có chức vụ shipper
                    $sql = "SELECT ma_nv, ten_nv FROM ds_nv WHERE chuc_vu = 'Shipper'";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    $shippers = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // Hiển thị danh sách nhân viên trong option
                    foreach ($shippers as $shipper) {
                        $selected = ($invoice[0]['ma_nv'] == $shipper['ma_nv']) ? 'selected' : '';
                        echo "<option value='" . htmlspecialchars($shipper['ma_nv']) . "' $selected>" . htmlspecialchars($shipper['ten_nv']) . "</option>";
                    }
                    ?>
                </select>
            </div>

            <h2>Chi Tiết Hóa Đơn</h2>
            <div class="form-group">
                <label for="ngay_dat">Ngày Đặt</label>
                <input type="date" class="form-control" id="ngay_dat" name="ngay_dat" value="<?php echo htmlspecialchars($invoice[0]['ngay_dat']); ?>">
            </div>
            <div class="form-group">
                <label for="ngay_giao">Ngày Giao</label>
                <input type="date" class="form-control" id="ngay_giao" name="ngay_giao" value="<?php echo htmlspecialchars($invoice[0]['ngay_giao']); ?>">
            </div>
            

            <div class="form-group">
                <label for="tien_datcoc">Tiền Đặt Cọc</label>
                <input type="text" class="form-control" id="tien_datcoc" name="tien_datcoc" value="<?php echo htmlspecialchars($invoice[0]['tien_datcoc']); ?>">
            </div>
            <div class="form-group">
                <label for="ma_giamgia">Mã Giảm Giá</label>
                <input type="text" class="form-control" id="ma_giamgia" name="ma_giamgia" value="<?php echo htmlspecialchars($invoice[0]['ma_giamgia']); ?>">
            </div>
            <div class="form-group">
                <label for="hinhthuc_tt">Hình Thức Thanh Toán</label>
                <input type="text" class="form-control" id="hinhthuc_tt" name="hinhthuc_tt" value="<?php echo htmlspecialchars($invoice[0]['hinhthuc_tt']); ?>">
            </div>
            <div class="form-group">
                <label for="ghi_chu">Ghi Chú</label>
                <textarea class="form-control" id="ghi_chu" name="ghi_chu"><?php echo htmlspecialchars($invoice[0]['ghi_chu']); ?></textarea>
            </div>

            <div class="form-group">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Mã Hoa</th>
                            <th>Số Lượng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($invoice as $item) { ?>
                            <tr>
                                <td>
                                    <input type="text" class="form-control" name="ma_hoa[]" value="<?php echo htmlspecialchars($item['ma_hoa']); ?>">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="so_luong[]" value="<?php echo htmlspecialchars($item['so_luong']); ?>">
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <script>
                // Function to validate delivery date
                function validateDeliveryDate() {
                    var deliveryDate = document.getElementById("ngay_giao").value;
                    var orderDate = document.getElementById("ngay_dat").value;
                    var currentDate = new Date().toISOString().slice(0, 10);

                    if (deliveryDate < orderDate) {
                        alert("Ngày giao không thể trước ngày đặt.");
                        document.getElementById("ngay_giao").value = "";
                        return false;
                    }

                    if (deliveryDate > currentDate) {
                        alert("Ngày giao không thể sau ngày hiện tại.");
                        document.getElementById("ngay_giao").value = "";
                        return false;
                    }

                    return true;
                }
            </script>
           
        </form>
        <a  href="index.php"  class="btn btn-primary">Trở về </a>
    </div>

</body>

</html>