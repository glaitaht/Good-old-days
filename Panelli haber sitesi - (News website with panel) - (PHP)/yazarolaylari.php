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
	if(isset( $_POST['yyukle'])|| isset($_POST['yazsil']) || isset($_POST['yazgun']))
	{
		if(isset($_POST['yyukle'])){
			  $name = $_FILES["dosya"]["name"];
			  $target_dir = "img/";
			  $target_file = $target_dir . basename($name);
			  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			  $extensions_arr = array("jpg","jpeg");
			  if( in_array($imageFileType,$extensions_arr) ){
				 move_uploaded_file($_FILES['dosya']['tmp_name'],$target_dir.$name);
			  }
			$sql = "insert into yazarlar(yazarAd,yazarSoyad,resimDir,hakkinda) 
					values('".$_POST['yad']."','".$_POST['ysoyad']."','".$name."','".$_POST['hakkinda']."')";
			if ($conn->query($sql) === TRUE) {
			  echo "<script>alert('Yazar eklendi.')</script>";
			} else {
			  echo "<script>alert('Yazar eklenemedi.')</script>";
			}
		}
		else if(isset($_POST['yazsil'])){
			$sql ="delete from yazarlar where yazarID=".$_POST['yazar']."";
			if ($conn->query($sql) === TRUE) {
			  echo "<script>alert('Yazar silindi.')</script>";
			} else {
			  echo "<script>alert('Yazar silinemedi.')</script>";
			}
		}
		else if(isset($_POST['yazgun'])){
			$sql = "update yazarlar set
					yazarAd='".$_POST['yad']."',yazarSoyad='".$_POST['ysoyad']."',hakkinda='".$_POST['hakkinda']."'
					where yazarID = ".$_POST['yazar']."";
			if ($conn->query($sql) === TRUE) {
			  echo "<script>alert('Yazar güncellendi.')</script>";
			} else {
			  echo "<script>alert('Yazar güncellenemedi.')</script>";
			}
		}
	}
	else if(isset($_SESSION['admin']) && !empty($_SESSION['admin']) && isset($_SESSION['sifre']) && !empty($_SESSION['sifre'])){
		if(isset($_POST['yekle'])){
			echo"<form method='post' action='' enctype='multipart/form-data'>
				Ad:<input  class='form-control' type='text' id='yad' name='yad' ><br><br>
				Soyad:<input  class='form-control' type='text' id='ysoyad' name='ysoyad' ><br><br>
			    Hakkında:<textarea class='form-control' id='hakkinda' name='hakkinda' placeholder='Hakkında' rows='5'></textarea><br><br>
			    Resim(yalnızca jpg/jpeg):<input type='file' accept='image/jpeg,image/jpg' name='dosya' /><br>
			    <input class='btn btn-dark' name='yyukle' type='submit' value='Yazarı Ekle'>
				</form>
			";
		}
		else if(isset($_POST['ysil'])){
			echo "<center><form method='post' action='' enctype='multipart/form-data'>Yazar:<select id='yazar' name='yazar'><br>";
			$sql="select * from yazarlar ";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					echo "
					<option value='".$row['yazarID']."'>".$row['yazarAd']." ".$row['yazarSoyad']."</option>
					";
				}
			}
			echo "
				</select><br />
			    <input class='btn btn-dark' name='yazsil' type='submit' value='Yazarı Sil'>
				</form></center>
			";
		}
		else if(isset($_POST['ygun'])){
			echo "<center><form method='post' action='' enctype='multipart/form-data'>Yazar:<select id='yazar' name='yazar'><br>";
			$sql="select * from yazarlar ";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					echo "
					<option value='".$row['yazarID']."'>".$row['yazarAd']." ".$row['yazarSoyad']."</option>
					";
				}
			}
			echo "
				</select><br />
				Ad:<input  class='form-control' type='text' id='yad' name='yad' ><br><br>
				Soyad:<input  class='form-control' type='text' id='ysoyad' name='ysoyad' ><br><br>
			    Hakkında:<textarea class='form-control' id='hakkinda' name='hakkinda' placeholder='Hakkında' rows='5'></textarea><br><br>
			    <input class='btn btn-dark' name='yazgun' type='submit' value='Yazarı Güncelle'>
				</form></center>
			";
		}
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
