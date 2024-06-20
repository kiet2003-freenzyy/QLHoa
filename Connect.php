<?php
include("Database.php");
$database = new Database();
$pdo = $database->connect();
session_start();
// ĐỌC DỮ LIỆU TỪ TABLE chude_hoa - Khai báo biến đối tượng PDO kết nối CSDL
$pdo = new PDO("mysql:host=localhost;dbname=ql_hoa", "root", "");
$pdo->query("set names utf8");

$sql = "SELECT ma_cd, ten_cd, mo_ta FROM chude_hoa";
$loai_hoa = $pdo->query($sql);

$pdo = null;

// ĐỌC DỮ LIỆU TỪ TABLE ds_hoa - Khai báo biến đối tượng PDO kết nối CSDL
$pdo1 = new PDO("mysql:host=localhost;dbname=ql_hoa", "root", "");
$pdo1->query("set names utf8");

$sql1 = "SELECT ds_hoa.*, chude_hoa.ten_cd 
         FROM ds_hoa 
         JOIN chude_hoa ON ds_hoa.ma_cd = chude_hoa.ma_cd";
$hoa_dep = $pdo1->query($sql1);
$pdo1 = null;

//Lọc theo loại
$pdo2 = new PDO("mysql:host=localhost;dbname=ql_hoa", "root", "");
$pdo2->query("set names utf8");

if (isset($_GET['ml'])) {
    if ($_GET["ml"] == NULL) {
        $ml = 0; // show all
    } else {
        $ml = $_GET["ml"];
    }

    if ($ml == 0) {
        $sql2 = "SELECT ds_hoa.*, chude_hoa.ten_cd 
        FROM ds_hoa 
        JOIN chude_hoa ON ds_hoa.ma_cd = chude_hoa.ma_cd";
        $hoa_dep2 = $pdo2->query($sql2);
    } else {
        $sql2 = "SELECT ds_hoa.*, chude_hoa.ten_cd 
        FROM ds_hoa 
        JOIN chude_hoa ON ds_hoa.ma_cd = chude_hoa.ma_cd WHERE ds_hoa.ma_cd = :ml";
        $stmt = $pdo2->prepare($sql2);
        $stmt->bindParam(':ml', $ml, PDO::PARAM_STR); // Sử dụng PDO::PARAM_STR nếu ma_cd là chuỗi
        $stmt->execute();
        $hoa_dep2 = $stmt;
    }
}

// Lọc theo Giá
$pdo3 = new PDO("mysql:host=localhost;dbname=ql_hoa", "root", "");
$pdo3->query("set names utf8");
if (isset($_GET['gt']) && isset($_GET['gc'])) {
    $gt = $_GET['gt'];
    $gc = $_GET['gc'];
    if ($gt == 0 && $gc == 0) {
        $sql3 = "SELECT ds_hoa.*, chude_hoa.ten_cd 
        FROM ds_hoa 
        JOIN chude_hoa ON ds_hoa.ma_cd = chude_hoa.ma_cd";
    } else {
        $sql3 = "SELECT ds_hoa.*, chude_hoa.ten_cd 
        FROM ds_hoa 
        JOIN chude_hoa ON ds_hoa.ma_cd = chude_hoa.ma_cd WHERE ds_hoa.gia > :gt AND ds_hoa.gia <= :gc";
        $stmt = $pdo3->prepare($sql3);
        $stmt->bindParam(':gt', $gt, PDO::PARAM_INT);
        $stmt->bindParam(':gc', $gc, PDO::PARAM_INT);
        $stmt->execute();
        $hoa_dep3 = $stmt;
    }
    $pdo3 = null;
}

// Tìm kiếm theo tên
$pdo4 = new PDO("mysql:host=localhost;dbname=ql_hoa", "root", "");
$pdo4->query("set names utf8");
if (isset($_GET['txt_Search'])) {
    $Ten = $_GET["txt_Search"];
    $sql4 = "SELECT * FROM ds_hoa WHERE ten_hoa LIKE :Ten";
    $stmt = $pdo4->prepare($sql4);
    $searchTerm = "%" . $Ten . "%";
    $stmt->bindParam(':Ten', $searchTerm, PDO::PARAM_STR);
    $stmt->execute();
    $hoa_dep4 = $stmt;
    $pdo4 = null;
}

// Chi Tiết Sản Phẩm 
$pdo5 = new PDO("mysql:host=localhost;dbname=ql_hoa", "root", "");
$pdo5->query("set names utf8");
if (isset($_GET['id'])) {$maHoa = $_GET["id"];
    $sql5 = "SELECT * FROM ds_hoa WHERE ma_hoa = :maHoa";
    $stmt = $pdo5->prepare($sql5);
    $stmt->bindParam(':maHoa', $maHoa, PDO::PARAM_STR);
    $stmt->execute();
    $hoadep2 = $stmt;
    $pdo5 = null;
}
?>