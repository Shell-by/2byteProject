<!DOCTYPE html>
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
    <form name="myForm" method="POST" action="join_check.php">

      <div class="row rowLine">
        <div class="col">
          <h3 class="text-primary"><span class="material-icons">account_box</span> 회원가입</h3>
        </div>
      </div>

      <div class="row rowLine">
        <div class="col-3 col-md-2"></div>
        <div class="col-3 col-md-2 text-center">ID</div>
        <div class="col-6">
          <input type="text" name="id" value="" required placeholder="아이디를 입력하세요" class="form-control">
        </div>
        <div class="col-2"></div>
      </div>

      <div class="row rowLine">
        <div class="col-3 col-md-2"></div>
        <div class="col-3 col-md-2 text-center">password</div>
        <div class="col-6">
          <input type="password" name="pw" value="" required placeholder="비밀번호를 입력하세요" class="form-control">
        </div>
        <div class="col-2"></div>
      </div>

      <div class="row rowLine">
        <div class="col-3 col-md-2"></div>
        <div class="col-3 col-md-2 text-center">name</div>
        <div class="col-6">
          <input type="text" name="nm" value="" required placeholder="이름을 입력하세요" class="form-control">
        </div>
        <div class="col-2"></div>
      </div>

      <div class="row rowLine">
        <div class="col text-center">
            <button type="submit" class="btn btn-primary">
                <span class="material-icons">account_circle</span> 회원가입
            </button>

            <button type="button" class="btn btn-primary" onclick="location.href='login.php'">
                <span class="material-icons">done</span> 로그인하기
            </button>
        </div>
    </div>

    </form>
  </body>
</html>