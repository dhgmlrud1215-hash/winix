<?php
    session_start();

    if(!isset($_SESSION['userid'])) {
        echo("
            <script>
                alert('로그인 후 이용해주세요');
                location.href='login_form.php';
            </script>
        ");
        exit;
    }

    $userid = $_SESSION['userid'];
    $username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/reset.css?v=3">
    <link rel="stylesheet" href="../css/common-menu.css?v=3">
    <script src="../js/common-menu.js?v=3" defer></script>
    <link rel="stylesheet" href="../css/mypage.css">
     <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
</head>


<body>
<header class="mytop">
    <a href="../main.html" aria-label="이전 페이지로 이동">&larr;</a>
    <h2>WIN<span>IX</span></h2>
</header>

<div class="my-info">
    <div class="name">
        <h3><?= $username ?></h3>
        <p>
           <a href="member_form_modify.php">회원관리</a>
        </p>
    </div>
    <p><?= $username ?>님은 일반회원입니다</p>
</div>
   
<div class="my-group">
    <div class="my-produ">
        <p class="title">내가 등록한 제품</p>
        <p class="count">0개</p>
    </div>

    <div class="mypage-summary">
        <div class="summary-item">
            <p class="title">사용 가능 쿠폰</p>
            <p class="count">0개</p>
        </div>

        <div class="summary-item">
            <p class="title">내 스크랩 상품</p>
            <p class="count">0개</p>
        </div>
    </div>
</div>

<div class="my-list">
    <a href="#">배송지관리</a>
    <a href="#">주문/배송 조회</a>
    <a href="#">주문취소/반품/교환내역</a>
    <a href="#">결제수단관리</a>
</div>

<div class="btn-wrap">
    <button type="button" class="mybtn" onclick="location.href='logout.php'">
        로그아웃
    </button>
</div>
</body>

<?php
include "bar.php";
?>

</html>
