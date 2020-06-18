<?php
  session_start();
  if (isset($_POST['class'])){
    $acla = $_POST['class'];
    $classes = implode(",",$_POST['class']);
  }
  if(isset($_SESSION["ems"])) {$ems = $_SESSION["ems"];}
  $dbconn = pg_connect("host=localhost dbname=xxx user=xxx password=xxx") or die('Could not connect: ' . pg_last_error());
  $adc="update group2may set classes ='".$classes."' where email='". $ems . "';";
  pg_query($adc) or die('Query failed: '.pg_last_error());
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=768px">
    <link href="https://fonts.googleapis.com/css2?family=Sawarabi+Gothic&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/addclass.css">
    <title></title>
  </head>
  <body>
    <p>以下のクラスを登録しました。</p>
    <?php
      foreach ($acla as $v) {
        echo $v."<br>";
      }
    ?>
    <br><a href="./index2.php">マイページに戻る</a>
  </body>
</html>
