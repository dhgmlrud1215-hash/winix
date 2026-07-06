<?php
session_start();
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
    <link rel="stylesheet" href="../css/login.css">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
</head>


<body>
    <div class="logintop">
        <a href="../main.html">
            <button>&larr;</button></a>
        <h2>로그인</h2>
    </div>

<form name="login_form" method="post" action="login.php"> 
    <div class="login-wrap">
    <section class="login">
        <div class="logingroup">
            <p>
                <label for="id">아이디</label>
                <input type="text" maxlength="12" placeholder="아이디 입력"
                    name="id" id="id" >
            </p>

            <p>
                <label for="pwd">비밀번호</label>
                <input type="password" maxlength="16" name="pass" id="pwd"
                        placeholder="영문,숫자를 조합해서 입력해주세요.(8~16자)" >
            </p>
        </div>

        <div class="login_btn">
            <button>로그인</button>
        </div>
    </section>

    <div class="login_menu">
        <a href="member_form.php">회원가입</a>
        <span>|</span>
        <a href="#">아이디</a>
        <span>|</span>
        <a href="#">비밀번호</a>
    </div>

    <div class="login_sns">
        <ul>
            <li class="apple">
                <img src="../img_login/log_apple.png" alt="Apple 로그인">
                <a href="#">Apple 로그인</a>
            </li>

            <li>
                <img src="../img_login/log_ka.png" alt="카카오 로그인">
                <a href="#">카카오 로그인</a>
            </li>

            <li class="naver">
                <img src="../img_login/log_n.png" alt="네이버 로그인">
                <a href="#">네이버 로그인</a>
            </li>

            <li><a href="#">비회원 주문조회</a></li>
        </ul>
    </div>
</div>
</form>

<?php include "bar.php"; ?>

</body>

</html>
