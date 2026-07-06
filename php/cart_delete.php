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
$cart_id = isset($_POST['cart_id']) ? intval($_POST['cart_id']) : 0;

if ($cart_id > 0) {
    $sql = "DELETE FROM cart WHERE cart_id = ? AND user_id = ?";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, "is", $cart_id, $user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

mysqli_close($connect);
echo "<script>location.href='cart.php';</script>";
?>