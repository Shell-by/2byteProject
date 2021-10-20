<?php 
session_save_path("./sess");
// 이렇게 하면 세션을 내가 저장하고 싶은 sess 폴더에서 저장하고 관리할  수 있습니다<div class=""></div>
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

<body >
    <div class="container"> 
<?
    $id = $_SESSION["user_id"];
    $state = $_SESSION["user_state"]; // 이제 로그인 되었을 때 세션에, 있는 값으로 $state 값이 결정이 되었어요<div class=""></div>

    if($id)
    {   // 로그인 되어 있으니까.. 페이지 보인다.
        
        // $state가 있다는 말은 값이 1이상이니까 관리자인 경우에는...관리자 페이지가 아래에 있네요
        if($state){

            $user_name = $_SESSION["user_name"];
            ?>
                <div class="row rowLine">
                    <div class="col">
                        <h4><span class="badge badge-danger"><?=$user_name?></span> 님 사용중</h4>
                    </div>
                </div>
                <div class="row rowLine">
                        <div class="col text-right">
                            <a href="logout1.php">로그 아웃</a>
                        </div>
                </div>

                <div class="row rowLine">
                        <div class="col text-right">
                            <a href="CNPW.php">비번 변경</a>
                        </div>
                </div>

                <div class="row rowLine">
                        <div class="col text-right">
                            <a href="passOrRefusal.php">승인 심사</a>
                        </div>
                </div>

                <div class="row rowLine">
                        <div class="col text-right">
                            <a href="ulch.php">기록 확인</a>
                        </div>
                </div>
            <?
            /*

            echo "
            <h2>$user_name (관리자)님 로그인중</h2>
            <h2 style='text-align : right;'> <a href='logout1.php'>로그아웃</a> </h2>
            <h2 style='text-align : right;'> <a href='CNPW.php'>비밀번호 변경</a> </h2>
            <h2 style='text-align : right;'> <a href='passOrRefusal.php'>승인/거부</a> </h2>
            <h2 style='text-align : right;'> <a href='ulch.php'>기록 확인</a> </h2>
            ";
            */

        }else{

            $user_name = $_SESSION["user_name"];
            ?>
                <div class="row rowLine">
                    <div class="col">
                        <h4><span class="badge badge-primary"><?=$user_name?></span> 님 사용중</h4>
                    </div>
                </div>
                <div class="row rowLine">
                        <div class="col text-right">
                            <a href="logout1.php">로그 아웃</a>
                        </div>
                </div>

                <div class="row rowLine">
                        <div class="col text-right">
                            <a href="CNPW.php">비번 변경</a>
                        </div>
                </div>

                <div class="row rowLine">
                        <div class="col text-right">
                            <a href="upload.php">인증 등록</a>
                        </div>
                </div>

                <div class="row rowLine">
                        <div class="col text-right">
                            <a href="ulch.php">기록 확인</a>
                        </div>
                </div>
            <?
            /*
            echo "
            <h2>$user_name 님 로그인중</h2>
            <h2 style='text-align : right;'> <a href='logout1.php'>로그아웃</a> </h2>
            <h2 style='text-align : right;'> <a href='CNPW.php'>비밀번호 변경</a> </h2>
            <h2 style='text-align : right;'> <a href='upload.php'>업로드</a> </h2>
            <h2 style='text-align : right;'> <a href='ulch.php'>기록 확인</a> </h2>
            ";
            */

        }
        // 이렇게만 하면 구분이 되네요..한번 다 저장하고 
        // 1. 사용자 로그인 후 화면 보고, 로그아웃
        // 2. 관리자 로그인 후 화면 보여주세요
        // 로그아웃 링크 클릭하면 logout1.php 파일로 이동, 그 파일도 HTML 머리부분 넣어준다.


    }else // 로그인 안되었으니까, 로그인하는 폼 그린다
        echo "
        <script>
            location.href='login.php'
        </script>
        "


?>

</div> <!-- container -->
</body>
</html>
<?
    mysql_close($conn); // 접속했으니 끊는다.
?>
<?/*

        // 여기서 login_check로 이동하니까, login_check파일도 HTML코드가 있어야 한글이 안깨지겠죠?
        ?>
            
            <form name="myForm" method="POST" action="login_check.php">
            <h3 style="color: white;">ID</h3>
            <input type="text" name="id" value="" required placeholder="ID를 입력하세요"> <br>
            <h3 style="color: white;">PASSWORD</h3>
            <input type="password" name="pw" placeholder="비밀번호를 입력하세요"><br><br>
            <input type="submit" value="로그인" class="blue"><br>
            </form>
        <?
*/
?>