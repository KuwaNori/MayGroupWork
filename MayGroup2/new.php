<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
  <title>みんなの投稿</title>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=768px">
  <link href="https://fonts.googleapis.com/css2?family=Sawarabi+Gothic&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./css/new.css" media="screen">
  <link rel="stylesheet" href="./css/header.css">
</head>
<body>
  <?php
  $dbconn = pg_connect("host=localhost dbname=xxx user=xxx password=xxx")
  or die('Could not connect: ' . pg_last_error());
  session_start();
  header('Expires: -1');
  header('Cache-Control:');
  header('Pragma:');
  if (isset($_SESSION['uname'])) {
    $uname=$_SESSION['uname'];
  }
  if(isset($_POST['uname']) && strlen($_POST['uname'])>0){
    $uname=$_POST['uname'];
  }
  if(isset($_POST['cla']) && strlen($_POST['cla'])>0){
    $cname=$_POST['cla'];
  }
  if(isset($_GET['cla']) && strlen($_GET['cla'])>0){
    $cname=$_GET['cla'];
  }
  if(isset($_POST['title']) && strlen($_POST['title'])>0){
    $title=$_POST['title'];
  }
  if(isset($_POST['message']) && strlen($_POST['message'])>0){
    $message=$_POST['message'];
  }
  if(isset($_POST['delpid']) && strlen($_POST['delpid'])>0){
    $delpid=$_POST['delpid'];
  }
  if(isset($_POST['genre']) && strlen($_POST['genre'])>0){
    $genre=$_POST['genre'];
  }
  if (isset($_REQUEST["token"]) && isset($_SESSION["token"]) && $_REQUEST["token"] == $_SESSION["token"]){
    if (isset($message) && isset($genre) && isset($title)){
      $sql="insert into phpbbs(uname,title, message,pdate,cname,genre)
      values('" . $uname . "','" . $title . "','" . $message ."',current_timestamp,'".$cname."','".$genre."');";
      $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
    }
  }
  ?>
  <header>
    <div class="mainbar">
      <div id="nav-drawer">
        <input id="nav-input" type="checkbox" class="nav-unshown">
        <label id="nav-open" for="nav-input"><span></span></label>
        <label class="nav-unshown" id="nav-close" for="nav-input"></label>
        <div id="nav-content">
          <p>MENU</p>
          <ol class="menu">
            <li><a href="https://koneco.komazawa-u.ac.jp/" target=”_blank”>KONEKO</a></li>
            <li><a href="https://gmsmoodle.komazawa-u.ac.jp/" target=”_blank”>GMSmoodle</a></li>
            <li><a href="https://komazawa.c-learning.jp/s/login" target=”_blank”>C-learning</a></li>
            <li><a href="https://yestudy.komazawa-u.ac.jp/" target=”_blank”>YeStudy</a></li>
            <li><a href="./logout.php">Logout</a></li>
          </ol>
          <div id="nav-message">
            <p>
              Group2<br>
            </p>
          </div>
        </div>
      </div>
    </div>
    <?php echo "<div class='hname'>".$uname ." さん </div> "; ?>
  </header>

<main>
  <?php $_SESSION["token"] = $token = mt_rand();
  echo "<center><h1>".$cname."</h1></center>"; ?>
  <div class="position">
    <div class="svg-wrapper">
      <svg height="40" width="150" xmlns="http://www.w3.org/2000/svg">
        <rect id="shape" height="40" width="150" />
        <div id="text">
          <a href="./index2.php"><span class="spot"></span>マイページに戻る</a>
        </div>
      </svg>
    </div>
  </div>
<div id="toko" class="toko">
  <form method="POST" name="posting" action="./new.php?<?php echo "cla=".$cname ?>">
    <div class="info">
      <span class="b2"><input type="radio" name="genre" value="先生からの伝達情報"> 先生からの伝達情報</span>
      <span class="b2"><input type="radio" name="genre" value="課題"> 課題</span>
      <span class="b2"><input type="radio" name="genre" value="テスト"> テスト</span>
      <span class="b2"><input type="radio" name="genre" value="試験"> 試験</span>
      <span class="b2"><input type="radio" name="genre" value="休講情報"> 休講情報</span>
      <span class="b2"><input type="radio" name="genre" value="その他"> その他 </span><br>
      <input name="token" type="hidden" value="<?php echo $token; ?>">
      <input maxlength="25" placeholder="タイトル(25文字以内)" type="text" name="title"><br />
      <textarea placeholder="本文" wrap="hard" name="message" cols="60" rows="10"></textarea><br />
    </div>
    <input type="submit" name="send" value="投稿する">
  </form>
</div>
  <input class="toko" id="btn1" type="button" value="投稿する" onclick="clickBtn1()" /><br />
<div class="sort" id ="sort">
  <span class="b2"><input type="button" name="genre" onclick="sorting('announce')" value="伝達情報"></span>
  <span class="b2"><input type="button" name="genre" onclick="sorting('assignment')" value="課題"></span>
  <span class="b2"><input type="button" name="genre" onclick="sorting('test')" value="テスト"></span>
  <span class="b2"><input type="button" name="genre" onclick="sorting('quiz')" value="試験"></span>
  <span class="b2"><input type="button" name="genre" onclick="sorting('break')" value="休講情報"></span>
  <span class="b2"><input type="button" name="genre" onclick="sorting('other')" value="その他"></span><br>
