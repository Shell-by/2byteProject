<?
session_save_path("./sess");
session_start();
include "dbconn.php"
?>
<!doctype html>
<html lang="ko">
    <head>
        <meta charset="utf-8" />
        <title>3C 등산 인증</title>
        <meta name="viewport"
        content="width=device-width, maximum-scale=3.0, user-scalable=yes">
        <link href="style2.css" rel="stylesheet" type="text/css"> 
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
            if($mode == "pass")
            {
    
                $sql = "select state from test2 where idx='$idx' ";
                $result = mysql_query($sql);
                $data = mysql_fetch_array($result);
    
                if($data)
                {
    
                    $pasSql = "UPDATE test2 SET state = '1' where idx='$idx' ";
                    $pasResult = mysql_query($pasSql);
                    if($pasResult)
                        $msg = "승인 성공";
                    else
                        $msg = "승인 실패";
                }else
                {
                    $msg = "이미 승인되었습니다.";
                }
                
    
                $thisFile = $_SERVER['PHP_SELF'];
                echo "
                <script>
                    alert('$msg');
                    location.href='$thisFile';
                </script>
                ";
    
            }
            if($mode == "refusal"){
    
                // 여기가 잘못되었네요.. 원본 데이터를 찾아서, 이미 거절된 것인지 확인하는 절차가 있어야 하네요.

                $sql = "select * from test2 where idx='$idx' ";
                $result = mysql_query($sql);
                $data = mysql_fetch_array($result);
                // 데이터가 있어야 하는게 아니라, 현재 state=0이어야 거절할 수 있겠죠

                if($data[state] ==0)
                {

                    // 여기서 이렇게만 하면 안되고 , test2에 거절사유를 적을 DB필드를 만듭니다.

                    $refSql = "UPDATE test2 SET state = '2' , refusal='$reason'  where idx='$idx' ";
                    $refResult = mysql_query($refSql);
                    if($refResult)
                        $msg = "거절 성공";
                    else
                        $msg = "거절 실패";
                }else
                {
                    
                    $msg = "이미 거절되었습니다.";
                }
                
                $thisFile = $_SERVER['PHP_SELF'];
                                       
    
                echo "
                <script>
                    alert('$msg');
                    location.href='$thisFile';
                </script>
                ";

            }

            if($mode == "show")
            {
                ?>
                <div class="row rowLine">
                    <div class="col text-right">
                        <button type="button" class="btn btn-primary btn-sm" onClick="location.href='main.php'"><span class="material-icons">home</span></button> 
                        <?
                            $thisFile = $_SERVER['PHP_SELF'];
                        ?>
                        <button type="button" class="btn btn-primary btn-sm" onClick="location.href='<?=$thisFile?>'"><span class="material-icons">arrow_back</span></button>
                    </div>
                </div>

                <?
                    $sql = "select * from test2 where idx='$idx' ";
                    $result = mysql_query($sql);
                    $data = mysql_fetch_array($result);

                    if($data)
                    {
                            $thisFile = $_SERVER['PHP_SELF'];
                        echo "
                        <script>
                        function checkError()
                        {
                            var reason = document.getElementById('reason');
    
                            if(reason.value.length ==0)
                            {
                                alert('거절 사유를 작성해야 합니다.');
                                reason.focus();
                                return false;
                            }
                        }
                        </script>


                        <form name='refuseForm' method='post' onSubmit=\"return checkError()\" action='$thisFile?mode=refusal&idx=$data[idx]'>
                        ";
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
                            <div class="col">
                                <textarea name="reason" id="reason" class="form-control" rows="3"><?=$data[refusal]?></textarea>  
                          </div>

                        </div>

                        <div class="row rowLine">
                            <div class="col-2">상태</div>
                            <div class="col">
                                <?
                                    if($data[state] ==0)
                                        $printState = "<span class='badge badge-primary'>신청중</span>";
                                    else if($data[state] ==1)
                                        $printState = "<span class='badge badge-success'>승인</span>";
                                    else
                                        $printState = "<span class='badge badge-danger'>거절</span>";
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

                        <script>
                            function confirmPass()
                            {
                                if(confirm('승인 하시겠습니까?')) 
                                {
                                    <?
                                        $thisFile = $_SERVER['PHP_SELF'];
                                    ?>
                                    location.href='<?=$thisFile?>?mode=pass&idx=<?=$idx?>';
                                }
                            }


                        </script>

                        <div class="row rowLine">
                            <div class="col text-center">
                                <button type="button" class="btn btn-primary btn-sm" onClick="location.href='main.php'"><span class="material-icons">home</span></button> 
                                <?
                                    $thisFile = $_SERVER['PHP_SELF'];
                                ?>
                                <button type="button" class="btn btn-primary btn-sm" onClick="location.href='<?=$thisFile?>'"><span class="material-icons">arrow_back</span></button>

                                <?
                                    if($data[state] == 0)
                                    {
                                            
                                        echo " <button type='button' name='passBtn' class=\"btn btn-primary btn-sm\" onClick=\"confirmPass()\"><span class='material-icons'>done_all</span> 승인</button>";
                                    
                                        echo " <button type='submit' name='rejectBtn' class='btn btn-danger btn-sm'><span class='material-icons'>remove_done</span> 거절</button>";
                            
                                    }

                                ?>

                            </div>
                        </div>
                        </form>

                        <?

                    }else
                    {
                        echo "데이터가 없습니다. 확인이 필요합니다.";
                    }






            }

            // mode가 없다는 말은 처음 화면을 의미한다.
            if(!$mode) 
            {
                ?>
                    <div class="row rowLine">
                        <div class="col text-right">
                            <button class="btn btn-primary btn-sm" type="button" onClick="location.href='main.php'">
                                <span class="material-icons">arrow_back</span>
                             </button>
                        </div>
                    </div>
                <?
        
                $sql = "select * from test2 where state = 0 order by idx desc ";
                $result =  mysql_query($sql);
                $data = mysql_fetch_array($result);
    
                if($data)
                {
    
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
                                    <div class="d-none d-sm-block col-2 col-sm-2"><?=$data[date]?></div>
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
                                    <div class=""col-3 col-sm-2">
                                    <?
                                        $thisFile = $_SERVER['PHP_SELF'];
                                    ?>
                                            <button type="button" class="btn btn-primary btn-sm" onClick="location.href='<?=$thisFile?>?mode=show&idx=<?=$data[idx]?>'"><span class="material-icons">search</span> 보기</button>
                                    </div>

                                </div> <br>
                            <?

                            $data = mysql_fetch_array($result);
                            
                        }

                }
            }



        ?>
        </div> <!-- container -->
    </body>
</html>
<?
    mysql_close($conn);
?>