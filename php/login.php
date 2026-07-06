<?php
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'secure' => true,      // HTTPS ?ÑÏàò
    'httponly' => true,
    'samesite' => 'None'
]);

session_start();
?>

<meta charset="utf-8">

<?php
$id = $_POST['id'];
if(!$id) {
    echo ("
        <script>
            window.alert('?ÑÏù¥?îÎ? ?ÖÎ†•?òÏÑ∏??);
            history.go(-1);
        </script>    
    ");
    exit;
}

$pass = $_POST['pass'];
if(!$pass) {
    echo ("
        <script>
            window.alert('ÎπÑÎ?Î≤àÌò∏Î•??ÖÎ†•?òÏÑ∏??);
            history.go(-1);
        </script>    
    ");
    exit;
}

include "dbconn.php";
mysqli_query($connect, 'set names utf8');

$sql = "select * from winix where id = '$id'";
$result = mysqli_query($connect,$sql);
$num_match = mysqli_num_rows($result);

if(!$num_match) {
    echo ("
        <script>
            window.alert('?±Î°ù?òÏ? ?äÏ? ?ÑÏù¥?îÏûÖ?àÎã§');
            history.go(-1);
        </script>    
    ");
        exit;
    }
    
    $row = mysqli_fetch_array($result);
    $db_pass = $row['pass'];

    if($pass != $db_pass) {
        echo ("
            <script>
                window.alert('ÎπÑÎ?Î≤àÌò∏Í∞Ä ?ÄÎ¶ΩÎãà??);
                history.go(-1);
            </script>
        ");
        exit;
    }

    $_SESSION['userid'] = $row['id'];
    $_SESSION['username'] = $row['name'];


    mysqli_close($connect);

    echo("
        <script>
            location.href='../main.html';
        </script>
    ");

?>