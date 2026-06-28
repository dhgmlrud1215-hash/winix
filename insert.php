<?php
    session_start();
?>

<meta charset= "utf-8">

<?php
$name = $_POST['name'];
$hp = $_POST['hp'];
$id = $_POST['id'];
$pass = $_POST['pass'];
$email = $_POST['email'];
$addr = $_POST['addr'];
$addr_detail = $_POST['addr_detail'];

include "dbconn.php";
mysqli_query($connect,'set names utf8');

$sql = "select * from winix where id='$id'";
$result = mysqli_query($connect,$sql);
$exist_id = mysqli_num_rows($result);

if($exist_id) {
    echo ("
        <script>
            window.alert('해당 아이디가 존재합니다.')
            history.go(-1)
        </script>
    ");
    exit;
}else{
    $sql = "insert into winix(name,hp,id,pass,email,addr,addr_detail)";
    $sql .= "values ('$name', '$hp' , '$id', '$pass', '$email', '$addr', '$addr_detail')";
    mysqli_query($connect,$sql);
}

mysqli_close($connect);
echo "
    <script>
        alert ('회원가입이 완료되었습니다');
        location.href = 'login_form.php';
    </script>
";
?>
