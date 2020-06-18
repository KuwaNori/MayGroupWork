<?php
session_start();
// 以下三行ブラウザの戻る、進むボタンによる操作を可能にする、エラー回避
header('Expires: -1');
header('Cache-Control:');
header('Pragma:');
session_cache_expire(60 * 24 * 30);
if (isset($_SESSION['ems'])){$ems=$_SESSION['ems'];}
if (isset($_SESSION['pws'])){$pws=$_SESSION['pws'];}
if (isset($_POST['emf'])){$ems=$_POST['emf'];}
if (isset($_POST['pwf'])){$pws=$_POST['pwf'];}
$aflag=0;
if (isset($ems) &&isset($pws)){
  $sql="select * from group2may where email='". $ems . "';";
  $dbconn = pg_connect("host=localhost dbname=xxx user=xxx password=xxx")
    or die('Could not connect: ' . pg_last_error());
  $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
  if(pg_num_rows($result)==1){
    $row = pg_fetch_row($result);
    if (password_verify($pws, $row[3])){
      $_SESSION['ems']=$ems;
      $_SESSION['pws']=$pws;
      $_SESSION['uname']=$row[1];
      $classes=$row[4];
      $uname = $row[1];
      $aflag=1;
    }
  }

}
if($aflag==0){
  header('location: ./login2.html');
}

?>

<html>
<head>
  <title>
    login
  </title>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=768px">
  <link href="https://fonts.googleapis.com/css2?family=Sawarabi+Gothic&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./css/index2.css">
  <link rel="stylesheet" href="./css/header.css">
</head>

<body>
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
<?php
 echo "<main>";
 $lcla = preg_split('/,/',$classes);
 if (strlen($classes) > 0){
   foreach ($lcla as $v) {
     echo "<form name='sbm' action='./new.php' method='post'>";
     echo "<input type='hidden' name='cla' value='".$v."'>";
     echo "</form>";
     echo "<a href='./new.php?cla=".$v."' class='mlist'>".$v."</a>";
   }
}
 echo "</main>";
 ?>
 <br><br>
 <div class="position">
   <div class="svg-wrapper">
     <svg height="40" width="150" xmlns="http://www.w3.org/2000/svg">
       <rect id="shape" height="40" width="150" />
       <div id="text">
         <a href="./class02.php"><span class="spot"></span>授業登録はこちら</a>
       </div>
     </svg>
   </div>
 </div>
</body>
</html>
