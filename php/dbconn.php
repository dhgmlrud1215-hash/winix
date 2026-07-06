<?php
 $connect=mysqli_connect( "localhost", "dhgmlrud00", "gksmfqhfl0912@","dhgmlrud00") or  
        die( "SQL server에 연결할 수 없습니다."); 

    mysqli_select_db($connect,"dhgmlrud00");
//localhost, username,pw,dbname
?>