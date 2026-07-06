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
            alert("이름을 입력하세요");
            document.member_form.name.focus();
            return false;
        }

        if(!document.member_form.hp.value) {
            alert("휴대폰 번호를 입력하세요.")
            document.member_form.hp.focus();
            return false;
        }

        const rel=/^(?=.*[a-zA-Z])(?=.*[0-9]).{6,12}$/;
        const id = document.member_form.id.value;
        if(!document.member_form.id.value) {
            alert("아이디를 입력하세요");
            document.member_form.id.focus();
            return false;
        }else if(!rel.test(id)){
            alert("6~12자의 영문자,숫자 혼합해서 사용할 수 있습니다");
            return false;
        }

        if(!document.member_form.pass.value) {
            alert("비밀번호를 입력하세요")
            document.member_form.pass.focus();
            return false;
        }

        if(!document.member_form.pass_confirm.value) {
            alert("비밀번호를 입력하세요");
            document.member_form.pass_confirm.focus();
            return false;
        }

        if(document.member_form.pass.value != document.member_form.pass_confirm.value) {
            alert("비밀번호가 일치하지 않습니다 \n 다시 입력해주세요");
            document.member_form.pass.focus();
            document.member_form.pass.select();
            return false;
        }

        if(!document.member_form.email.value) {
            alert("이메일을 입력하세요")
            document.member_form.email.focus();
            return false;
        }

        if(!document.member_form.addr.value) {
            alert("주소를 입력해주세요")
            document.member_form.addr.focus();
            return false;
        }

        if(!document.member_form.addr_detail.value) {
            alert("상세주소를 입력해주세요")
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
        <h2>회원가입</h2>
    </div>
<form name="member_form" method="post" action="insert.php" onsubmit="return check_input();">
    <section class="member">
        <img src="../img/mem_bn.png" alt="회원가입 배너">

        <div class="memgroup">
            <p>
                <label for="name">성명</label>
                <input type="text" placeholder="성명입력" id="name" name="name">
            </p>

            <p>
                <label for="ph">휴대폰번호</label>
                <input type="tel" maxlength="11" name="hp" placeholder="'-'을 제외하고 입력">
            </p>

            <p>
                <label for="id">아이디</label>
                <input type="text" maxlength="12" placeholder="영문,숫자 조합 6~12자"
                    name="id" id="id" >
            </p>

            <p>
                <label for="pwd">비밀번호</label>
                <input type="password" maxlength="16" name="pass" id="pwd"
                        placeholder="영문,숫자 조합 8~16자" >
            </p>

            <p>
                <label for="pwd">비밀번호 확인</label>
                <input type="password" maxlength="16" name="pass_confirm" id="pwd1"
                         placeholder="비밀번호 재입력" >
            </p>

             <p>
                <label for="email">이메일</label>
                <input type="email" name="email" id="email" placeholder="이메일 입력">
            </p>

            <div class="addr-group">
                <label>주소</label>

                <input type="text" name="addr" placeholder="주소 입력">

                <input type="text" name="addr_detail" placeholder="상세주소 입력">
            </div>
        </div>
    </section>

     <div class="mem_btn">
        <button type="submit">가입하기</button>
    </div>
</form>
</body>
    

</html>
