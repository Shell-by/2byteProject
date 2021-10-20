<?
    session_save_path("./sess");
    session_start();
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


    $orgName = $_SESSION["user_name"];
    session_destroy();

    echo "
    <script>
        alert('$orgName 님 안녕히 가세요');
        location.href='main.php';
    </script>
    ";
?>
</body>
</html>
