<?php 
require 'include.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Haberin Merkezi</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar navbar-inverse " height="100%">
  <div class="container-fluid" height="100%">
    <div class="navbar-header" height="100%" style="margin-left:7%;">
	  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar" style="margin-top:5%; background-color:red;">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
	  <a href="#"><img src="logo.png" height="94px" width="146px"  /></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar" height="100%" style="margin-top:1.5em">
      <ul class="nav navbar-nav navbar-right" style="margin-right:6%;">
        <li class="active"><a href="index.php">Ana Sayfa</a></li>
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Kategoriler<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <?php 
			$sql="select * from kategoriler";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
			  while($row = $result->fetch_assoc()) {
			  echo "<li><a href='kategoriler.php?id=".$row['kID']."'>".$row['kAdi']."</a></li>";
			  }
			}
		  ?>
        </ul>
      </li>
        <li><a href="galeri.php">Galeri</a></li>
        <li><a href="hakkimizda.php">Yazarlarımız</a></li>
        <li><a href="iletisim.php">İletişim</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="container" id="pad">
<?php
	if(isset($_SESSION['admin']) && !empty($_SESSION['admin']) && isset($_SESSION['sifre']) && !empty($_SESSION['sifre'])){
		//eğer giriş yapıdıysa bu alan çalışır
		if(isset($_POST['cikis'])) {  //ve çıkış butonuna tıklandıysa
			$_SESSION['admin']=null; $_SESSION['sifre']=null;header("Refresh:0");  
		}
		else{//eğer çıkış butonuna tıklanmadıysa
			echo "
			<center>
			<form action='haberolaylari.php' method='post'>
				<input class='btn btn-dark' type='submit' name='hekle' value='Haber Ekle' style='margin-right:15px;'>
				<input class='btn btn-dark' type='submit' name='hsil' value='Haber Sil' style='margin-right:15px;'>
				<input class='btn btn-dark' type='submit' name='hgun' value='Haber Güncelle' style='margin-right:15px;'><br />
			</form>
			<form action='yazarolaylari.php' method='post'>
				<input class='btn btn-dark' type='submit' name='yekle' value='Yazar Ekle' style='margin-right:15px;'>
				<input class='btn btn-dark' type='submit' name='ysil' value='Yazar Sil' style='margin-right:15px;'>
				<input class='btn btn-dark' type='submit' name='ygun' value='Yazar Güncelle' style='margin-right:15px;'><br />
			</form>
			<form action='' method='post'>
				<input class='btn btn-dark' type='submit' name='cikis' value='Çıkış'><br />
			</form>
			</center>
			";//3 tane sayfaya yönlendirilecek, haberlerle işlem yapmak için haberolaylari.php(action='haberolaylari.php'), 
			//yazarlarla işlem yapmak için yazarolaylari.php(action='yazarolaylari.php')
			//veya çıkış yapmak için girildi.php tekrar yüklenir(action='')
		}
		
	}
	if(!isset($_SESSION['admin'])&& empty($_SESSION['admin'])){//eğer sayfaya giriş yapmadan girilmek istenirse 
		header('Location: ./index.php');//anasayfaya yönlendirelecek
	}
	
?>
</div>

<br><br><br><br><br>
<footer class="site-footer" style="margin-top:15px;">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-6">
            <h6>Vizyon</h6>
            <p class="text-justify"><a href="index.php">Haber.in</a> sektöre bir başkaldırı, size bir başka göz, vatana hizmet, düşmana korku. Haberciliğin mihenk taşı.</p>
          </div>

          <div class="col-xs-6 col-md-3">
            <h6>Kategoriler</h6>
            <ul class="footer-links">
			<?php 
			$sql="select * from kategoriler";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
			  while($row = $result->fetch_assoc()) {
			  echo "<li><a href='kategoriler.php?id=".$row['kID']."'>".$row['kAdi']."</a></li>";
			  }
			}
			$conn->close();
		  ?>
            </ul>
          </div>

          <div class="col-xs-6 col-md-3">
            <h6>Kısayollar</h6>
            <ul class="footer-links">
              <li><a href="login.php">Admin Girişi</a></li>
              <li><a href="galeri.php">Galeri</a></li>
              <li><a href="hakkimizda.html">Hakkımızda</a></li>
              <li><a href="iletisim.html">İletişim</a></li>
            </ul>
          </div>
        </div>
        <hr>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-sm-6 col-xs-12">
            <p class="copyright-text">Bütün hakları
         <a href="index.php">Haber.in</a>'e aittir.
            </p>
          </div>

          <div class="col-md-4 col-sm-6 col-xs-12">
            <ul class="social-icons">
              <li><a class="dribbble" href="https://www.instagram.com"><i class="fa fa-instagram"></i>Ins</a></li>
              <li><a class="linkedin" href="https://www.linkedin.com"><i class="fa fa-linkedin"></i>Lin</a></li>   
              <li><a class="facebook" href="https://www.facebook.com"><i class="fa fa-facebook"></i>Fb</a></li>
              <li><a class="twitter" href="https://www.twitter.com"><i class="fa fa-twitter"></i>Twt</a></li>
            </ul>
          </div>
        </div>
      </div>
</footer>

</body>
</html>
