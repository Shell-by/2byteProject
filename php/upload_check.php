<?php
session_save_path("./sess");
session_start();
?>
<!doctype html>
<html lang="ko">
    <head>
        <meta charset="utf-8" >
        <title>3C 등산 인증</title>
        <link rel="stylesheet" href="2byteproject.css">
    </head>
<body>
<?

$id = $_SESSION['user_id'];

$mn = $_POST['mountain'];
$ny = $_POST['naeyong'];

$mn = htmlspecialchars($mn, ENT_QUOTES);
$ny = htmlspecialchars($ny, ENT_QUOTES);

$day = date("Y-m-d (H:i)");

$upload = "./data/";

$state = 0;

// 원래는 이렇게 하는게 맞기는 한데.. 너무 복잡한 코드네요.

$upimage_name = $_FILES["upimage"]["name"];
$upimage_tmp_name = $_FILES["upimage"]["tmp_name"];
$upimage_type = $_FILES["upimage"]["type"];
$upimage_size = $_FILES["upimage"]["size"];
$upimage_error = $_FILES["upimage"]["error"];

if($upimage_name && !$upimage_error){
    $image = explode(".", $upimage_name);
    $image_name = $image[0];
    $image_ext = $image[1];

    $new_image_name = date("Y_m_d_h_i_s"); // 파일이름 중복을 피하기 위해 년월일 등 시간정보로 이름을 바꾼다.
    $new_image_name = $new_image_name;
    $copied_image_name = $new_image_name.".".$image_ext;  // 최종 파일이름은 2021_07_29_12_34_56.jpg 처럼 저장하겠다.
    $uploaded_image = $upload.$copied_image_name;

    //여기서 파일이름 처리는 했는데, 업로드된 파일을 복사하지 않았네요. 대충 확인하기에 복사한 적이 없는데 맞나요? 네
    // 잠시만 1분만요..뭐좀 하나 확인좀 할께요

    


        // 테스트용으로 크기를 늘릴께요 저장이 안되었어요.
    if($upimage_size > 30* 1024*1024){ // 30M
        echo ("<script>
                alert('업로드 사진 크기가 지정된 용량(30MB)을 초과합니다!<br>사진 크기를 체크해주세요!');
                history.go(-1)
            </script>
            ");
            exit;
    }else
    {
        move_uploaded_file($_FILES["upimage"]["tmp_name"], "data/$copied_image_name");
        // 업로드된 파일을 data 폴더에 $copied_image_name으로 카피한다. 된것 같아요..저장하고..실행
        // 일단 파일도 잘 저장되고 있죠?
        //그럼 뭐를 더 해야 하는가?
        // 지금 문제는 성공이라는 메시지를 보인다음에.. 이상한 페이지로 이동하는 것도 문제인데,,,
        // 이 파일은 세션스타트를 하지만 적용이 안되요..왜냐? 세션의 위치가 다르기 때문에..그런것이고요..입력한 이름이 깨지지죠? 내용하고?

    }
}

else{
    $upimage_name = "";
    $upimage_type = "";
    $copied_image_name = "";
}

include "dbconn.php";

// 이녀석은 코드가 완전히 같아서 test1 -> test2로 바꾸면 동작은 같고, 자동으로 idx가 시스템에서 넣어줄꺼에요
// 이제 저장하고 승인신청 두개 해주세요

$sql = "INSERT INTO test2 (date, id, mountain, ny, image_name, image_type, image_copied, state) 
VALUES ('$day', '$id', '$mn', '$ny', ' $upimage_name', '$upimage_type', '$copied_image_name', '$state') ";
$result = mysql_query($sql);

if($result){
    $msg = "성공";
}else{
    $msg = "실패";
}

mysql_close($conn);
// 여기서 잠깐 페이지 이동을 막고,, DB에 넣는 부분이 잘 들어가는지 확인해 봅시다
/*
    지금 무엇을 확인한거냐면.. 쿼리를 phpmyadmin에서 하면 잘 되는데, 프로그램으로 넣으니까 에러가 발생한 것을 확인한 거에요.
    한번 실행해보세요..저장후
    이제..정상적으로 한번 입력해 봅시다..파일도 확인해보고 
*/
//echo "SQL = $sql <br>"; // 다시 실행..저장후

echo "
    <script>
        alert('$msg');
            location.href='main.php'
    </script>
";

// 이렇게 하면 될 것 같아요..실행해보세요<div class=""></div>
// 이제 한번 생각해봅시다... 
// 한글이 깨지는 문제보다 더 심각한 문제가 있는데,
// 이 파일이 data/에 저장이 되는데 프로그램으로 찾으려면 해당하는 파일이 어떻게 저장되는지 확인해야 되겠죠?//
// 그런데...image_copied가 저장이 안되고 있어요.
// 일단 다시 저장후 업로드 해서 저장된 파일이 잘 되는지 확인해 봅시다.
// 일단 파일이름은 잘 저장이 되었으니, 그 파일이 해당 폴더에 저장되었는지 확인
// 파일이 저장이 안되었죠?
// 이제 왜 이 파일이 login 파일로 가는게 아니라 main.php로 가야하는 것 아닌가요? 복붙하느라 수정을 하지 못하였습니다
// 이제 프로그램은 대충 돌아가는 것 처럼 보이고요
// 이제 할 일은 업로드 된 내용을 글 보기를 하나 만들면 되겠네요
// login 파일로 이동할 때, 계속 새로 로그인하는 문제는 바꿔야겠네요<div class=""></div>


?>
