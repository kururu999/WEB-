<?php
  session_start();
  $mode = 'input';
  $errmessage = array();

  if( isset($_POST['back']) && $_POST['back'] ){
    //何もしない
  } else if( isset($_POST['confirm']) && $_POST['confirm'] ){
    //確認画面

    //名前
    if( !$_POST['name'] ) {
	    $errmessage[] = "名前を入力してください";
    }
	  $_SESSION['name']	= htmlspecialchars($_POST['name'], ENT_QUOTES);
    
    //フリガナ
    if(!$_POST['furigana']){
      $errmessage[] = "フリガナを入力してください" ;
    }
	  $_SESSION['furigana']	= htmlspecialchars($_POST['furigana'], ENT_QUOTES);

    //選択
    if(!$_POST['gender']){
      $errmessage[] = "性別を選択してください" ;
    }
    if(!($_POST['year'] && $_POST['month'] && $_POST['day'] )){
      $errmessage[] = "生年月日を選択してください" ;
    }
    if(!$_POST['nationality']){
      $errmessage[] = "国籍を選択してください" ;
    }

    //Eメール
    if(!$_POST['mail']){
      $errmessage[] = "メールアドレスを入力してください" ;
    } else if( !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL) ){
      $errmessage[] = "Eメールアドレスが不正です。" ;
    }
	  $_SESSION['mail']	= htmlspecialchars($_POST['mail'], ENT_QUOTES);

    //password
    if(!($_POST['password'] && $_POST['passworda'])){
      $errmessage[] = "パスワードを入力してください" ;
    } else if( !($_POST['password'] == $_POST['passworda'])){
      $errmessage[] = "パスワードが一致しませんでした。もう一度入力してください" ;
    }
	  $_SESSION['password']	= htmlspecialchars($_POST['password'], ENT_QUOTES);
    
	  if( $errmessage ){
	    $mode = 'input';
    } else {
	    $mode = 'confirm';
    }

  } else if( isset($_POST['send']) && $_POST['send'] ){
    $_SESSION = array();
    $mode = 'send';
  }else{
    $_SESSION['name'] = "";
    $_SESSION['furigana'] = "";
    $_SESSION['mail'] = "";
    $_SESSION['password'] = "";
  }
?>

<!DOCTYPE html>
<html lang="en">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css'>
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../../../../v2/css/servise2.css">

<!-- Favicon-->
<link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
<!-- Font Awesome icons (free version)-->
<script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
<!-- Google fonts-->
<link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic"
  rel="stylesheet" type="text/css" />
<!-- Third party plugin CSS-->
<link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
<!-- Core theme CSS (includes Bootstrap)-->
<link href="./css/styles.css" rel="stylesheet" />

<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css'>
<link rel="stylesheet" href="../css/login_style.css">