</div>
  <input type="button" id="sbtn" name="" value="Sort" onclick="sortBtn()">
  <?php


  if (isset($delpid)){
    $sql="delete from phpbbs where pid='" . $delpid . "';";
    $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
  }

  $query="select * from phpbbs where cname='".$cname."' order " .
  "by pid desc;";
  $result = pg_query($query) or die('Query failed: ' . pg_last_error());
  echo "<div class='posts'>";
  $num=0;
  while ($line = pg_fetch_row($result)){
    $year =substr($line[0],0, 4);
    $mo = substr($line[0], 5, 2);
    $da = substr($line[0], 8, 2);
    $ti = substr($line[0],11,5);
    $cdate =$year."/".$mo."/".$da;
    if (isset($line[6])){
      if ($line[6] == "課題"){
        $gcla ="assignment";
      } elseif ($line[6] == "先生からの伝達情報") {
        $gcla ="announce";
      } elseif ($line[6] == "テスト") {
        $gcla ="test";
      } elseif ($line[6] == "試験") {
        $gcla ="quiz";
      } elseif ($line[6] == "休講情報") {
        $gcla ="break";
      } elseif ($line[6] == "その他") {
        $gcla ="other";
      }
    } else{
      $gcla ="";
    }
    $today = date("Y/m/d");
    $yest = date('Y/m/d', strtotime('-1 day'));
    if (strtotime($pdate)>strtotime($cdate)){
      if (strtotime($yest) == strtotime($cdate)) {
        echo "<center><div class='date'>昨日</div></center>";
      } else {
        echo "<center><div class='date'>".$mo."/".$da."</div></center>";
      }
    } elseif (!isset($pdate)) {
      if (strtotime($today)==strtotime($cdate)){
        echo "<center><div class='date'>今日</div></center>";
      } elseif ($yest == strtotime($cdate)) {
        echo "<center><div class='date'>昨日</div></center>";
      } else {
        echo "<center><div class='date'>".$mo."/".$da."</div></center>";
      }
    }
    $pdate = $cdate;
    echo "<div class='element' id='".$gcla."'>";
    echo $line[1] . " <span class='time'>(".$mo."/" .$da. " ".$ti.")</span> by " .  $line[2] . "<span class='".$gcla."'>".$line[6]."</span><br><p class='mtext'>" .$line[3]."</p>";
    if ($uname == $line[2]){
      echo "<div id='del' class='delc' data-index='".$num."'>".
      "<form method=\"POST\" action=\"./new.php?cla=".$cname."\">" .
      "<input type=\"hidden\" name=\"delpid\" value=\"" . $line[4] ."\">" .
      "<span class='delmess'>このメッセージを削除しますか？：</span><input class='deldel' type=\"submit\" value=\"削除\">" .
      "</form></div>";
      echo "<input class='btn2c' type='button' value='削除' id='btn2' onclick='showDel(".$num.")'>";
      $num+=1;
    } else {
      echo "<br>";
    }
    echo "</div>";
  }
  echo "</div>";
  ?>
  <br>
  </main>

  &#8203;
  &#8203;

  <script type="text/javascript">
  document.getElementById("toko").style.display ="none";
  document.getElementById("sort").style.display ="none";
  var dels= document.getElementsByClassName("delc");
  var btns= document.getElementsByClassName("btn2c");
  var eles= document.getElementsByClassName("element");
  for (var i= 0; i< dels.length; i++) {
    dels[i].style.display ="none";
  }
  function clickBtn1(){
  	const toko = document.getElementById("toko");
    if(toko.style.display=="block"){
      document.getElementById("btn1").value ="投稿する";
      toko.style.display ="none";
  	}else{
      document.getElementById("btn1").value ="やめる";
      toko.style.display ="block";
  	}
  }
  function showDel(a){
    for (var i= 0; i< dels.length; i++) {
      if (i == a) {
        if (dels[i].style.display == "block"){
          dels[i].style.display ="none";
          btns[i].value="削除";
        } else {
          dels[i].style.display ="block";
          btns[i].value="やめる";
        }
      }
    }
  }

  function sortBtn() {
    var sbtn = document.getElementById("sort");
    if (sbtn.style.display=="block"){
      document.getElementById("sort").style.display ="none";
      document.getElementById("sbtn").value ="Sort";
      for (var i= 0; i< eles.length; i++) {
          eles[i].style.display ="block";
        }
      } else {
      document.getElementById("sort").style.display ="block";
      document.getElementById("sbtn").value ="閉じる";
    }
  }
  function sorting(t) {
    for (var i= 0; i< eles.length; i++) {
      eles[i].style.display ="block";
      var x = eles[i].getAttribute("id");
      if ( x != t){
          eles[i].style.display ="none";
        }
      }
    }

  </script>
</body>
</html>
