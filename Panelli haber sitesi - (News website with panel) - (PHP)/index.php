<?php 
require 'include.php';// her dosyada çalışması gereken php kodunu include etti.
?>
<!DOCTYPE html>
<html>
<head>
  <title>Haberin Merkezi</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"><!-- bootstrap için gerekli kütüphaneler  -->
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
			$sql="select * from kategoriler";//kategoriler her sayfada php kodu çalıştırılarak veritabanından alındı
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
        <li><a href="hakkimizda.php">Hakkımızda</a></li>
        <li><a href="iletisim.php">İletişim</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="container" id="pad"><!-- bootstrap kütüphanesinin gerekli classları ile tanımlamalar -->
  <div id="myCarousel" class="carousel slide" data-ride="carousel"><!-- bootstrap carousel ile slider yaptı -->
    <ol class="carousel-indicators" style ="z-index:1;">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
    </ol>
    <div class="carousel-inner">
		<div class='item active'>
			<a href='haberler.php?id=1'><img src='img/haberin1.jpg' alt='1. haber' style='width:100%;'></a><!-- 4 tane slider koydum -->
		</div>
		<div class='item'>
			<a href='haberler.php?id=2'><img src='img/haberin2.jpg' alt='2. haber' style='width:100%;'></a>
		</div>
		<div class='item'>
			<a href='haberler.php?id=3'><img src='img/haberin3.jpg' alt='3. haber' style='width:100%;'></a>
		</div>
		<div class='item'>
			<a href='haberler.php?id=4'><img src='img/haberin4.jpg' alt='4. haber' style='width:100%;'></a>
		</div>
    </div>
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>

<br /><br /><br /><br />
  
<div class="container-fluid bg-3 text-center">    
  <h2>SON 20 HABER:</h2><br>
  <?php 
		$sql="select * from haberler order by hID DESC";// veritabanındaki haberleri sondan başa doğru çağıran sorgu
		$result = $conn->query($sql);//sorguyu çalıştırıp sonucu degişkene attı
		$hbr=0;//kaçıncı haberde olduğumu saydı
		if ($result->num_rows > 0) {//eğer sonuçların sayısı 0dan büyükse 
			while($row = $result->fetch_assoc()) {// sorgudaki elemanı ele alıp
				if($hbr==20) break;// haber 20 olana kadar yazdıracak
				if($hbr % 4 == 0){//haber 4 ün katıysa veya 0 sa yeni satır başlamış demektir
					echo"<br /><br /><div class='row'>";
				}
				echo "
				<div class='col-sm-3' style='margin-top:15px;'>
					<p>".$row['baslik']."</p>
				  <a href='haberler.php?id=".$row['hID']."'><img src='img/".$row['resimDir']."' class='img-responsive'   alt='Haber".$hbr."'></a>
				</div>	
				";
				//echo ile her elemanı yazdırdı
				if($hbr % 4== 3){//eğer 3. elemanın sonuna eriştiysek satır bitmiş demektir gerekli divi kapattı
					echo "</div>";
				}
				$hbr++;//haberi 1 arttırdı
			}
		}
  ?>
  
</div>

<br><br><br><br><br>

<footer class="site-footer" style="margin-top:15px;"><!-- bootstrap ile gerekli footer kısmı  -->
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
			$sql="select * from kategoriler";//kategoriler yine veritabanından çağrıldı
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
			  while($row = $result->fetch_assoc()) {
			  echo "<li><a href='kategoriler.php?id=".$row['kID']."'>".$row['kAdi']."</a></li>";
			  }
			}
			$conn->close();// başta başka dosyayla açılan bağlantıyı kapattı
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