<title>口座開設</title>
</head>
<body>
  <script src="jquary.min.js"></script>
    <!-- partial:ineex.partial.html -->
    <nav class="navbar fixed-top navbar-top navbar-expand-md">
      <div class="container"><a class="navbar-brand nav-link hlink" href="../index.html">YHC-BANK</a>
        <div class="navbar-collapse collapse">
          <ul class="ml-auto navbar-nav">
            <li class="nav-item"><a class="nav-link" href="../index.html">E-bank紹介&nbsp;&nbsp;/ </a></li>
            <li class="nav-item"><a class="nav-link" href="input.html">利用方法&nbsp;&nbsp;/</a></li>
            <li class="nav-item"><a class="nav-link" href="http://localhost:3000/v2/new%20yhc/dist/page/aaa.php" target="_blank">ネット口座開設</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <header class="jumbotron rounded-0" id="hd">
      <div class="container" data-0="transform: translateY(-50px)" data-500="transform: translateY(50px)">
        <h1>YHC-BANK </h1>
        <hr />
        <h4>信頼できる銀行</h4><img class="svg" src="https://chenyangho.github.io/catthing/img/Savings-bro.png" alt="" /><img
          class="img2" src="https://chenyangho.github.io/catthing/img/Credit card-bro.png" alt="" />
      </div>
    </header>
    <section id="section_intro">
      <div class="container">
        <div class="bank">
          <p>YHC-BANK</p><img class="img1"
            src="https://cdn.icon-icons.com/icons2/1804/PNG/512/iconfinder-481-university-bank-campus-court-4212926_114964.png"
            alt="" />
        </div>

          <?php if ( $mode == 'input' ){ ?>
          <!--入力画面-->
          <div>
            <h2>口座開設</h2>
          </div>

          <?php
            if( $errmessage ){
              echo '<div style="color:red;">';
              echo implode('<br>', $errmessage );
              echo '</div>';
            }
          ?>

          <form action="./aaa.php" method="post">
              <div style="margin-top:10px;">
              氏名:<input type="text" name="name" value="<?php echo $_SESSION['name'] ?>" autofocus placeholder="山田　太郎">
              </div>
              <div style="margin-top:10px;">
              フリガナ:<input type="text" name="furigana" value="<?php echo $_SESSION['furigana'] ?>" autofocus placeholder="ヤマダ　タロウ">
              </div>
              <div style="margin-top:10px;">
              性別：
              <input type="radio" name="gender" value="男性" id="M"><label for="M">男性</label>
              <input type="radio" name="gender" value="女性" id="F"><label for="F">女性</label>
              </div>
              <div style="margin-top:10px;">
                  生年月日:
                  <select name="year">
                    <option value="">-</option>
                    <option value="1950">1950</option>
                    <option value="1951">1951</option>
                    <option value="1952">1952</option>
                    <option value="1953">1953</option>
                    <option value="1954">1954</option>
                    <option value="1955">1955</option>
                    <option value="1956">1956</option>
                    <option value="1957">1957</option>
                    <option value="1958">1958</option>
                    <option value="1959">1959</option>
                    <option value="1960">1960</option>
                    <option value="1961">1961</option>
                    <option value="1962">1962</option>
                    <option value="1963">1963</option>
                    <option value="1964">1964</option>
                    <option value="1965">1965</option>
                    <option value="1966">1966</option>
                    <option value="1967">1967</option>
                    <option value="1968">1968</option>
                    <option value="1969">1969</option>
                    <option value="1970">1970</option>
                    <option value="1971">1971</option>
                    <option value="1972">1972</option>
                    <option value="1973">1973</option>
                    <option value="1974">1974</option>
                    <option value="1975">1975</option>
                    <option value="1976">1976</option>
                    <option value="1977">1977</option>
                    <option value="1978">1978</option>
                    <option value="1979">1979</option>
                    <option value="1980">1980</option>
                    <option value="1981">1981</option>
                    <option value="1982">1982</option>
                    <option value="1983">1983</option>
                    <option value="1984">1984</option>
                    <option value="1985">1985</option>
                    <option value="1986">1986</option>
                    <option value="1987">1987</option>
                    <option value="1988">1988</option>
                    <option value="1989">1989</option>
                    <option value="1990">1990</option>
                    <option value="1991">1991</option>
                    <option value="1992">1992</option>
                    <option value="1993">1993</option>
                    <option value="1994">1994</option>
                    <option value="1995">1995</option>
                    <option value="1996">1996</option>
                    <option value="1997">1997</option>
                    <option value="1998">1998</option>
                    <option value="1999">1999</option>
                    <option value="2000">2000</option>
                    <option value="2001">2001</option>
                    <option value="2002">2002</option>
                    <option value="2003">2003</option>
                    <option value="2004">2004</option>
                    <option value="2005">2005</option>
                  </select>　年
                  <select name="month">
                    <option value="">-</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                  </select>　月

                  <select name="day">
                    <option value="">-</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                    <option value="31">31</option>
                  </select>　日
                </div>
                <div style="margin-top:10px;">国籍：
                  <input type="radio" name="nationality" value="日本" id=""><label for="">日本</label>
                  <input type="radio" name="nationality" value="日本以外" id=""><label for="">日本以外</label>
                </div>
                <div class="mb-3" 　 style="margin-top:10px;">
                  <label for="email">メールアドレス<span class="text-muted">(ID)</span></label>
                  <input type="email" name="mail" value="<?php echo $_SESSION['mail'] ?>" class="form-control" id="email" placeholder="you@example.com">
                </div>
                <div style="margin-top:10px;">
                  パスワード：　　　<input type="password" name="password" value="<?php echo $_SESSION['password'] ?>" maxlength="12" placeholder="〜12文字までで入力">
                </div>
                <div style="margin-top:10px;">
                  パスワード(確認)：<input type="password" name="passworda" maxlength="12" placeholder="確認用">
                </div>
                <div style="margin-top:10px;">
                  <input type="submit" name="confirm" value="確認" id="button">
                </div>
          </form>      

          <?php } else if($mode == 'confirm'){ ?>
          <div>
            <h2>確認画面</h2>
          </div>
          <!--確認画面-->
          <form action="./aaa.php" method="post">
          <div class="box1" style="margin-top:100px;">
              <div style="margin-top:10px;">
              氏名：　　　　　　<?php echo $_SESSION['name'] ?>
              </div>
              <div style="margin-top:10px;">
              フリガナ：　　　　<?php echo $_SESSION['furigana'] ?>
              </div>
              <div style="margin-top:10px;">
              性別：　　　　　　<?php echo $_POST['gender'] ?>
              </div>
              <div style="margin-top:10px;">
              生年月日：　　　　<?php echo $_POST['year'] ?> 年　<?php echo $_POST['month'] ?> 月　<?php echo $_POST['day'] ?> 日
              </div>
              <div style="margin-top:10px;">
              国籍：　　　　　　<?php echo $_POST['nationality'] ?>
              </div>
              <div style="margin-top:10px;">
              メールアドレス：　<?php echo $_SESSION['mail'] ?>
              </div>
              <div style="margin-top:10px;">
              パスワード：　　　<?php echo $_SESSION['password'] ?>
              </div>
            </div>
            <div style="margin-top:10px;">
              <input type="submit" name="back" value="戻る" id="button">
              <input type="submit" name="send" value="送信" id="button">
            </div>
          </form>

          <?php } else{ ?>
            <!--完了画面-->
          <div class="box2" style="margin-top:100px;">
            <div class="box-title" >口座開設が完了しました</div>
            <p><h4>確認メールも送信しましたのでご確認ください。</h4></p>
          </div>
          <?php } ?>
      </div>
   </section> 
<footer class="jumbotron rounded-0" id="footer">
  <div class="container">
    <h2>いつも大変お世話になっております。</h2>
    <h2>誠にありがとうございます。</h2>
    <hr/>
    <div class="btn btn-primary"><a href="./login.html" style="color:white">ログイン</a></div>
  </div>
</footer>

  <!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/skrollr/0.6.30/skrollr.min.js'></script>
  <script src="../js/login_script.js"></script>


  <!-- toiawase-->
  <section class="page-section bg-dark text-white">
    <div class="container text-center">
      <h2 class="mb-4">問い合わせはこちら</h2>
      <a class="btn btn-light btn-xl" href="toiawase.html">問い合わせ窓口</a>
    </div>
  </section>
  <!-- Footer-->
  <footer class="bg-light py-5">
    <div class="container">
      <div class="small text-center text-muted">YHC-BANK 2020</div>
    </div>
  </footer>

</body>
</html>