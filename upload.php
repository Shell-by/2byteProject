<?
session_save_path("./sess");
session_start();
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
        <form name="upform" method="POST" enctype="multipart/form-data" action="upload_check.php">

        <div class="row rowLine">
            <div class="col">
                <h4 class="text-primary"><span class="material-icons">edit</span> 인증데이터 올리기</h4>
            </div>
        </div>

        <div class="row rowLine">
            <div class="col-2">날짜</div>
            <div class="col">
                <input type="date" name="nz" class="form-control">
            </div>
        </div>

        <div class="row rowLine">
            <div class="col-2">제목</div>
            <div class="col">
                <input type="text" name="mountain"  required placeholder="산이름을 입력하세요" class="form-control"></input>
            </div>
        </div>
        <div class="row rowLine">
            <div class="col-2">내용</div>
            <div class="col">
                <textarea name="naeyong" rows="15" class="form-control" required placeholder="내용을 입력하세요"></textarea>
            </div>
        </div> 
        <div class="row rowLine">
            <div class="col-2">파일</div>
            <div class="col">
                <input type="file" name="upimage" class="form-control">
            </div>
        </div>      
        <div class="row rowLine">
            <div class="col text-center">
                <button type="submit" class="btn btn-primary"> <span class="material-icons">done</span> 제출</button>

                <button type="button" class="btn btn-primary" onClick="location.href='main.php'"> <span class="material-icons" >home</span></button>
            </div>    
        </div>
        </form>

    </div>

</body>
</html>

<!--
    여기서 기억할 것은 이름이 upimage 이고, multipart로 보낸다(파일이름뿐 아니라, 파일 자체가 날라가야 한다.)
--> 