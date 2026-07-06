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
    <link rel="stylesheet" href="../css/member.css ">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">

  <script>
    function check_input() {
        if(!document.member_form.name.value) {
            alert("?´ë¦„???…ë ¥?˜ì„¸??);
            document.member_form.name.focus();
            return false;
        }

        if(!document.member_form.hp.value) {
            alert("?´ë???ë²ˆí˜¸ë¥??…ë ¥?˜ì„¸??")
            document.member_form.hp.focus();
            return false;
        }

        const rel=/^(?=.*[a-zA-Z])(?=.*[0-9]).{6,12}$/;
        const id = document.member_form.id.value;
        if(!document.member_form.id.value) {
            alert("?„ì´?”ë? ?…ë ¥?˜ì„¸??);
            document.member_form.id.focus();
            return false;
        }else if(!rel.test(id)){
            alert("6~12?ì˜ ?ë¬¸???«ì ?¼í•©?´ì„œ ?¬ìš©?????ˆìŠµ?ˆë‹¤");
            return false;
        }

        if(!document.member_form.pass.value) {
            alert("ë¹„ë?ë²ˆí˜¸ë¥??…ë ¥?˜ì„¸??)
            document.member_form.pass.focus();
            return false;
        }

        if(!document.member_form.pass_confirm.value) {
            alert("ë¹„ë?ë²ˆí˜¸ë¥??…ë ¥?˜ì„¸??);
            document.member_form.pass_confirm.focus();
            return false;
        }

        if(document.member_form.pass.value != document.member_form.pass_confirm.value) {
            alert("ë¹„ë?ë²ˆí˜¸ê°€ ?¼ì¹˜?˜ì? ?ŠìŠµ?ˆë‹¤ \n ?¤ì‹œ ?…ë ¥?´ì£¼?¸ìš”");
            document.member_form.pass.focus();
            document.member_form.pass.select();
            return false;
        }

        if(!document.member_form.email.value) {
            alert("?´ë©”?¼ì„ ?…ë ¥?˜ì„¸??)
            document.member_form.email.focus();
            return false;
        }

        if(!document.member_form.addr.value) {
            alert("ì£¼ì†Œë¥??…ë ¥?´ì£¼?¸ìš”")
            document.member_form.addr.focus();
            return false;
        }

        if(!document.member_form.addr_detail.value) {
            alert("?ì„¸ì£¼ì†Œë¥??…ë ¥?´ì£¼?¸ìš”")
            document.member_form.addr_detail.focus();
            return false;
        }

        document.member_form.submit();
    }

    function reset_form() {
        document.member_form.name.value = "";
        document.member_form.hp.value = "";
        document.member_form.pass.value = "";
        document.member_form.pass_confirm.value = "";
        document.member_form.email.value = "";
        document.member_form.addr.value = "";
        document.member_form.addr_detail.value = "";

        document.member_form.id.focus();

        return;
    }
  </script>
</head>


<body>
    <div class="memtop">
        <a href="../main.html">
            <button>&larr;</button>
        </a>
        <h2>?Œì›ê°€??/h2>
    </div>
<form name="member_form" method="post" action="insert.php" onsubmit="return check_input();">
    <section class="member">
        <img src="../img/mem_bn.png" alt="?Œì›ê°€??ë°°ë„ˆ">

        <div class="memgroup">
            <p>
                <label for="name">?±ëª…</label>
                <input type="text" placeholder="?±ëª…?…ë ¥" id="name" name="name">
            </p>

            <p>
                <label for="ph">?´ë??°ë²ˆ??/label>
                <input type="tel" maxlength="11" name="hp" placeholder="'-'???œì™¸?˜ê³  ?…ë ¥">
            </p>

            <p>
                <label for="id">?„ì´??/label>
                <input type="text" maxlength="12" placeholder="?ë¬¸,?«ì ì¡°í•© 6~12??
                    name="id" id="id" >
            </p>

            <p>
                <label for="pwd">ë¹„ë?ë²ˆí˜¸</label>
                <input type="password" maxlength="16" name="pass" id="pwd"
                        placeholder="?ë¬¸,?«ì ì¡°í•© 8~16?? >
            </p>

            <p>
                <label for="pwd">ë¹„ë?ë²ˆí˜¸ ?•ì¸</label>
                <input type="password" maxlength="16" name="pass_confirm" id="pwd1"
                         placeholder="ë¹„ë?ë²ˆí˜¸ ?¬ì…?? >
            </p>

             <p>
                <label for="email">?´ë©”??/label>
                <input type="email" name="email" id="email" placeholder="?´ë©”???…ë ¥">
            </p>

            <div class="addr-group">
                <label>ì£¼ì†Œ</label>

                <input type="text" name="addr" placeholder="ì£¼ì†Œ ?…ë ¥">

                <input type="text" name="addr_detail" placeholder="?ì„¸ì£¼ì†Œ ?…ë ¥">
            </div>
        </div>
    </section>

     <div class="mem_btn">
        <button type="submit">ê°€?…í•˜ê¸?/button>
    </div>
</form>
</body>
    

</html>
