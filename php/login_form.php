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
        <h2>로그??/h2>
    </div>

<form name="login_form" method="post" action="login.php"> 
    <div class="login-wrap">
    <section class="login">
        <div class="logingroup">
            <p>
                <label for="id">?�이??/label>
                <input type="text" maxlength="12" placeholder="?�이???�력"
                    name="id" id="id" >
            </p>

            <p>
                <label for="pwd">비�?번호</label>
                <input type="password" maxlength="16" name="pass" id="pwd"
                        placeholder="?�문,?�자�?조합?�서 ?�력?�주?�요.(8~16??" >
            </p>
        </div>

        <div class="login_btn">
            <button>로그??/button>
        </div>
    </section>

    <div class="login_menu">
        <a href="member_form.php">?�원가??/a>
        <span>|</span>
        <a href="#">?�이??/a>
        <span>|</span>
        <a href="#">비�?번호</a>
    </div>

    <div class="login_sns">
        <ul>
            <li class="apple">
                <img src="../img_login/log_apple.png" alt="Apple 로그??>
                <a href="#">Apple 로그??/a>
            </li>

            <li>
                <img src="../img_login/log_ka.png" alt="카카??로그??>
                <a href="#">카카??로그??/a>
            </li>

            <li class="naver">
                <img src="../img_login/log_n.png" alt="?�이�?로그??>
                <a href="#">?�이�?로그??/a>
            </li>

            <li><a href="#">비회??주문조회</a></li>
        </ul>
    </div>
</div>
</form>

<?php include "bar.php"; ?>

</body>

</html>
