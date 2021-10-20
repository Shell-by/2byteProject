<?php 
session_save_path("./sess");
session_start();
include "dbconn.php";
?>
<!doctype html>
<html lang="ko">
    <head>
        <meta charset="UTF-8">
        <title>3C 등산 인증</title>
        <meta name="viewport"
        content="width=device-width, maximum-scale=3.0, user-scalable=yes">
        <link href="css/style.css" rel="stylesheet" type="text/css"> 
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> 
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    </head>
<body>

    <div class="container">

<?php
    if($_SESSION["user_id"])
    {
        // 이미 로그인 한 사람이니까, 첫페이지로 이동
        // 이렇게 하면, 로그인한 사람은 무조건 main으로 이동하겠죠?
        // 이제 메인페이지에 글보기라는 메뉴 만들어보세요 기록보기로 하였었는데 지금 들어가게되면 다른 페이지로 가지네요
        // OK 확인해 볼게요..그 파일이 뭔가요?
        echo "
        <script>
            location.href='main.php';
        </script>
        ";
    }


?>

    <form name="myForm" method="POST" action="login_check.php">
    <div class="row rowLine">
        <div class="col">
            <h3 class="text-primary"><span class="material-icons">login</span> 로그인</h3>
        </div>
    </div>

    <div class="row rowLine">
        <div class="col-3 col-md-2"></div>
        <div class="col-3 col-md-2 text-center">ID</div>
        <div class="col-6 col-md-6">
            <input type="text" name="id" value="" required placeholder="ID를 입력하세요" class="form-control">
        </div>
        <div class="col-2"></div>
    </div>
   
    <div class="row rowLine">
        <div class="col-3 col-md-2"></div>
        <div class="col-3 col-md-2 text-center">PASSWD</div>
        <div class="col-6 col-md-6  ">
            <input type="password" name="pw" value="" required placeholder=비밀번호를 입력하세요" class="form-control">
        </div>
        <div class="col-2"></div>
    </div>

    <div class="row rowLine">
        <div class="col text-center">
            <button type="submit" class="btn btn-primary">
                <span class="material-icons">done</span> 로그인
            </button>

            <button type="button" class="btn btn-primary" onclick="location.href='join.php'">
                <span class="material-icons">account_circle</span> 회원가입
            </button>
        </div>
    </div>

    </form> 

    </div> <!-- container -->
</body>
</html>