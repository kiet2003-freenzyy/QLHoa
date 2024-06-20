<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Flowers-Website_Thanh Toán</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
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
        sup {
            color: red;
        }
    </style>
</head>
<?php
include("Connect.php");

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

function generate_ma_hd($pdo)
{
    $sql2 = "SELECT MAX(ma_hd) AS max_ma_hd FROM hoa_don";
    $stmt = $pdo->query($sql2);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $max_ma_hd = $row['max_ma_hd'];
    $last_id = intval(substr($max_ma_hd, 2));
    $new_id = $last_id + 1;
    return "HD" . str_pad($new_id, 3, "0", STR_PAD_LEFT);
}

if (isset($_SESSION['ma_tk'])) {
    $ma_kh = $_SESSION['ma_tk'];
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



if (isset($_POST['thanhToan'])) {
    if (isset($_POST['full_name'], $_POST['email'], $_POST['address'], $_POST['deliveryDate']) && !empty($_POST['full_name']) && !empty($_POST['email']) && !empty($_POST['address']) && !empty($_POST['deliveryDate'])) {
        $CustomerID = generate_ma_kh($pdo);
        $fullName  = $_POST['full_name'];
        $email     = $_POST['email'];
        $address   = $_POST['address'];
        $phone    = $_POST['sdt'];
        $note =  $_POST['note'];
        $deliveryDate = $_POST['deliveryDate'];

        $sql2 = 'SELECT * FROM ds_kh WHERE email_kh = :email'; // chống SQL injection
        $statement = $pdo->prepare($sql2);
        $statement->bindParam(':email', $email); // chống SQL injection
        $statement->execute();
        $kq = $statement->fetch(PDO::FETCH_ASSOC);

        if (empty($kq["ma_kh"])) {
            $sql1 = 'INSERT INTO ds_kh VALUES(?, ?, ?, ?, ?, ?)';
            $param = array($CustomerID, $fullName, $address, null,  $phone, $email);
            $statement = $pdo->prepare($sql1);
            $statement->execute($param);
        } else {
            $CustomerID = $kq['ma_kh'];
        }

        // Chèn dữ liệu vào hóa đơn
        $MaHD = generate_ma_hd($pdo);
        $MaKH = $CustomerID;
        $NgayDat = date('Y-m-d');
        $total = $_SESSION['total'];


        $magiamgia = empty($_POST['magiamgia']) ? null : $_POST['magiamgia'];
        $tien_giam = 0;
        if (!empty($magiamgia)) {
            $sql = "SELECT tien_giam FROM ds_magiamgia WHERE ma_giamgia = :ma_giamgia";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':ma_giamgia' => $magiamgia]);
            $tien_giam = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        $HTTT = $_POST['httt'];
        $GhiChu = "note";
        $totaltruDatCoc = isset($_SESSION['totaltruDatCoc']) ? $_SESSION['totaltruDatCoc'] : $total;
        $totaltruDatCoc -= $tien_giam;


        $feedback = "";
        $trangthai_donhang = "Đang xử lý";
        $ma_nv = null;
        $phone_nhan = empty($_POST['recipientTel']) ? $phone : $_POST['recipientTel'];
        $name_nhan = empty($_POST['recipientName']) ? $fullName : $_POST['recipientName'];
        $address_nhan = empty($_POST['recipientAddress']) ? $address : $_POST['recipientAddress'];

        if ($address_nhan) {
            //thêm thông tin vào hoa_don
            $sql3 = 'INSERT INTO hoa_don VALUES(?,?,?,?,?,?,?,?,?)';
            $param3 = array($MaHD, $MaKH, $name_nhan, $address_nhan, $phone_nhan, $totaltruDatCoc, $trangthai_donhang, $feedback, $ma_nv);
            $statement = $pdo->prepare($sql3);
            $statement->execute($param3);

            $sql3 = 'INSERT INTO chitiet_hoadon VALUES(?,?,?,?,?,?,?,?,?)';
            $param3 = array($MaHD, $MaKH, $NgayDat, $deliveryDate, $total, $total - $totaltruDatCoc, $magiamgia, $HTTT, $note);
            $statement = $pdo->prepare($sql3);
            $statement->execute($param3);
        }


        // Chèn dữ liệu vào Chi tiết HD
        foreach ($_SESSION['cart'] as $key => $item) {
            $MaHoa = $item['maHoa'];
            $sl = $item['sl'];

            $sql4 = 'INSERT INTO hoadon_hoa VALUES(?,?,?)';
            $param4 = array($MaHD, $MaHoa, $sl);
            $statement = $pdo->prepare($sql4);
            $statement->execute($param4);
        }


        // Giải phóng biến giỏ hàng
        unset($_SESSION['cart']);
        $pdo = NULL;
    }
}

