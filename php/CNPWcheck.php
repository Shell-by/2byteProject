<?
session_save_path("./sess");
session_start();
include("dbconn.php");
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
        $id = $_SESSION['user_id'];
        $pw = $_POST['oldpass'];
        $npw1 = $_POST['newpass1'];
        $npw2 = $_POST['newpass2'];

        $sq = "select password from test where password = password('$pw')";
        $resul =  mysql_query($sq);
        $dat = mysql_fetch_array($resul);

        if($dat){

            if($npw1 == $npw2){

                    $sql = "update test set password = password('$npw1') where id = '$id'";
                    $result = mysql_query($sql);
    
                echo"
                <script>
                    alert('변경 되었습니다.');
                    location.href='main.php';
                </script>
                ";
    
            }

        }else{
            echo "
            <script>
                alert('잘못 입력되었습니다.');
                location.href='CNPW.php';
            </script>
            ";
        }
        
    ?>
</body>
</html>