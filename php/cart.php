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
$sql = "SELECT c.cart_id, c.quantity, p.name, p.model, p.price, p.image
        FROM cart c
        JOIN products p ON c.product_id = p.product_id
        WHERE c.user_id = ?
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
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>장바구니</title>
    <link rel="stylesheet" href="../css/reset.css?v=3">
    <link rel="stylesheet" href="../css/common-menu.css?v=3">
    <script src="../js/common-menu.js?v=3" defer></script>
    <link rel="stylesheet" href="../css/cart.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
</head>
<body>
    <div class="ctop">
        <a href="../main.html" aria-label="이전 페이지로 이동">&larr;</a>
        <h2>장바구니</h2>
    </div>

    <div class="cgroup1">
        <h3>현재 담은 장바구니</h3>
        <ul class="c_p1">
            <li>
                <label>
                    <input type="checkbox" class="c_check" checked>
                    <span>전체선택(<?= count($items) ?>/<?= count($items) ?>)</span>
                </label>
            </li>
        </ul>

        <?php if (count($items) === 0) { ?>
            <div class="cgroup2">
                <p>장바구니에 담긴 상품이 없습니다.</p>
            </div>
        <?php } ?>

        <?php foreach ($items as $item) { ?>
            <div class="c_p2">
                <ul class="c_p2left">
                    <li>
                        <label>
                            <input type="checkbox" class="c_check" checked>
                            <span class="blind"><?= htmlspecialchars($item['name']) ?> 선택</span>
                        </label>
                        <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                    </li>
                </ul>

                <ul class="c_p2rt">
                    <li>
                        <p><?= htmlspecialchars($item['name']) ?></p>
                        <p class="c_n"><?= htmlspecialchars($item['model']) ?></p>
                        <ul class="c_p2rb">
                            <li>
                                <p class="c_n">수량 <?= intval($item['quantity']) ?>개</p>
                                <p><?= number_format($item['subtotal']) ?>원</p>
                            </li>
                        </ul>
                    </li>
                </ul>

                <div class="quantity">
                    <form action="cart_update.php" method="post">
                        <input type="hidden" name="cart_id" value="<?= intval($item['cart_id']) ?>">
                        <button type="submit" name="quantity" value="<?= max(1, intval($item['quantity']) - 1) ?>" class="minus" aria-label="수량 감소">-</button>
                    </form>
                    <input type="text" value="<?= intval($item['quantity']) ?>" class="count" readonly>
                    <form action="cart_update.php" method="post">
                        <input type="hidden" name="cart_id" value="<?= intval($item['cart_id']) ?>">
                        <button type="submit" name="quantity" value="<?= intval($item['quantity']) + 1 ?>" class="plus" aria-label="수량 증가">+</button>
                    </form>
                    <form action="cart_delete.php" method="post">
                        <input type="hidden" name="cart_id" value="<?= intval($item['cart_id']) ?>">
                        <button type="submit" class="c_r">삭제</button>
                    </form>
                </div>
            </div>
        <?php } ?>
    </div>

    <div class="cgroup2">
        <h3>서비스 장바구니</h3>
        <ul class="c_p1">
            <li>
                <label>
                    <input type="checkbox" class="c_check">
                    <span>전체선택(0/0)</span>
                </label>
            </li>
        </ul>
        <p>장바구니에 담긴 상품이 없습니다.</p>
    </div>

    <div class="cbottom">
        <ul>
            <li>주문수량</li>
            <li>상품금액</li>
            <li>배송비</li>
            <li class="cb_1">결제예정금액</li>
        </ul>

        <ul>
            <li class="cm"><?= number_format($totalQuantity) ?>개</li>
            <li><?= number_format($totalPrice) ?>원</li>
            <li class="cm">0원</li>
            <li class="cb_1"><?= number_format($totalPrice) ?>원</li>
        </ul>
    </div>

    <div class="cartbutton">
        <a href="../order.html">주문하기</a>
    </div>

    <?php include "bar.php"; ?>
</body>
</html>