?>

<body>
    <?php
    include 'cart.php';
    include('header_cus.php');
    ?>

    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Thanh Toán</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="index.php">Trang Chủ</a></li>
            <li class="breadcrumb-item"><a href="#">Sản Phẩm</a></li>
            <li class="breadcrumb-item active text-white">Chi Tiết Hoá Đơn</li>
        </ol>
    </div>
    <!-- Single Page Header End -->
    <!-- Checkout Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <h1 class="mb-4">Chi Tiết Thanh Toán</h1>
            <form action="checkout.php" method="post" id="checkoutForm" onsubmit="return validateForm()">
                <div class="row g-5">
                    <div class="col-md-12 col-lg-6 col-xl-7">
                        <div class="form-item">
                            <label class="form-label my-3">Họ Tên <sup>*</sup></label>
                            <input type="text" id="full_name" name="full_name" class="form-control" value="<?php echo htmlspecialchars(isset($ten_kh) ? $ten_kh : ""); ?>" required>
                        </div>

                        <div class="form-item">
                            <label class="form-label my-3">Số điện thoại</label>
                            <input type="tel" id="sdt" name="sdt" class="form-control" value="<?php echo htmlspecialchars(isset($dien_thoai) ? $dien_thoai : ""); ?>">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Ngày giao <sup>*</sup></label>
                            <input type="date" id="deliveryDate" name="deliveryDate" class="form-control" required>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Email <sup>*</sup></label>
                            <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars(isset($email) ? $email : ""); ?>" required>
                        </div>
                        <br>
                        <div class="form-item">
                            <label for="httt" class="form-label text-light">Hình thức thanh toán:</label>
                            <select id="httt" class="form-select bg-light border-0" name="httt">
                                <option value="Tiền mặt">Tiền mặt</option>
                                <option value="CHuyển khoản">CHuyển khoản</option>
                            </select>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Địa chỉ <sup>*</sup></label>
                            <input type="text" id="address" name="address" class="form-control" placeholder="1234 Đường ABC" value="<?php echo htmlspecialchars(isset($dia_chi) ? $dia_chi : ""); ?>" required>
                        </div>
                        <br>
                        <div class="form-item row">
                            <div class="col-8">
                                <input type="text" id="magiamgia" name="magiamgia" class="form-control" placeholder="Mã giảm giá">
                            </div>
                            <div class="col">
                                <button type="button" class="btn border-secondary text-primary w-100" onclick="kiemTraMaGiamGia()">Kiểm tra</button>
                            </div>
                            <input type="hidden" id="tien_giam_input" name="tien_giam" value="">
                        </div>
                        <div id="discountResult"></div>
                        <br>
                        <div class="form-item">
                            <textarea name="note" id="note" class="form-control" spellcheck="false" cols="30" rows="6" placeholder="Ghi chú"></textarea>
                        </div>



                        <hr>
                        <div class="form-check my-3">
                            <input class="form-check-input" type="checkbox" id="differentRecipient" onclick="toggleRecipientInfo()">
                            <label class="form-check-label" for="Address-1">Người nhận khác</label>
                            <div id="recipientInfo" style="display: none;">
                                <div class="form-item">
                                    <label class="form-label my-3">Tên người nhận <sup>*</sup></label>
                                    <input type="text" id="recipientName" name="recipientName" class="form-control">
                                </div>
                                <div class="form-item">
                                    <label class="form-label my-3">Số điện thoại <sup>*</sup></label>
                                    <input type="tel" id="recipientTel" name="recipientTel" class="form-control">
                                </div>
                                <div class="form-item">
                                    <label class="form-label my-3">Địa chỉ nhận <sup>*</sup></label>
                                    <input type="text" id="recipientAddress" name="recipientAddress" class="form-control">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-5">
                        <?php if (isset($_SESSION["cart"]) && !empty($_SESSION["cart"])) { ?>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Sản phẩm</th>
                                            <th scope="col">Tên</th>
                                            <th scope="col">Giá</th>
                                            <th scope="col">Số lượng</th>
                                            <th scope="col">Thành tiền</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $totalCounter = 0;
                                        $itemCounter = 0;
                                        foreach ($_SESSION['cart'] as $i => $item) {
                                            $imgUrl = "img/" . $item["hinh"];
                                            $total = (float)$item["Gia"] * (int)$item["sl"];
                                            $_SESSION['total'] = $totalCounter += $total;
                                            $itemCounter += $item["sl"];
                                        ?>
                                            <tr>
                                                <td>
                                                    <img src="<?php echo $imgUrl; ?>" class="rounded img-thumbnail mr-2" style="width:60px;">
                                                </td>
                                                <td>
                                                    <?php echo $item['tenHoa']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $item['Gia']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $item['sl']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $total; ?>
                                                </td>
                                                <td>
                                                    <a href="Checkout.php?delId=<?php echo $i ?>" class="text-danger">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                                <th scope="col">Tổng tiền</th> <?php echo $totalCounter; ?>
                                <?php
                                if ($total >= 500000) {
                                    $_SESSION['totaltruDatCoc'] = $totaltruDatCoc = $totalCounter * 0.8;
                                ?>
                                    <div>Bạn phải đặt cọc 20% giá trị</div>
                                <?php
                                }

                                ?>
                            </div>
                        <?php } else { ?>
                            <p style="text-align: center; color: red">Giỏ hàng trống, trở lại để thêm sản phẩm</p>
                            <a href="shop_us.php" class="btn btn-primary mb-3">
                                <i class="bi bi-arrow-left"></i> Trở lại
                            </a>
                        <?php } ?>
                        <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                            <button type="submit" name="thanhToan" class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Thanh Toán</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Checkout Page End -->
    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>
    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script>
        function toggleRecipientInfo() {
            var recipientInfo = document.getElementById('recipientInfo');
            var inputs = recipientInfo.querySelectorAll('input');

            if (document.getElementById('differentRecipient').checked) {
                recipientInfo.style.display = 'block';
                inputs.forEach(function(input) {
                    input.setAttribute('required', 'required');
                });
            } else {
                recipientInfo.style.display = 'none';
                inputs.forEach(function(input) {
                    input.removeAttribute('required');
                });
            }
        }

        function validateForm() {
            var fullname = document.getElementById('fullname').value;
            var email = document.getElementById('email').value;
            var address = document.getElementById('address').value;

            if (fullname === "" || email === "" || address === "") {
                alert("Please fill out all fields.");
                return false;
            }

            if (document.getElementById('differentRecipient').checked) {
                var recipientName = document.getElementById('recipientName').value;
                var recipientEmail = document.getElementById('recipientEmail').value;
                var recipientAddress = document.getElementById('recipientAddress').value;

                if (recipientName === "" || recipientEmail === "" || recipientAddress === "") {
                    alert("Please fill out all recipient fields.");
                    return false;
                }
            }
            return true;
        }

        function kiemTraMaGiamGia() {
            var maGiamGia = document.getElementById('magiamgia').value;
            var resultDiv = document.getElementById('discountResult');

            // Clear previous results
            resultDiv.innerHTML = '';

            if (maGiamGia === '') {
                resultDiv.innerHTML = 'Vui lòng nhập mã giảm giá.';
                return;
            }

            // Create an XMLHttpRequest object
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'kiem_tra_ma_giam_gia.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            // Define a callback function
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        resultDiv.innerHTML = 'Mã giảm giá hợp lệ: giảm được <strong>' + response.tien_giam + '</strong>';
                    } else {
                        resultDiv.innerHTML = 'Mã giảm giá không hợp lệ.';
                    }
                }
            };

            // Send the request
            xhr.send('magiamgia=' + encodeURIComponent(maGiamGia));
        }
    </script>