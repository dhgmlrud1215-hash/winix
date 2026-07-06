<?php
    session_start();
?>

<meta charset="utf-8">

<?php
    include "dbconn.php";

    $sql= "delete from winix where id='$_SESSION[userid]'";

    unset($_SEESION['userid']);
    session_destroy();

    mysqli_query($connect,$sql);
    mysqli_close($connect);

    echo ("
        <script>
            alert('[탈퇴성공] 정상적으로 회원에서 탈퇴하셨습니다.');
            location.href='../main.html';
        </script>
    ")
?>