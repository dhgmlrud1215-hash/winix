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
    <link rel="stylesheet" href="../css/cart.css?v=21">
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
                    <input type="checkbox" class="c_check cart-select-all" checked>
                    <span id="cart-select-label">전체선택(<?= count($items) ?>/<?= count($items) ?>)</span>
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
                <div class="cart-product-main">
                    <label class="cart-check">
                        <input type="checkbox" class="c_check cart-item-check" checked data-cart-id="<?= intval($item['cart_id']) ?>" data-quantity="<?= intval($item['quantity']) ?>" data-subtotal="<?= intval($item['subtotal']) ?>">
                        <span class="blind"><?= htmlspecialchars($item['name']) ?> 선택</span>
                    </label>
                    <img class="cart-product-img" src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                    <div class="cart-product-info">
                        <p class="cart-product-name"><?= htmlspecialchars($item['name']) ?></p>
                        <p class="cart-product-model"><?= htmlspecialchars($item['model']) ?></p>
                        <p class="cart-product-meta">수량 <?= intval($item['quantity']) ?>개</p>
                        <p class="cart-product-price"><?= number_format($item['subtotal']) ?>원</p>
                    </div>
                </div>

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
                        <button type="submit" class="cart-delete-btn">삭제</button>
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
            <li class="cm"><span id="cart-total-quantity"><?= number_format($totalQuantity) ?></span>개</li>
            <li><span id="cart-total-price"><?= number_format($totalPrice) ?></span>원</li>
            <li class="cm">0원</li>
            <li class="cb_1"><span id="cart-final-price"><?= number_format($totalPrice) ?></span>원</li>
        </ul>
    </div>

    <div class="cartbutton">
        <a href="order.php" id="cart-order-link">주문하기</a>
    </div>

<script>
(function () {
    const selectAll = document.querySelector('.cart-select-all');
    const itemChecks = Array.from(document.querySelectorAll('.cart-item-check'));
    const selectLabel = document.querySelector('#cart-select-label');
    const totalQuantity = document.querySelector('#cart-total-quantity');
    const totalPrice = document.querySelector('#cart-total-price');
    const finalPrice = document.querySelector('#cart-final-price');
    const orderLink = document.querySelector('#cart-order-link');

    function formatNumber(value) {
        return Number(value).toLocaleString('ko-KR');
    }

    function updateCartSummary() {
        const checkedItems = itemChecks.filter((checkbox) => checkbox.checked);
        const quantity = checkedItems.reduce((sum, checkbox) => sum + Number(checkbox.dataset.quantity || 0), 0);
        const price = checkedItems.reduce((sum, checkbox) => sum + Number(checkbox.dataset.subtotal || 0), 0);
        const ids = checkedItems.map((checkbox) => checkbox.dataset.cartId).filter(Boolean);

        if (totalQuantity) totalQuantity.textContent = formatNumber(quantity);
        if (totalPrice) totalPrice.textContent = formatNumber(price);
        if (finalPrice) finalPrice.textContent = formatNumber(price);
        if (selectLabel) selectLabel.textContent = `전체선택(${checkedItems.length}/${itemChecks.length})`;

        if (selectAll) {
            selectAll.checked = itemChecks.length > 0 && checkedItems.length === itemChecks.length;
        }

        if (orderLink) {
            orderLink.href = ids.length > 0 ? `order.php?items=${ids.join(',')}` : '#';
            orderLink.classList.toggle('disabled', ids.length === 0);
        }
    }

    if (selectAll) {
        selectAll.addEventListener('change', function () {
            itemChecks.forEach((checkbox) => {
                checkbox.checked = selectAll.checked;
            });
            updateCartSummary();
        });
    }

    itemChecks.forEach((checkbox) => {
        checkbox.addEventListener('change', updateCartSummary);
    });

    if (orderLink) {
        orderLink.addEventListener('click', function (event) {
            if (itemChecks.length > 0 && !itemChecks.some((checkbox) => checkbox.checked)) {
                event.preventDefault();
                alert('주문할 상품을 선택해주세요.');
            }
        });
    }

    updateCartSummary();
})();
</script>

    <?php include "bar.php"; ?>
</body>
</html>