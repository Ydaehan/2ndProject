<?php
  include('../db.php');
  session_start();
  header("Content-Type:text/html;charset=utf-8");
  $board_id = $_GET['board_id'];
  $user_name = $_SESSION['md_id'];
  if($user_name && $_POST['content']){
    $ins_sql = 
    $result = makeQuery("insert into reply(board_id,user_id,content) values ('".$board_id."','".$user_name."','".$_POST['content']."');");

    echo "<script>alert('댓글이 작성되었습니다.');
    location.href='freeBoardView.php?id=$board_id;';
    </script>";
  }else{
    echo "<script>alert('댓글 작성에 실패했습니다.');
    history.back();</script>";
  }
?>