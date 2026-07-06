<?php
session_start();

if (!isset($_SESSION['userid'])) {
    echo "<script>alert('로그인 후 이용해주세요.'); location.href='login_form.php';</script>";
    exit;
}

include "dbconn.php";
include "cart_schema.php";
ensure_cart_tables($connect);

$user_id = $_SESSION['userid'];
$product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
$quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

if ($product_id <= 0) {
    echo "<script>alert('상품 정보가 올바르지 않습니다.'); history.go(-1);</script>";
    exit;
}

if ($quantity < 1) {
    $quantity = 1;
}

$sql = "INSERT INTO cart (user_id, product_id, quantity)
        VALUES (?, ?, ?)
        ON DUPLICATE KEY UPDATE quantity = quantity + VALUES(quantity)";
$stmt = mysqli_prepare($connect, $sql);
mysqli_stmt_bind_param($stmt, "sii", $user_id, $product_id, $quantity);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($connect);

echo "<script>alert('장바구니에 담았습니다.'); location.href='cart.php';</script>";
?>