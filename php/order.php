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
$selectedCartIds = [];
if (isset($_GET['items'])) {
    $selectedCartIds = array_filter(array_map('intval', explode(',', $_GET['items'])), function ($id) {
        return $id > 0;
    });

    if (count($selectedCartIds) === 0) {
        echo "<script>alert('주문할 상품을 선택해주세요.'); location.href='cart.php';</script>";
        exit;
    }
}

$itemFilterSql = '';
if (count($selectedCartIds) > 0) {
    $itemFilterSql = ' AND c.cart_id IN (' . implode(',', $selectedCartIds) . ')';
}

$sql = "SELECT c.quantity, p.name, p.model, p.price, p.image
        FROM cart c
        JOIN products p ON c.product_id = p.product_id
        WHERE c.user_id = ?" . $itemFilterSql . "
        ORDER BY c.cart_id DESC";
$stmt = mysqli_prepare($connect, $sql);
mysqli_stmt_bind_param($stmt, "s", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$items = [];
$totalQuantity = 0;
$totalPrice = 0;

while ($row = mysqli_fetch_assoc($result)) {
    $row['subtotal'] = intval($row['price']) * intval($row['quantity']);
    $items[] = $row;
    $totalQuantity += intval($row['quantity']);
    $totalPrice += $row['subtotal'];
}

mysqli_stmt_close($stmt);
mysqli_close($connect);

if (count($items) === 0) {
    echo "<script>alert('장바구니에 담긴 상품이 없습니다.'); location.href='cart.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>주문하기</title>
    <link rel="stylesheet" href="../css/reset.css?v=3">
    <link rel="stylesheet" href="../css/common-menu.css?v=3">
    <script src="../js/common-menu.js?v=3" defer></script>
    <link rel="stylesheet" href="../css/order.css?v=21">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
</head>
<body>
    <div class="otop">
        <a href="cart.php" aria-label="장바구니로 돌아가기">&larr;</a>
        <h2>주문하기</h2>
    </div>

<form action="#" method="post">
    <section class="information1">
        <h3>구매자 정보</h3>
        <div class="igroup1">
            <p>
                <label for="buyerName">성명</label>
                <input type="text" placeholder="성명" name="buyerName" id="buyerName">
            </p>
            <p>
                <label for="buyerPh">휴대폰 번호</label>
                <input type="tel" maxlength="11" placeholder="-없이 숫자 입력해 주세요" name="buyerPh" id="buyerPh">
            </p>
            <p>
                <label for="email">이메일</label>
                <input type="email" placeholder="이메일 입력" id="email" name="email">
            </p>
        </div>
    </section>

    <section class="information1">
        <h3>배송지 정보</h3>
        <div class="igroup1">
            <p>
                <label for="receiverName">성명</label>
                <input type="text" placeholder="성명" name="receiverName" id="receiverName" required>
            </p>
            <p>
                <label for="receiverPh">휴대폰 번호</label>
                <input type="tel" maxlength="11" placeholder="-없이 숫자 입력해 주세요" name="receiverPh" id="receiverPh" required>
            </p>
            <p class="addressbox">
                <label for="address1">주소</label>
                <span class="addr_row">
                    <input type="text" id="address1" name="address1" required>
                    <button type="button">우편번호</button>
                </span>
                <input type="text" id="address2" name="address2" aria-label="기본주소">
            </p>
            <p>
                <label for="detail_addre">상세주소</label>
                <input type="text" id="detail_addre" name="detail_addre">
            </p>
            <label for="deliveryRequest" class="blind">배송 요청사항</label>
            <select id="deliveryRequest" name="deliveryRequest">
                <option>배송 요청사항을 선택해 주세요</option>
                <option>문앞</option>
                <option>직접 받고 부재시 문앞</option>
                <option>경비실</option>
                <option>택배함</option>
                <option>직접입력</option>
            </select>
        </div>
    </section>

    <section class="information2">
        <h3>주문상품 정보 / 총 <?= number_format($totalQuantity) ?>개</h3>
        <?php foreach ($items as $item) { ?>
            <div class="order-product">
                <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                <div class="order-product-info">
                    <p class="order-product-name"><?= htmlspecialchars($item['name']) ?></p>
                    <p class="order-product-model"><?= htmlspecialchars($item['model']) ?></p>
                    <p class="order-product-meta">수량 <?= intval($item['quantity']) ?>개</p>
                    <p class="order-product-price"><?= number_format($item['subtotal']) ?>원</p>
                </div>
            </div>
        <?php } ?>
    </section>

    <section class="information3">
        <h3>결제방법</h3>
        <div class="igroup3_1">
            <input type="radio" id="normalPay" name="payment" class="o_check" checked>
            <label for="normalPay">일반결제</label>
        </div>
        <div class="igroup3_2">
            <button type="button" aria-pressed="true">신용/체크카드</button>
            <button type="button" aria-pressed="false">페이코</button>
            <button type="button" aria-pressed="false">카카오페이</button>
            <button type="button" aria-pressed="false">가상계좌</button>
            <button type="button" aria-pressed="false">네이버페이</button>
        </div>
    </section>

    <section class="information4">
        <h3>결제금액</h3>
        <div class="igroup4">
            <ul>
                <li>상품금액</li>
                <li>배송비</li>
                <li>할인 내역</li>
            </ul>
            <ul class="c_n">
                <li><?= number_format($totalPrice) ?>원</li>
                <li>배송비 무료</li>
                <li>0원</li>
            </ul>
        </div>
     </section>

       <ul class="ig4_1">
            <li>결제 예정 금액</li>
            <li><?= number_format($totalPrice) ?>원</li>
        </ul>

     <div class="information5">
         <ul>
            <li><input type="checkbox" id="agree1"><label for="agree1">개인정보 수집 및 이용에 동의합니다.</label></li>
            <li><input type="checkbox" id="agree2"><label for="agree2">단순 변심으로 인한 교환/반품의 경우 반품 배송비가 발생할 수 있음을 확인했습니다.</label></li>
            <li><input type="checkbox" id="agree3"><label for="agree3">주문 정보를 확인했으며 이에 동의합니다.</label></li>
         </ul>
     </div>

     <div class="o_btn">
        <button type="submit"><?= number_format($totalPrice) ?>원 결제하기</button>
     </div>
</form>

     <?php include "bar.php"; ?>
</body>
</html>