<?php
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'secure' => true,      // HTTPS 필수
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
            window.alert('아이디를 입력하세요');
            history.go(-1);
        </script>    
    ");
    exit;
}

$pass = $_POST['pass'];
if(!$pass) {
    echo ("
        <script>
            window.alert('비밀번호를 입력하세요');
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
            window.alert('등록되지 않은 아이디입니다');
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
                window.alert('비밀번호가 틀립니다');
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