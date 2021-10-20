<?
session_save_path("./sess");
session_start();
?>
<!doctype html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>3C 등산 인증</title>
    <meta name="viewport" content="width=device-width, maximum-scale=3.0, user-scalable=yes">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body>

    <form name="myForm" method="POST" action="CNPWcheck.php">

        <div class="row rowLine">
            <div class="col">
                <h3 class="text-primary"><span class="material-icons">admin_panel_settings</span> 비밀번호 변경</h3>
            </div>
        </div>

        <div class="row rowLine">
            <div class="col-1"></div>
            <div class="col-4 text-center">password</div>
            <div class="col-6">
                <input type="password" name="oldpass" value="" required placeholder="기존 비밀번호를 입력하세요" class="form-control">
            </div>
            <div class="col-2"></div>
        </div>

        <div class="row rowLine">
            <div class="col-1"></div>
            <div class="col-4 text-center">new password</div>
            <div class="col-6">
                <input type="password" name="newpass1" value="" required placeholder="새 비밀번호를 입력하세요" class="form-control">
            </div>
            <div class="col-2"></div>
        </div>

        <div class="row rowLine">
            <div class="col-1"></div>
            <div class="col-4 text-center">new password</div>
            <div class="col-6">
                <input type="password" name="newpass2" value="" required placeholder="다시 비밀번호를 입력하세요" class="form-control">
            </div>
            <div class="col-2"></div>
        </div>

        <div class="row rowLine">
        <div class="col text-center">
            <button type="submit" class="btn btn-primary">
                <span class="material-icons">published_with_changes</span> 변경하기
            </button>

            <button type="button" class="btn btn-primary" onclick="location.href='main.php'">
                <span class="material-icons">home</span> 
            </button>
        </div>
    </div>

    </form>
</body>

</html>