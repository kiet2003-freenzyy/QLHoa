<?php 
    session_start();
    // Nếu chưa tồn tại thì khởi tạo giỏ
    if(!isset($_SESSION['cart'])) $_SESSION['cart']=[];

    //Lấy dl từ form Xem Chi Tiết
    if(isset($_POST['add_to_cart']) && ($_POST['add_to_cart']))
    {
        $maHoa = $_POST['maHoa'];
        $tenHoa=$_POST['tenHoa'];
        $hinh=$_POST['hinh'];
        $Gia=$_POST['Gia'];
        $GiaKM=$_POST['GiaKM'];
        $sl=$_POST['sl'];

        //Kiểm tra SP có trong giỏ hàng hay không 
        $flag = 0;
        foreach( $_SESSION['cart'] as $key=>$item )
        {
            if($item["maHoa"]== $maHoa)
            {
                $flag = 1;
                $sl_new= $sl + $item["sl"];
                $item["sl"] = $sl_new;
                break;
            }
        }
        //Thêm SP vào giỏ nếu kg trùng
        if ($flag == 0)
        {
           // $sp = [$maMon,$tenMon, $hinh,$donGia,$sl];
            $sp= array(
                'maHoa'=>$maHoa,
                'tenHoa'=>$tenHoa,
                'hinh'=>$hinh,
                'Gia'=>$Gia,
                'GiaKM'=>$GiaKM,
                'sl'=>$sl,
            );
            $_SESSION['cart'][]= $sp;
        } 
    }
   
?>
<?php
// GIỎ HÀNG
// Nếu chưa tồn tại thì khởi tạo giỏ
if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

//Xóa ALL giỏ
if (isset($_GET['emptyCart']) && ($_GET['emptyCart'] == 1)) unset($_SESSION['cart']);

//Xóa item trong Giỏ
if (isset($_GET['delId']) && ($_GET['delId'] >= 0)) {
    // unset($_SESSION['cart'][$_GET['delId']]);
    array_splice($_SESSION['cart'], $_GET['delId'], 1);
}

// Update item trong giỏ
if (isset($_GET['updateId']) && ($_GET['updateId'] >= 0)) {
    $index = $_GET['updateId'];
    if (isset($_SESSION['cart'][$index])) {
        $new_quantity = $_GET['num_sl']; // Số lượng mới
        $_SESSION['cart'][$index]['sl'] = $new_quantity;
    }
}

//Lấy dl từ form Xem Chi Tiết
// if (isset($_POST['add_to_cart']) && ($_POST['add_to_cart'])) {
//     $maHoa = $_POST['maHoa'];
//     $tenHoa = $_POST['tenHoa'];
//     $hinh = $_POST['hinh'];
//     $Gia = $_POST['Gia'];
//     $GiaKM = $_POST['GiaKM'];
//     $sl = $_POST['sl'];


//     //Kiểm tra SP có trong giỏ hàng hay không 
//     /* $flag = 0;
//          foreach( $_SESSION['cart'] as $key=>&$item )
//         {
//             if($item['maMon']== $maMon)
//             {
//                 $flag = 1;
//                 $sl_new= $sl + $item['sl'];
//                 $item['sl'] = $sl_new;
//                 $_SESSION['cart'][$key] = $item;
//                 break;
//             }
//         } */
//     $flag = 0;
//     $count = count($_SESSION['cart']);
//     for ($i = 0; $i < $count; $i++) {
//         $item = $_SESSION['cart'][$i];
//         if ($item["maHoa"] == $maHoa) {
//             $flag = 1;
//             $sl_new = $sl + $item["sl"];
//             $item["sl"] = $sl_new; // Cập nhật số lượng trực tiếp trong mảng $_SESSION['cart']
//             $_SESSION['cart'][$i] = $item;
//             break;
//         }
//     }

//     //Thêm SP vào giỏ nếu kg trùng
//     if ($flag == 0) {
//         // $sp = [$maMon,$tenMon, $hinh,$donGia,$sl];
//         $sp = array(
//             'maHoa' => $maHoa,
//             'tenHoa' => $tenHoa,
//             'hinh' => $hinh,
//             'Gia' => $Gia,
//             'GiaKM' => $GiaKM,
//             'sl' => $sl,
//         );
//         $_SESSION['cart'][] = $sp;
//     }
// }

?>

