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
<?php // login.php sayfası admin girişi için.
	
	if(!empty($_SESSION['admin']) && isset($_SESSION['admin'])){ header('Location: ./girildi.php'); }// eğer admin daha önce girdiyse girildi sayfasına yönlendi
	if(isset($_POST['admin']) && !empty($_POST['admin']) && isset($_POST['sifre']) && !empty($_POST['sifre'])){//eğer hali hazırda bilgiler girilip sayfaya gönderildiyse
		if($_POST['admin'] == "admin" && $_POST['sifre']=="admin"){
			//ve kullanıcı adı ve şifre kısmına admin girildiyse 
			$_SESSION['admin']=$_POST['admin'];//sessionlar doldurulup
			$_SESSION['sifre']=$_POST['sifre'];
			echo "<script>   alert('Başarıyla giriş yapıldı. Yönlendiriliyorsunuz.'); </script>";//uyarı verip
			header('Location: ./girildi.php');// girildi sayfasına yönlendirme yapıldı
		}
		else{
			echo "<script>   alert('Giriş yapılamadı. Bilgiler hatalı'); </script>";//eğer id şifre admin değilse hata verdi
			header("Refresh:0");//sayfayı yeniledi
		}
	}
	else {//eğer sayfaya ilk defa girildiyse 
		echo "
		<form action='' method='post' style='margin-top:50px;'>
			Kullanıcı adı:<input  class='form-control' type='text' id='admin' name='admin' ><br><br>
			Şifre: <input class='form-control' type='password' id='sifre' name='sifre'><br><br>
			<input class='btn btn-dark' type='submit' value='Giriş'>
		</form>
		";// action kısmı bu sayfa olacak şekilde post methoduyla form yazdırıldı, 
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
