<?
    session_save_path("./sess"); // 이게 없으면 로그인을 인식하지 못합니다. 서버가 로그인 관리하는 폴더를 sess로 지정해 놓았어요.
    session_start();
    include "dbconn.php";
    include "inc/register_global.php";
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

        <?
            $mode = $_GET['mode'];
            $idx = $_GET['idx'];


        if($_SESSION["user_state"]==1){
            
            if($mode == "show_2")
            {
                ?>

                <div class="row rowLine">
                    <div class="col text-right">
                        <button type="button" class="btn btn-primary" onClick="location.href='main.php'"><span class="material-icons">home</span></button> 
                            <?
                                $thisFile = $_SERVER['PHP_SELF'];
                            ?>
                        <button type="button" class="btn btn-primary" onClick="location.href='<?=$thisFile?>'"><span class="material-icons">arrow_back</span></button>
                    </div>
                </div>

                <?
                    $sql = "select * from test2 where idx='$idx' ";
                    $result = mysql_query($sql);
                    $data = mysql_fetch_array($result);

                    if($data)
                    {
                        ?>
                        <div class="row rowLine">
                            <div class="col"><h3 class="text-primary">내용 상세보기</h3></div>
                        </div>

                        <div class="row rowLine">
                            <div class="col-2">산</div>
                            <div class="col"><?=$data[mountain]?></div>
                        </div>

                        <div class="row rowLine">
                            <div class="col-2">날짜</div>
                            <div class="col"><?=$data[date]?></div>
                        </div>

                        <div class="row rowLine">
                            <div class="col-2">내용</div>
                            <div class="col" style='min-height:200px;'>
                                <?
                                    $data[ny] = nl2br($data[ny]); //엔터가 있으면  <br>태그로 바뀌어야 줄바꿈이 됩니다.
                                ?>

                                <?=$data[ny]?>

                            </div>
                        </div>

                        <div class="row rowLine">
                            <div class="col-2">거절사유</div>
                            <div class="col"><?=$data[refusal]?></div>

                        </div>

                        <div class="row rowLine">
                            <div class="col-2">상태</div>
                            <div class="col">
                                <?
                                    if($data[state] ==0)
                                        $printState = "신청중";
                                    else if($data[state] ==1)
                                        $printState = "승인";
                                    else
                                        $printState = "거절";
                                ?>

                                <?=$printState?>

                            </div>
                        </div>

                        <div class="row rowLine">
                            <div class="col-2">사진</div>
                            <div class="col">
                                <?
                                    if($data[image_copied]) {
                                        echo "<img src='./data/$data[image_copied]' class='img-fluid rounded'>";
                                    }
                                ?>

                            </div>
                        </div>

                        <div class="row rowLine">
                            <div class="col text-center">
                                <button type="button" class="btn btn-primary btn-sm" onClick="location.href='main.php'"><span class="material-icons">home</span></button> 
                                    <?
                                        $thisFile = $_SERVER['PHP_SELF'];
                                    ?>
                                <button type="button" class="btn btn-primary btn-sm" onClick="location.href='<?=$thisFile?>'"><span class="material-icons">arrow_back</span></button>

                            </div>
                        </div>

                        <?

                    }else
                    {
                        echo "데이터가 없습니다. 확인이 필요합니다.";
                    }
            }


            if(!$mode)
            {
            $sql = "select * from test2 order by idx desc ";
            $result = mysql_query($sql);
            $data = mysql_fetch_array($result);
            
            if($data)
            {
                // 데이터가 있을 때만 자바스크립트 필요하니
                // 여기서는 삭제가 필요없으니,, 가지고 가서 필요한데 붙여넣기합니다.
                
                
                ?>

            <div class="rw rowLine">
                <div class="col text-right">
                    <button type="button" class="btn btn-primary" onClick="location.href='main.php'"><span class="material-icons">home</span></button>
                </div>
            </div>
                <div class="row rowLine">
                    <div class="col-3 col-sm-1">순서</div>
                    <div class="d-none d-sm-block col-2 col-sm-2">날짜</div>
                    <div class="col-3 col-sm-2">산이름</div>
                    <div class="d-none d-sm-block col-sm-3">내용미리보기</div>
                    <div class="d-none d-sm-block col-sm-1">사진</div>
                    <div class="col-3 col-sm-1">상태</div>
                    <div class="col-3 col-sm-2">비고</div>

                </div>
                <?
    
                $cnt = 0;
                
                while($data)
                {
                    $cnt ++;
                    ?>
                        <div class="row rowLine">
                            <div class="col-3 col-sm-1"><?=$cnt?></div>
                            <div class="d-none d-sm-block col-sm-2"><?=$data[date]?></div>
                            <div class="col-3 col-sm-2"><?=$data[mountain]?></div>
                            <div class="d-none d-sm-block col-sm-3 ellipsis"><?=$data[ny]?></div>
                            <div class="d-none d-sm-block col-sm-1">
                                <?
                                    if($data[image_copied] and file_exists("./data/$data[image_copied]"))
                                    {
                                        echo "<img src='./data/$data[image_copied]' class='img-fluid rounded'>";
                                    }else
                                    {
                                        echo "No Photo";
                                    }
                                ?>
                            </div>

                            <?
                                switch($data[state])
                                {
                                    case 1:
                                        $printState = "<span class='badge badge-success'>승인</span>";
                                        break;
                                    case 2:
                                        $printState = "<span class='badge badge-danger'>거절</span>";
                                        break;
                                    default:
                                        $printState = "<span class='badge badge-primary'>신청중</span>";

                                        break;
                                }
                            ?>

                            <div class="col-3 col-sm-1"><?=$printState?></div>
                            <div class="col-3 col-sm-2">

                                    <?
                                        $thisFile = $_SERVER['PHP_SELF'];
                                       
                                    ?>
                                    <button type="button" class="btn btn-primary btn-sm" onClick="location.href='<?=$thisFile?>?mode=show_2&idx=<?=$data[idx]?>'"><span class="material-icons">search</span> 보기 </button>
                            </div>

                        </div>
                    <?

                    $data = mysql_fetch_array($result);
                    }
                }
            }


        }else{

        if($mode == "delete")
        {
            // 그런데..바로 삭제하면 안되고 하나 해줄 일이 있어요
            // 원본 데이터를 먼저 가져오고, 파일이 있으면 삭제를 해줘야 시스템에 불필요한 파일을 가지고 있지 않겠죠

            $sql = "select * from test2 where idx='$idx' ";
            $result = mysql_query($sql);
            $data = mysql_fetch_array($result);

            if($data)
            {
                if($data[image_copied] and file_exists("./data/$data[image_copied]"))
                {
                    // 디비 값에 파일이 있고, 실제 파일도 있으면
                    @unlink("data/$data[image_copied]");
                    // 이렇게 골뱅이를 써 놓으면 에러가 나도 화면에 보여주지는 않아요.

                    //이렇게 하면 되는데, 파일 삭제하다가 혹시 에러가 나왔을 때 화면에 로그메시지를 뿌려주기도 하거든요그걸 방지하려면..
                }   

                $delSql = "DELETE FROM test2 where idx='$idx' ";
                $delResult = mysql_query($delSql);
                if($delResult)
                    $msg = "삭제 성공";
                    else
                    $msg = "삭제 실패";
                }else
            {
                $msg = "이미 삭제된 데이터입니다.";
            }
            


            echo "
            <script>
                alert('$msg');
                location.href='$PHP_SELF'; // 다시 이 페이지로 오기만 하면 됩니다. 왜냐하면 사람들은 새로고침을 습관적으로 하기 때문에
                // 삭제하고 페이지가 그대로 있으면 계속 삭제를 요청해요.
            </script>
            ";
            
        }
        
        if($mode == "update")
        {
            $sql = "select * from test2 where idx='$idx' ";
            $result = mysql_query($sql);
            $data = mysql_fetch_array($result);

            // 이렇게 하면 원본 정보를 가져오겠죠?

            ?>
            <div class="container">
        <form name="upform" method="POST" enctype="multipart/form-data" action="<?=$PHP_SELF?>?mode=do_update&idx=<?=$idx?>">
        
            <div class="row rowLine">
                <div class="col">
                    <h4 class="text-primary"><span class="material-icons">edit</span> 인증데이터 변경하기</h4>
                </div>
            </div>

            <div class="row rowLine">
                <div class="col-2">날짜</div>
                <div class="col">
                    <input type="date" name="nz" value="<?=$data[date]?>" class="form-control">
                </div>
            </div>

            <div class="row rowLine">
                <div class="col-2">제목</div>
                <div class="col">
                    <input type="text" name="mountain"  required placeholder="산이름을 입력하세요" value="<?=$data[mountain]?>" class="form-control"></input>
                </div>
            </div>
            <div class="row rowLine">
                <div class="col-2">내용</div>
                <div class="col">
                    <textarea name="naeyong" rows="15" class="form-control" required placeholder="내용을 입력하세요"><?=$data[ny]?></textarea></textarea>
                </div>
            </div> 
            <div class="row rowLine">
                <div class="col-2">파일</div>
                <div class="col">
                    <input type="file" name="upimage" class="form-control">
                    <?
                        if($data[image_copied] and file_exists("data/$data[image_copied]"))
                        {
                            echo "<img src='data/$data[image_copied]' width='30%'>";
                        }
                    ?>
                </div>
            </div>      
            <div class="row rowLine">
                <div class="col text-center">
                    <button type="submit" class="btn btn-primary btn-sm"> <span class="material-icons">done</span> 제출</button>

                    <button type="button" class="btn btn-primary btn-sm" onClick="location.href='main.php'"> <span class="material-icons" >home</span></button>
                </div>    
            </div>
            </form>

        </div>
        <?

        }
        // 지금 변경하기 버튼을 클릭하면 다시 이파일($PHP_SELF 즉 ulch.php로 올거에요.. mode가 do_update에서 변경을 처리
        
        if($mode == "do_update")
        {
            
            echo "여기서 실제로 수정을 처리해서 디비처리해준다.여기까지 왔어요..<br>";
            echo "이제 idx = $idx 확인해보고..<br>";
            echo "date = $nz <br>";
            echo "mountain = $mountain<br>";
            echo "naeyong = $naeyong<br>";
            echo "upimage = $upimage<br>"; // 새로고침만 하면서 작업하면 됩니다.

            // 이제 여기서 원본 데이터를 가지고 와요.

            $sql = "select * from test2 where idx='$idx' ";
            $result = mysql_query($sql);
            $data = mysql_fetch_array($result);

            if($upimage)
            { // 업로드된 이미지가 있으면,, 원본 이미지가 있는 경우 삭제
                if($data[image_copied] and file_exists("data/$data[image_copied]"))
                {
                    @unlink("data/$data[image_copied]");
                }

                $upimage_name = $_FILES["upimage"]["name"];
                $upimage_tmp_name = $_FILES["upimage"]["tmp_name"];
                $upimage_type = $_FILES["upimage"]["type"];
                $upimage_size = $_FILES["upimage"]["size"];
                $upimage_error = $_FILES["upimage"]["error"];

                if($upimage_name && !$upimage_error){
                $image = explode(".", $upimage_name);
                $image_name = $image[0];
                $image_ext = $image[1];

                $new_image_name = date("Y_m_d_h_i_s");
                $new_image_name = $new_image_name;
                $copied_image_name = $new_image_name.".".$image_ext;
                $uploaded_image = $upload.$copied_image_name;

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
                }
                }

                else{
                    $upimage_name = "";
                    $upimage_type = "";
                    $copied_image_name = "";
                }
                // 여기는 upload_check.php 파일에 새로 첨부된 파일 처리해서 저장하는 코드 있죠?네
                // 그 코드 갖다 넣으면 될 것 같고요..

                $save_file_name = $copied_image_name; // 위에는 등록코드랑 같고, 거기에 있는 image_copied라는 파일만 save...로 임시 저장
            }else
            {
                // 첨부된 파일이 없으면, 파일이름은 원본($data[image_copied])
                $save_file_name = $data[image_copied];
            }
            

            // 이제 여기서 부터는 수정하기 네요...

            $sql = "update test2 set date='$nz', mountain='$mountain', ny='$naeyong', image_copied = '$save_file_name', state = 0 where idx='$idx' ";
            $result = mysql_query($sql);

            if($result)
                $msg = "성공";
            else
                $msg = "실패";

            echo "
            <script>
                alert('$msg');
                location.href='$PHP_SELF'; // 새로고침 방지를 위해 목록보기로 이동..
            </script>
            ";

        }

        if($mode == "show")
        {
            ?>

            <div class="row rowLine">
                <div class="col text-right">
                    <button type="button" class="btn btn-primary" onClick="location.href='main.php'"><span class="material-icons">home</span></button> 
                    <?
                        $thisFile = $_SERVER['PHP_SELF'];
                    ?>
                    <button type="button" class="btn btn-primary" onClick="location.href='<?=$thisFile?>'"><span class="material-icons">arrow_back</span></button>

                </div>
            </div>

            <?
                $sql = "select * from test2 where idx='$idx' ";
                $result = mysql_query($sql);
                $data = mysql_fetch_array($result);

                if($data)
                {
                    //// 여기는 상세보기 페이지네요
                    ?>
                    <div class="row rowLine">
                        <div class="col"><h3 class="text-primary">내용 상세보기</h3></div>
                    </div>

                    <div class="row rowLine">
                        <div class="col-2">산</div>
                        <div class="col"><?=$data[mountain]?></div>
                    </div>

                    <div class="row rowLine">
                        <div class="col-2">날짜</div>
                        <div class="col"><?=$data[date]?></div>
                    </div>

                    <div class="row rowLine">
                        <div class="col-2">내용</div>
                        <div class="col" style='min-height:200px;'>
                            <?
                                $data[ny] = nl2br($data[ny]); //엔터가 있으면  <br>태그로 바뀌어야 줄바꿈이 됩니다.
                            ?>

                            <?=$data[ny]?>

                        </div>
                    </div>

                    <div class="row rowLine">
                        <div class="col-2">거절사유</div>
                        <div class="col"><?=$data[refusal]?></div>

                    </div>

                    <div class="row rowLine">
                        <div class="col-2">상태</div>
                        <div class="col">
                            <?
                                if($data[state] ==0)
                                    $printState = "신청중";
                                else if($data[state] ==1)
                                    $printState = "승인";
                                else
                                    $printState = "거절";
                            ?>

                            <?=$printState?>

                        </div>
                    </div>

                    <div class="row rowLine">
                        <div class="col-2">사진</div>
                        <div class="col">
                            <?
                                if($data[image_copied]) {
                                    echo "<img src='./data/$data[image_copied]' class='img-fluid rounded'>";
                                }
                            ?>

                        </div>
                    </div>

                    <div class="row rowLine">
                        <div class="col text-center">
                            <button type="button" class="btn btn-primary" onClick="location.href='main.php'"><span class="material-icons">home</span></button> 
                            <?
                                $thisFile = $_SERVER['PHP_SELF'];
                            ?>
                            <button type="button" class="btn btn-primary" onClick="location.href='<?=$thisFile?>'"><span class="material-icons">arrow_back</span></button>

                            <?
                                //// 바로위에코드상으로는 홈버튼있도, 뒤로가기 버튼이 있는데,, 화면에는 왜 안보일까요?
                                if($data[state] ==2)
                                {
                                    echo " <button type='button' name='upBtn' class='btn btn-primary' onClick=\"location.href='$PHP_SELF?mode=update&idx=$data[idx]'\"><span class='material-icons'>edit</span> 재신청</button>";
                                } else if($data[state] ==0)
                                {

                                    echo "
                                    <script>
                                        function confirmDelete()
                                        {
                                            if(confirm('삭제된 데이터는 복구할 수 없습니다.\\n\\r정말 삭제하시겠습니까?')) 
                                            {
                                                location.href='$PHP_SELF?mode=delete&idx=$data[idx]';
                                            } // 취소하면 할 일이 없으니까 불필요한 코드..
                                        }
                                    </script>
                                    ";

                                    echo "
                                    <button type='button' name='delBtn' id='del$data[idx]' class='btn btn-danger'  onclick = \"confirmDelete()\"><span class='material-icons'>delete</span> 삭제</button>
                                    <button type='button' name='upBtn' class='btn btn-success' onClick=\"location.href='$PHP_SELF?mode=update&idx=$data[idx]'\"><span class='material-icons'>refresh</span> 변경</button>
                                    ";
                                }
                            ?>

                        </div>
                    </div>

                    <?

                }else
                {
                    echo "데이터가 없습니다. 확인이 필요합니다.";
                }
        }

        // 이부분은 mode가 없을 때만 처리되는 부분같죠?네
        // 모드 없을 때만 화면에 보여준다.

        if(!$mode)
        {
           
            ?>

            <div class="row rowLine">
                <div class="col text-right">
                    <button type="button" class="btn btn-primary" onClick="location.href='main.php'"><span class="material-icons">home</span></button>
                </div>
            </div>

            <?

            $id = $_SESSION["user_id"];
                
            $sql = "select * from test2 where id = '$id' order by idx desc "; // 이렇게 하면 최신 등록한 순의 역순으로 가져오겠죠
            $result =  mysql_query($sql);
            $data = mysql_fetch_array($result);

            if($data)
            {
                // 데이터가 있을 때만 자바스크립트 필요하니
                // 여기서는 삭제가 필요없으니,, 가지고 가서 필요한데 붙여넣기합니다.


                ?>
                <div class="row rowLine">
                    <div class="col-3 col-sm-1">순서</div>
                    <div class="d-none d-sm-block col-2 col-sm-2">날짜</div>
                    <div class="col-3 col-sm-2">산이름</div>
                    <div class="d-none d-sm-block col-sm-3">내용미리보기</div>
                    <div class="d-none d-sm-block col-sm-1">사진</div>
                    <div class="col-3 col-sm-1">상태</div>
                    <div class="col-3 col-sm-2">비고</div>

                </div>
                <?
    
                $cnt = 0;
                
                while($data)
                {
                    $cnt ++;
                    ?>
                        <div class="row rowLine">
                            <div class="col-3 col-sm-1"><?=$cnt?></div>
                            <div class="d-none d-sm-block col-sm-2"><?=$data[date]?></div>
                            <div class="col-3 col-sm-2"><?=$data[mountain]?></div>
                            <div class="d-none d-sm-block col-sm-3 ellipsis"><?=$data[ny]?></div>
                            <div class="d-none d-sm-block col-sm-1">
                                <?
                                    if($data[image_copied] and file_exists("./data/$data[image_copied]"))
                                    {
                                        echo "<img src='./data/$data[image_copied]' class='img-fluid rounded'>";
                                    }else
                                    {
                                        echo "No Photo";
                                    }
                                ?>
                            </div>

                            <?
                                switch($data[state])
                                {
                                    case 1:
                                        $printState = "<span class='badge badge-success'>승인</span>";
                                        break;
                                    case 2:
                                        $printState = "<span class='badge badge-danger'>거절</span>";
                                        break;
                                    default:
                                        $printState = "<span class='badge badge-primary'>신청중</span>";

                                        break;
                                }
                            ?>

                            <div class="col-3 col-sm-1"><?=$printState?></div>
                            <div class="col-3 col-sm-1">

                                    <?
                                        $thisFile = $_SERVER['PHP_SELF'];
                                       
                                    ?>
                                    <button type="button" class="btn btn-primary btn-sm" onClick="location.href='<?=$thisFile?>?mode=show&idx=<?=$data[idx]?>'"><span class="material-icons">search</span> 보기 </button>
                    

                        </div>
                    <?

/*

이전에는 여기서 상태를 보고 바로 승인 여부 등을 확인했군요
일단 하나가 빠졌네요>
                        if($data[state] == 0){
                        echo "(날짜, 산 이름, 내용) = ($data[date], $data[mountain], $data[ny])
                        <input type='button' name='delBtn' id='del$data[idx]' value='삭제' onclick = \"confirmDelete($data[idx])\"> 
                        <input type='button' name='upBtn' value='변경' onClick=\"location.href='$PHP_SELF?mode=update&idx=$data[idx]'\">
                     data[idx]data[idx]
    
                        if($data[image_copied] and file_exists("./data/$data[image_copied]"))
                        {
                            echo "<img src='./data/$data[image_copied]' width='30%'> <br>";
                        } 
                    }else if($data[state] == 1){
                        echo "(날짜, 산 이름, 내용) = ($data[date], $data[mountain], $data[ny])
                        승인 되었습니다.
                        <br>";
    
                        if($data[image_copied] and file_exists("./data/$data[image_copied]"))
                        {
                            echo "<img src='./data/$data[image_copied]' width='30%'> <br>";
                        } 
                    }else if($data[state] == 2){
                        echo "(날짜, 산 이름, 내용) = ($data[date], $data[mountain], $data[ny])<br>
                        거절 되었습니다. 사유 : <br>
                        $data[refusal]
                        <input type='button' name='upBtn' value='재신청' onClick=\"location.href='$PHP_SELF?mode=re&idx=$data[idx]'\">
                        <br>";
    
                        if($data[image_copied] and file_exists("./data/$data[image_copied]"))
                        {
                            echo "<img src='./data/$data[image_copied]' width='30%'> <br>";
                        } 
                    }
    */
                    // 이렇게 하면 된거죠? 네 나머지는 한번 해보실 수 있을 것 같은데.. 넵 해보겠습니다
                    // 하다가 안되면 고민하지 말고, 톡으로 요청해요.
                    $data = mysql_fetch_array($result);
                
                }
            }

        }
        }





    ?>

    </div> <!-- container -->
</body>
<?
    mysql_close($conn);
?>