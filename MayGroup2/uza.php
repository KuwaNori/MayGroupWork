<html>
  <head>
    <title>registration</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=768px">
    <link rel="stylesheet" href="./css/uza2.css">
    <link href="https://fonts.googleapis.com/css2?family=Sawarabi+Gothic&display=swap" rel="stylesheet">
  </head>
  <body>
  <?php
  // 値の受け取り
    if (isset($_POST['emf'])){$emf=$_POST['emf'];}
    if (isset($_POST['unf'])){$unf=$_POST['unf'];}
    if (isset($_POST['pwf1'])){$pwf1=$_POST['pwf1'];}
    if (isset($_POST['pwf2'])){$pwf2=$_POST['pwf2'];}
    // パスワードの確認がうまくいかなかった場合
    if ($pwf1 !== $pwf2){
      echo "<p>パスワードが一致しませんでした。</p>";
      echo "<a href=\"./uza.html\">戻る</p>";
    }
    // emfとunfとpwf1がNULL（空）ではない場合
    elseif (isset($emf) && isset($unf)&& isset($pwf1)){
      // 以下3行データベースとのやり取り
      $sql="select * from group2may where email='". $emf . "';";
      $dbconn = pg_connect("host=localhost  dbname=xxx user=xxx password=xxx") or die('Could not connect: ' . pg_last_error());
      $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
        // DBに何も入っていなかった場合
        if(pg_num_rows($result)==0){
          $npw=$pwf1;
          // パスワードの暗号化
          $npwh=password_hash($npw, PASSWORD_BCRYPT);
          $sql="insert into group2may(uname, email, password, classes) values ('" .$unf."','".$emf."','". $npwh ."','');";
          pg_query($sql) or die('Query failed: '.pg_last_error());
          echo '<p>ユーザ登録を完了しました</p>';
          // メール送信
          $mailfr="mtymkh223@gmail.com(新しいタブが開きます)";
          $mailsb="May Project group2 ユーザ登録完了";
          $mailms="下記のとおりユーザ登録を完了しました。\n\n"."   ユーザ名:　".$unf."\n"."   email:　" . $emf . "\n\n"."こちらのURLよりログインしてください:　http://gms.gdl.jp/~kuwanori/MayGroup2/login2.html\n\n";
          if (mb_send_mail($emf, $mailsb, $mailms, "From: ". $mailfr)) {
            echo "<p>メールが送信されました。</p>";
          } else {
            echo "<p>メールの送信に失敗しました。</p>";
          }
          echo "<a href=\"./login2.html\">戻る</a>";
#とうろく
    }
    else{
      echo "<p>そのメールアドレスはすでに登録されています。</p>";
      echo "<a href=\"./uza.html\">ユーザー登録</a><br>";
      echo "<a href='./login2.html'>ログイン</a>";
    }
  }
    else{echo 'error';}
  ?>
  </body>
</html>
