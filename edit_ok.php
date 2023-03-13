<?php
/* 세션 시작 */
header("Content-Type:text/html;charset=utf-8"); 
session_start();
$edit_user = $_GET["user_id"];
if($_SESSION["md_id"] != $edit_user){
  $user_id = $edit_user;
  $same = FALSE;
}else{
  $user_id = $_SESSION["md_id"];
  $same = TRUE;
}


/* 이전 페이지에서 값 가져오기 */
$pw = $_POST["pw"];
$nickname = $_POST["nickname"];

// 값 확인
echo "비밀번호 : ".$pw."<br>";
echo "닉네임 : ".$nickname."<br>";

/* DB 접속 */
include "db.php";

/* 쿼리 작성 */
if(!$pw){
  $sql = "update manage_user set nickname = '$nickname' where user_id = '$user_id';";
}else if(!$nickname){
  $sql = "update manage_user set pw = '$pw' where user_id = '$user_id';";
}else{
  $sql = "update manage_user set pw = '$pw', nickname = '$nickname' where user_id = '$user_id';";
}
echo $sql;

/* 데이터베이스에 쿼리 전송 */
mysqli_query($db,$sql);
$sql = "select nickname from manage_user where user_id = '$user_id'";
$result = mysqli_query($db, $sql);
$nickname = mysqli_fetch_array($result);

/* session에 값 변경 */
if($same){
  $_SESSION['user_nickname'] = $nickname["nickname"];
}



/* DB(연결) 종료 */
mysqli_close($db);

/* 리디렉션 */
echo "<script type=\"text/javascript\">
alert(\"정보가 수정되었습니다.\");
location.href = \"index.php\";
</script>";
?>