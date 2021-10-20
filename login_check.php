<?php
    // 나중에 왜 로그인이 안되는지 확인하기 위해서
    // sess 폴더에 세션정보를 저장하고 있어요.

    session_save_path("./sess");
    session_start();
    #DB connect
    include("dbconn.php");

    // 아래처럼 메타정보에 UTF-8을 표시해줘야 한글이 안깨지겠죠.
?>
<!doctype html>
<html lang="ko">
    <head>
        <meta charset="utf-8" />
        <title>3C 등산 인증</title>
        <link rel="stylesheet" href="2byteproject.css">
    </head>
<body>

<?
    $id = addslashes($_POST['id']);
    $pw = addslashes($_POST['pw']);

    // 사실은 여기서 이렇게 검사하는게 아니고, 글자수 등을 계산해서 검사해야하는데, 일단은 이정도면 상관없어요.

    #null instance chk
// 아 여기도 메타정보가 없어서 생긴문제네요.


    if($id and $pw)
    {
        // 아이디와 비번이 맞는 데이터를 찾아라.
        $sql = "select * from test where id = '$id' and password = password('$pw')";
        $result = mysql_query($sql);
        $data = mysql_fetch_array($result);

        if($data) 
        {
            // 데이터가 있다는 말은 아이디와 비번이 일치하는 데이터가 있으니 그 데이터의 값을 가져와, 세션에 저장한다
            $_SESSION["user_id"] = $data["id"];
            $_SESSION["user_name"] = $data["name"];
            $_SESSION["user_state"] = $data["state"];
            // 이렇게 하면 로그인이 되는 순간, 세션의 user_state값을 보면 1 또는 0이 결정되겠죠?
            // 그럼 메인페이지로 가볼께요<div class=""></div>

            $msg = $data["name"]."님 반갑습니다.";
        }else
        {
            // 데이터가 없으면 로그인 실패
            $msg = "아이디와 비번이 맞지 않습니다.";
        }

        // alert로 성공 또는 실패 여부를 msg 값 보고 출력한 후 첫페이지인 main.php 파일로 이동
        echo "
            <script>
                alert('$msg');
                location.href='main.php';
            </script>
        ";

        // 로그인 성공하거나 실패하면 첫페이지로 이동

    }else{
            // 아이디와 비번이 빈값이 있으니까 아예 다른 에러
        echo "
            <script>
                alert('아이디와 비번이 없습니다.');
                location.history(-1);
            </script>
        ";
    }

?>
</body>
</html>