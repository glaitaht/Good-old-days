<?php 
require 'include.php';
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
        <li><a href="index.php">Ana Sayfa</a></li>
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#" >Kategoriler<span class="caret"></span></a>
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
        <li><a href="galeri.php" class="active">Galeri</a></li>
        <li><a href="hakkimizda.php">Yazarlarımız</a></li>
        <li><a href="iletisim.php">İletişim</a></li>
      </ul>
    </div>
  </div>
</nav>


<div class="container-fluid bg-3 text-center" >    
  <h2>Galeri(son 20 haber)</h2><br>

<div class="container"style="margin-top:15px;">
	<div class="row">
		<div class="row">
            
		<?php 
			$sql="select * from haberler order by hID desc";//haberler tablosundaki haberleri hid ye göre azalan sırayla çağırdı
			$result = $conn->query($sql);//sorguyu çalıştırdı
			$hbr=0;
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					if($hbr==20) break;//20 olunca çıktı
					echo "
					<div class='col-lg-3 col-md-4 col-xs-6 thumb'>
                <a class='thumbnail' href='' data-image-id='' data-toggle='modal' data-title='".$row['baslik']."'
                   data-image='img/".$row['resimDir']."'
                   data-target='#image-gallery'>
                    <img class='img-thumbnail'
                         src='img/".$row['resimDir']."'
                         alt='".$row['hID']."'>
					</a>
				</div>
				";//20 haber için yeni divler ekledi
					$hbr++;
				}
			}
		?>

        </div>
        <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="image-gallery-title"></h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img id="image-gallery-image" class="img-responsive col-md-12" src="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary float-left" id="show-previous-image" style="float:left;"><i class="fa fa-arrow-left"></i>Önceki Resim
                        </button>

                        <button type="button" id="show-next-image" class="btn btn-secondary float-right"><i class="fa fa-arrow-right"></i>Sonraki Resim
                        </button>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>

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
<!-- galeri için gerekli script(bootstrap galeri ile alındı) -->
<script>
let modalId = $('#image-gallery');

$(document)
  .ready(function () {

    loadGallery(true, 'a.thumbnail');

    //This function disables buttons when needed
    function disableButtons(counter_max, counter_current) {
      $('#show-previous-image, #show-next-image')
        .show();
      if (counter_max === counter_current) {
        $('#show-next-image')
          .hide();
      } else if (counter_current === 1) {
        $('#show-previous-image')
          .hide();
      }
    }

    /**
     *
     * @param setIDs        Sets IDs when DOM is loaded. If using a PHP counter, set to false.
     * @param setClickAttr  Sets the attribute for the click handler.
     */

    function loadGallery(setIDs, setClickAttr) {
      let current_image,
        selector,
        counter = 0;

      $('#show-next-image, #show-previous-image')
        .click(function () {
          if ($(this)
            .attr('id') === 'show-previous-image') {
            current_image--;
          } else {
            current_image++;
          }

          selector = $('[data-image-id="' + current_image + '"]');
          updateGallery(selector);
        });

      function updateGallery(selector) {
        let $sel = selector;
        current_image = $sel.data('image-id');
        $('#image-gallery-title')
          .text($sel.data('title'));
        $('#image-gallery-image')
          .attr('src', $sel.data('image'));
        disableButtons(counter, $sel.data('image-id'));
      }

      if (setIDs == true) {
        $('[data-image-id]')
          .each(function () {
            counter++;
            $(this)
              .attr('data-image-id', counter);
          });
      }
      $(setClickAttr)
        .on('click', function () {
          updateGallery($(this));
        });
    }
  });

// build key actions
$(document)
  .keydown(function (e) {
    switch (e.which) {
      case 37: // left
        if ((modalId.data('bs.modal') || {})._isShown && $('#show-previous-image').is(":visible")) {
          $('#show-previous-image')
            .click();
        }
        break;

      case 39: // right
        if ((modalId.data('bs.modal') || {})._isShown && $('#show-next-image').is(":visible")) {
          $('#show-next-image')
            .click();
        }
        break;

      default:
        return; // exit this handler for other keys
    }
    e.preventDefault(); // prevent the default action (scroll / move caret)
  });

</script>
</body>
</html>
