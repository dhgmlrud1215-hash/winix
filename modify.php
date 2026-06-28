<?php
session_start();
?>

<meta charset="utf-8">

<?php
$name = $_POST['name'];
$hp = $_POST['hp'];
$userid = $_POST['id'];
$pass = $_POST['pass'];
$pass_confirm = $_POST['pass_confirm'];
$email = $_POST['email'];
$addr = $_POST['addr'];
$addr_detail = $_POST['addr_detail'];

include "dbconn.php";
mysqli_query($connect, 'set names utf8');

$sql = "update winix set name='$name', hp='$hp' ,pass='$pass',";
$sql .= "email='$email', addr='$addr', addr_detail='$addr_detail' where id ='$_SESSION[userid]'";

if($pass != $pass_confirm) {
    echo ("
        <script>
            alert('비밀번호가 일치하지 않습니다.');
            history.go(-1);
        </script>
    ");
    exit;
}

$sql = "update winix set pass='$pass', email='$email', addr='$addr', addr_detail='$addr_detail' where id='$_SESSION[userid]'";

$result = mysqli_query($connect, $sql);

mysqli_close($connect);
echo "
    <script>
        alert('회원정보 수정이 완료되었습니다.')
        location.href = 'mypage.php';
    </script>
";
?>