<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<meta name="viewport" content="width=768px">
<title>授業検索</title>
<link rel="stylesheet" href="./css/class02.css">
<link rel="stylesheet" href="./css/header.css">
<link href="https://fonts.googleapis.com/css2?family=Sawarabi+Gothic&display=swap" rel="stylesheet">
<script type="text/javascript">
    // 選択した授業が下に出てくる仕組み
    function showc(){
      target = document.getElementById("selected");
      var stri = "";
      var flag = false;
      for (var i = 0; i < document.f1.elements.length -1; i++){
        if (document.f1.elements[i].checked){
          flag = true;
          stri = stri + document.f1.elements[i].value +"<br>";
        }
      }
      target.innerHTML = stri;
    }
</script>
</head>
<body>
  <?php
   session_start();
   session_cache_expire(60 * 24 * 7);
   if(isset($_SESSION["ems"])) {$ems = $_SESSION["ems"];}
   if(isset($_SESSION["uname"])){$uname =$_SESSION["uname"];}
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
<center>
  <div class="main">
    <div class="copy-container">
      <h1>授業一覧</h1>
    </div>
    <div class="section-title">
      <p>*チェックしてから「送信」をクリックしてください。</p>
      <p>*現在登録されている情報は失われます。</p>
    </div>
    <form name="f1" method="post" action="./addclass.php">
      <div class="side">
        <div class="lside">
          <div class="topic"><p>必修選択1</p></div>
          <div class="check-container"><input type="checkbox" id ="one"  name="class[]" value="メディア法基礎" onchange="showc()"><label for="one"></label><span class="tag">メディア法基礎</span></div><br>
          <div class="check-container"><input type="checkbox" id ="two"  name="class[]" value="メディア法応用" onchange="showc()"><label for="two"></label><span class="tag">メディア法応用</span></div><br>
          <div class="check-container"><input type="checkbox" id ="three"  name="class[]" value="グローバルイシューと国際公法" onchange="showc()"><label for="three"></label><span class="tag">グローバルイシューと国際公法</span></div><br>
          <div class="check-container"><input type="checkbox" id ="four"  name="class[]" value="グローバルイシューと国際私法" onchange="showc()"><label for="four"></label><span class="tag">グローバルイシューと国際私法</span></div><br>
          <div class="topic"><p>必修選択2</p></div>
          <div class="check-container"><input type="checkbox" id ="five"  name="class[]" value="ミクロ経済分析基礎" onchange="showc()"><label for="five"></label><span class="tag">ミクロ経済分析基礎</span></div><br>
          <div class="check-container"><input type="checkbox" id ="six"  name="class[]" value="統計分析基礎" onchange="showc()"><label for="six"></label><span class="tag">統計分析基礎</span></div><br>
          <div class="check-container"><input type="checkbox" id ="seven"  name="class[]" value="マクロ経済分析基礎" onchange="showc()"><label for="seven"></label><span class="tag">マクロ経済分析基礎</span></div><br>
          <div class="check-container"><input type="checkbox" id ="eight"  name="class[]" value="国際経済統計入門" onchange="showc()"><label for="eight"></label><span class="tag">国際経済統計入門</span></div><br>
          <div class="topic"><p>必修選択3</p></div>
          <div class="check-container"><input type="checkbox" id ="nine"  name="class[]" value="グローバル戦略論" onchange="showc()"><label for="nine"></label><span class="tag">グローバル戦略論</span></div><br>
          <div class="check-container"><input type="checkbox" id ="ten"  name="class[]" value="メディアと企業" onchange="showc()"><label for="ten"></label><span class="tag">メディアと企業</span></div><br>
          <div class="check-container"><input type="checkbox" id ="elvn"  name="class[]" value="グローバル企業行動論" onchange="showc()"><label for="elvn"></label><span class="tag">グローバル企業行動論</span></div><br>
          <div class="check-container"><input type="checkbox" id ="twlv"  name="class[]" value="グローバルマーケティング" onchange="showc()"><label for="twlv"></label><span class="tag">グローバルマーケティング</span></div><br>

        </div>
        <div class="rside">
          <div class="topic"><p>必修選択4</p></div>
            <div class="check-container"><input type="checkbox" id="thtn" name="class[]" value="世界政治とメディア" onchange="showc()"><label for="thtn"></label><span class="tag">世界政治とメディア</span></div><br>
            <div class="check-container"><input type="checkbox" id="frtn" name="class[]" value="国際関係とメディア" onchange="showc()"><label for="frtn"></label><span class="tag">国際関係とメディア</span></div><br>
            <div class="check-container"><input type="checkbox" id="fftn" name="class[]" value="グローバル・ポリティックス" onchange="showc()"><label for="fftn"></label><span class="tag">グローバル・ポリティックス</span></div><br>
            <div class="check-container"><input type="checkbox" id="sxtn" name="class[]" value="グローバルメディアガバナンス論" onchange="showc()"><label for="sxtn"></label><span class="tag">グローバルメディアガバナンス論</span></div><br>
            <div class="topic"><p>必修選択5</p></div>
            <div class="check-container"><input type="checkbox" id="svtn" name="class[]" value="インターネットとメディア" onchange="showc()"><label for="svtn"></label><span class="tag">インターネットとメディア</span></div><br>
            <div class="check-container"><input type="checkbox" id="eitn" name="class[]" value="メディアと情報" onchange="showc()"><label for="eitn"></label><span class="tag">メディアと情報</span></div><br>
            <div class="check-container"><input type="checkbox" id="nntn" name="class[]" value="技術とメディア" onchange="showc()"><label for="nntn"></label><span class="tag">技術とメディア</span></div><br>
            <div class="check-container"><input type="checkbox" id="twty" name="class[]" value="メディアとセキュリティ" onchange="showc()"><label for="twty"></label><span class="tag">メディアとセキュリティ</span></div><br>
            <div class="topic"><p>必修選択6</p></div>
            <div class="check-container"><input type="checkbox" id="twon" name="class[]" value="グローバルメディア概論" onchange="showc()"><label for="twon"></label><span class="tag">グローバルメディア概論</span></div><br>
            <div class="check-container"><input type="checkbox" id="twtw" name="class[]" value="メディア文化論" onchange="showc()"><label for="twtw"></label><span class="tag">メディア文化論</span></div><br>
            <div class="check-container"><input type="checkbox" id="twth" name="class[]" value="表象メディア論" onchange="showc()"><label for="twth"></label><span class="tag">表象メディア論</span></div><br>
            <div class="check-container"><input type="checkbox" id="twfr" name="class[]" value="情報社会論" onchange="showc()"><label for="twfr"></label><span class="tag">情報社会論</span></div><br>
        </div>
      </div>
      <div class="position">
        <div class="svg-wrapper">
          <svg height="40" width="150" xmlns="http://www.w3.org/2000/svg">
            <rect id="shape" height="40" width="150" />
            <div id="text">
              <span class="spot"><input type="submit" value="送信" name=""></span>
            </div>
          </svg>
        </div>
      </div>
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
      <br>
    </form>
    あなたの選んだ授業: <br>
    <div id="selected">
    </div>
    &#8203;
  </div>
<center>
</body>
</html>
