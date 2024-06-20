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
        width: 200px;
        height: 200px;
        object-fit: cover;
    }

    .hoa-grid {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    .hoa-item {
        width: 100%;
        max-width: 300px;
        display: flex;
        flex-direction: column;
        height: 100%;
        border: 1px solid #ccc;
        border-radius: 10px;
        overflow: hidden;
    }

    .hoa-img img {
        width: 100%;
        height: auto;
    }

    .hoa-item .p-4 {
        padding: 15px;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .hoa-item .content {
        flex: 1;
    }

    .hoa-item .footer .p {
        width: 80px;
    }
</style>

<?php

if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

$records_per_page = 6;
$start_from = ($page - 1) * $records_per_page;
$pdo = new PDO("mysql:host=localhost;dbname=ql_hoa", "root", "");
$pdo->query("set names utf8");
$sql = "SELECT ds_hoa.*, ten_cd FROM ds_hoa, chude_hoa where ds_hoa.ma_cd = chude_hoa.ma_cd ";
$sqlCount = "SELECT COUNT(*) FROM ds_hoa";

$coML = false;
$ml = "";

if (isset($_GET['ml'])) {
    $ml = $_GET['ml'];
    $dieuKien = " ds_hoa.ma_cd = '" . $ml . "'";
    $sql .= 'and' . $dieuKien;
    $sqlCount .= ' where' . $dieuKien;
    $coML = true;
    $ml = "&ml=" . $_GET['ml'];
}

$priceParams = "";
if (isset($_GET['price_min']) && isset($_GET['price_max'])) {
    $price_min = $_GET['price_min'];
    $price_max = $_GET['price_max'];

    // Điều kiện để so sánh giá khuyến mãi nếu có, ngược lại thì so sánh giá thường
    $dieuKien = "(CASE 
                    WHEN ds_hoa.gia_khuyenmai IS NOT NULL THEN ds_hoa.gia_khuyenmai
                    ELSE ds_hoa.gia
                 END) BETWEEN " . $price_min . " AND " . $price_max;

    $sql .= ' AND ' . $dieuKien;
    $sqlCount .= ' WHERE ' . $dieuKien;
    $coPrice = true;
    $priceParams = "&price_min=" . $_GET['price_min'] . "&price_max=" . $_GET['price_max'];
}

if (isset($_POST['tim_theo_ten'])) {
    $timKiem = $_POST['timKiem'];
    $sql .= " AND ds_hoa.ten_hoa LIKE '%$timKiem%'";
    if ($coML)
        $sqlCount .= " AND ds_hoa.ten_hoa LIKE '%$timKiem%'";
    else
        $sqlCount .= " WHERE ds_hoa.ten_hoa LIKE '%$timKiem%'";
}

$total_records = $pdo->query($sqlCount)->fetchColumn();
$sql .= " LIMIT $start_from, $records_per_page";

$result = $pdo->query($sql);
if ($total_records > 0) {
?>
    <div class="col-lg-9">
        <div class="row g-4 justify-content-center">
            <?php
            while ($hoa = $result->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <div class="col-xl-4 hoa-grid">
                    <div class="rounded position-relative hoa-item">
                        <div class="hoa-img">
                            <img style="object-fit: cover; width: 215px; height: 215px;" src="img/<?php echo $hoa["hinh"] ?>" class="img-fluid rounded-top" alt="">
                        </div>
                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;"><?php echo $hoa["ten_cd"] ?></div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <div class="content">
                                <h4 style="min-height: 58px;"><?php echo $hoa["ten_hoa"]; ?></h4>
                                <p style="min-height: 100px;"><?php echo $hoa["noidung"]; ?></p>
                            </div>
                            <div class="footer row">
                                <?php if (!empty($hoa["gia_khuyenmai"]) && $hoa["gia_khuyenmai"] > 0): ?>
                                    <div class="col">
                                        <p class="text-danger text-decoration-line-through"><s style="color: red"><?php echo number_format($hoa["gia"], 0, ',', '.'); ?> đ</s></p>
                                    </div>
                                    <div class="col">
                                        <p class="fw-bold me-2"><?php echo number_format($hoa["gia_khuyenmai"], 0, ',', '.'); ?> đ</p>
                                    </div>
                                <?php else: ?>
                                    <div class="col">
                                        <p class="fw-bold me-2"><?php echo number_format($hoa["gia"], 0, ',', '.'); ?> đ</p>
                                    </div>
                                <?php endif; ?>
                                <a href="shop-detail.php?id=<?php echo $hoa['ma_hoa'] ?>" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
<?php
} else {
?>
    <h2>Không tìm thấy sản phẩm</h2>
<?php
}

$total_pages = ceil($total_records / $records_per_page);
if ($total_pages > 1) {
?>
    <div class="col-12">
        <div class="pagination d-flex justify-content-center mt-5">
            <a href="shop_us.php?page=1" class="rounded">&laquo;</a>
            <?php
            for ($i = 1; $i <= $total_pages; $i++) {
                echo "<a href='shop_us.php?page=$i$ml$priceParams' class='rounded " . ($i == $page ? "active" : "") . "'>$i</a> ";
            }
            ?>
            <a href="shop_us.php?page=<?php echo $total_pages ?>" class="rounded">&raquo;</a>
        </div>
    </div>
<?php
}
?>

<script>
    window.addEventListener('beforeunload', function() {
        sessionStorage.setItem('scrollPosition', window.scrollY);
    });

    window.addEventListener('load', function() {
        var scrollPosition = sessionStorage.getItem('scrollPosition');
        if (scrollPosition !== null) {
            window.scrollTo(0, parseInt(scrollPosition));
        }
    });
</script>
