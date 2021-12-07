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
	if(isset($_POST['hyukle']) || isset($_POST['hdbsil']) ||  isset($_POST['habgun']))
	{//eğer bu sayfada daha önce bulunulmuş ve sayfadaki işlem yapma butonlarından birine basılmışsa sorgu çalıştıracak butonlar.
		if(isset($_POST['hyukle'])){//hyukle butonu hekle butonunun işlevini çalıştıracak.
			  $name = $_FILES["dosya"]["name"];//sisteme yüklenmiş resim dosyası
			  $target_dir = "img/";//nereye kaydedileceği
			  $target_file = $target_dir . basename($name);//tam kayıt yeri
			  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));//uzantısını küçük şekilde aldı
			  $extensions_arr = array("jpg","jpeg");//kabul edilecek uzantılar
			  if( in_array($imageFileType,$extensions_arr) ){//uzantılar uyuşuyor mu
				 move_uploaded_file($_FILES['dosya']['tmp_name'],$target_dir.$name);//uyuştuysa dosyayı taşıdı 
			  }
			$sql = "insert into haberler(kID,baslik,resimDir,text,yazarID)
			values(".$_POST['kategori'].",'".$_POST['baslik']."','".$name."','".$_POST['text']."',".$_POST['yazar'].")";
			//bu sorgu yeni haber ekleyecek
			if ($conn->query($sql) === TRUE) {//sorgu çalıştı 
			  echo "<script>alert('Haber eklendi.')</script>";//eklendiyse eklendi yazacak
			} else {
			  echo "<script>alert('Haber eklenemedi.')</script>";//eklenemediyse eklenmedi yazacak
			}
		}
		else if(isset($_POST['hdbsil'])){//id alıp haberi silen butonun post işlemi 
			$sql= "delete from haberler where hID=".$_POST['haberID']."";//haberid'ye göre
			if ($conn->query($sql) === TRUE) {//sorguyu çalıştırdı
				echo "<script>alert('Haber tablodan silindi.')</script>";//silindiyse uyarı vereek
			}
		}
		else if(isset($_POST['habgun'])){// haberi güncelleyecek
			$sql = "update haberler set 
			kID = ".$_POST['kategori'].", 
			baslik='".$_POST['baslik']."',
			text ='".$_POST['text']."',
			yazarID=".$_POST['yazar']."
			where hID=".$_POST['gid']."";
			if ($conn->query($sql) === TRUE) {//güncellendiyse 
			  echo "<script>alert('Haber güncellendi.')</script>";//uyarı verecek
			} else {
			  echo "<script>alert('Haber güncellenemedi.')</script>";
			}
		}
	}
	else if(isset($_SESSION['admin']) && !empty($_SESSION['admin']) && isset($_SESSION['sifre']) && !empty($_SESSION['sifre'])){
		//admin girişi ile girildi.php sayfasından gönderilen buton adı ile işlemler yazdırılır  
		if(isset($_POST['hekle'])){// haber eklemek için 
			echo "
			<form method='post' action='' enctype='multipart/form-data'>
			  Başlık:<input  class='form-control' type='text' id='baslik' name='baslik' ><br><br>
			  Haber İçeriği:<textarea class='form-control' id='text' name='text' placeholder='Haber içeriği' rows='5'></textarea><br><br>
			  Resim(yalnızca jpg/jpeg):<input type='file' accept='image/jpeg,image/jpg' name='dosya' /><br>
			  Yazar:<select id='yazar' name='yazar'><br>
			  ";//gerekli input bilgileri.
			$sql="select * from yazarlar ";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {//bütün yazarlar select optionlara eklenecek
				while($row = $result->fetch_assoc()) {
					echo "
					<option value='".$row['yazarID']."'>".$row['yazarAd']." ".$row['yazarSoyad']."</option>
					";//yazarın adı value böylecek rahatlıkla ekleme silme yapılabilir.
				}
			}
			echo "</select><br />
			Kategori:<select id='kategori' name='kategori'>";
			$sql="select * from kategoriler ";//bütün kategoriler select optionlara eklenecek
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					echo "
					<option value='".$row['kID']."'>".$row['kAdi']."</option>
					";
				}
			}
			echo "</select><br />
			<input class='btn btn-dark' name='hyukle' type='submit' value='Haberi Ekle'>
			</form>
			";//hekle butonuyla gelen işlem sonucunda haber eklenirse hyukle post ile tekrar bu sayfaya iletilecek
		}
		else if(isset($_POST['hsil'])){//haber silmek için
			echo "
			<form method='post' action='' >
			  Silinecek haberin ID'si:<input  class='form-control' type='text' id='haberID' name='haberID' ><br><br>
			<input class='btn btn-dark' name='hdbsil' type='submit' value='Haberi Sil'>
			</form>
			";//hdbsil post ile bilgiler tekrar bu sayfaya gelecek
		}else if(isset($_POST['hgun'])){//haber güncellemek için
			echo "
			<form method='post' action='' enctype='multipart/form-data'>
			  Guncellecek Haber id:<input  class='form-control' type='text' id='gid' name='gid' ><br><br>
			  Başlık:<input  class='form-control' type='text' id='baslik' name='baslik' ><br><br>
			  Haber İçeriği:<textarea class='form-control' id='text' name='text' placeholder='Haber içeriği' rows='5'></textarea><br><br>
			  Yazar:<select id='yazar' name='yazar'><br>
			  ";//haberi güncellemek için gerekli inputlar
			$sql="select * from yazarlar ";//yazarlar select optiona eklendi
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					echo "
					<option value='".$row['yazarID']."'>".$row['yazarAd']." ".$row['yazarSoyad']."</option>
					";
				}
			}
			echo "</select><br />
			Kategori:<select id='kategori' name='kategori'>";
			$sql="select * from kategoriler ";
			$result = $conn->query($sql);//kategoriler select optiona eklendi
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					echo "
					<option value='".$row['kID']."'>".$row['kAdi']."</option>
					";
				}
			}
			echo "</select><br />
			<input class='btn btn-dark' name='habgun' type='submit' value='Haberi Güncelle'>
			</form>
			";//habgun butonuna tıklnaınca bilgiler tekrar bu forma gelecek
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
