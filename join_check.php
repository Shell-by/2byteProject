<?php
#DB connect
  include("dbconn.php");
    session_save_path("./sess");
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
    session_start();
  $id = $_POST['id'];
  $pw = $_POST['pw'];
  $nm = $_POST['nm'];
  #null instance chk
  if(!$id || !$pw)
  {
    echo "<script>alert('No NULL values...');history.back();</script>";
    exit();
  }
  #same id check
  $chk = "SELECT * FROM test WHERE id='$id'";
  $res = mysql_query($conn, $chk);
  $data = mysql_fetch_row($res);

  $pas = crypt($pw);

  if ($data != 0) {
    echo "<script>alert('ID already Exists...');history.back();</script>";
    exit();
  }
  else{
    $sql = "INSERT INTO test (id, password, name, state) VALUES ('$id',password('$pw'),'$nm', '0')";
    $result = mysql_query($sql);
    $data = mysql_fetch_row($result);

    echo "
            <script>
                alert('성공');
                location.href='main.php';
            </script>
        ";
    #login 처리
    //echo "<meta http-equiv='refresh' content='0;url=login.php'>";
  }

  mysql_close($conn);

 ?>