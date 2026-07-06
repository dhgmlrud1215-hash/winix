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
    <link rel="stylesheet" href="../css/member_modify.css?v=2">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
</head>

<body>
<?php
    include "dbconn.php";
    mysqli_query($connect,'set names utf8');

    $sql = "select * from winix where id = '$_SESSION[userid]'";
    $result = mysqli_query($connect,$sql);
    $row = mysqli_fetch_array($result);
    mysqli_close($connect);
?>

    <header class="moditop">
        <a href="../main.html">
            <button>&larr;</button>
        </a>
        <h2>회원정보</h2>
    </header>

<form name="member_form_modify" method="post" action="modify.php" onsubmit="return check_input();">
<div class="modi-wrap">
    <section class="modify">
        <div class="modi-group">
            <p>
                <label for="name">성명</label>
                <input type="text" id="name" name="name" value="<?=$row['name']?>"  readonly>
            </p>

            <p>
                <label for="ph">휴대폰번호</label>
                <input type="tel" maxlength="11" id="ph" name="ph" value="<?=$row['hp']?>" readonly>
            </p>

            <p>
                <label for="id">아이디</label>
                <input type="text" maxlength="12" name="id" id="id" value="<?=$row['id']?>"  readonly>
            </p>

            <p>
                <label for="pwd">비밀번호</label>
                <input type="password" maxlength="16" name="pass" id="pwd"
                        placeholder="영문,숫자 조합 8~16자" >
            </p>

            <p>
                <label for="pwd1">비밀번호 확인</label>
                <input type="password" maxlength="16" name="pass_confirm" id="pwd1">
            </p>

             <p>
                <label for="email">이메일</label>
                <input type="email" name="email" id="email" placeholder="이메일 입력"
                                value="<?=$row['email']?>">
            </p>

            <div class="addr-group">
                <label>주소</label>
                <input type="text" name="addr" placeholder="주소 입력"
                            value="<?=$row['addr']?>">

                <label for="addr_detail" class="blind">상세주소</label>
                <input type="text" name="addr_detail" placeholder="상세주소 입력">
            </div>
        </div>
    </section>

    <button class="delete" type="button" onclick="location.href='member_delete.php'">
        회원탈퇴하기</button>

    <div class="modi_btn">
        <button type="button" onclick="history.back()">이전</button>
        <button type="submit">확인</button>
    </div>
</div>
</form>
</body>


<?php
include "bar.php";
?>
</html>
