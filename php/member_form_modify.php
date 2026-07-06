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
        <h2>?åÏõê?ïÎ≥¥</h2>
    </header>

<form name="member_form_modify" method="post" action="modify.php" onsubmit="return check_input();">
<div class="modi-wrap">
    <section class="modify">
        <div class="modi-group">
            <p>
                <label for="name">?±Î™Ö</label>
                <input type="text" id="name" name="name" value="<?=$row['name']?>"  readonly>
            </p>

            <p>
                <label for="ph">?¥Î??∞Î≤à??/label>
                <input type="tel" maxlength="11" id="ph" name="ph" value="<?=$row['hp']?>" readonly>
            </p>

            <p>
                <label for="id">?ÑÏù¥??/label>
                <input type="text" maxlength="12" name="id" id="id" value="<?=$row['id']?>"  readonly>
            </p>

            <p>
                <label for="pwd">ÎπÑÎ?Î≤àÌò∏</label>
                <input type="password" maxlength="16" name="pass" id="pwd"
                        placeholder="?ÅÎ¨∏,?´Ïûê Ï°∞Ìï© 8~16?? >
            </p>

            <p>
                <label for="pwd1">ÎπÑÎ?Î≤àÌò∏ ?ïÏù∏</label>
                <input type="password" maxlength="16" name="pass_confirm" id="pwd1">
            </p>

             <p>
                <label for="email">?¥Î©î??/label>
                <input type="email" name="email" id="email" placeholder="?¥Î©î???ÖÎ†•"
                                value="<?=$row['email']?>">
            </p>

            <div class="addr-group">
                <label>Ï£ºÏÜå</label>
                <input type="text" name="addr" placeholder="Ï£ºÏÜå ?ÖÎ†•"
                            value="<?=$row['addr']?>">

                <label for="addr_detail" class="blind">?ÅÏÑ∏Ï£ºÏÜå</label>
                <input type="text" name="addr_detail" placeholder="?ÅÏÑ∏Ï£ºÏÜå ?ÖÎ†•">
            </div>
        </div>
    </section>

    <button class="delete" type="button" onclick="location.href='member_delete.php'">
        ?åÏõê?àÌá¥?òÍ∏∞</button>

    <div class="modi_btn">
        <button type="button" onclick="history.back()">?¥Ï†Ñ</button>
        <button type="submit">?ïÏù∏</button>
    </div>
</div>
</form>
</body>


<?php
include "bar.php";
?>
</html>
