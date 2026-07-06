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
            alert('[?ˆí‡´?±ê³µ] ?•ìƒ?ìœ¼ë¡??Œì›?ì„œ ?ˆí‡´?˜ì…¨?µë‹ˆ??');
            location.href='../main.html';
        </script>
    ")
?>