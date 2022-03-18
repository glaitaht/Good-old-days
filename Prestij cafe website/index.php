<!DOCTYPE html>
<html lang="en">
<head>
  <title>Prestij Cafe & Bistro & Restorant</title>
  <meta charset="utf-8">
 <link rel="shortcut icon" href="icon.gif" type="image/x-icon" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <style>
      
      @media (min-width: 768px){
          .navbar-nav{
              float: right;}
          .icon-bars a{
              padding: 15px;
          }
      }
      @media (min-width: 768px){
          .resim{
              width: 25%;  }
      }
      @media (max-width: 767px){
          .resim{
              width: 70%;  }
          .icon-bars a{
              padding: 10px;
          }
      }
      @media (min-width: 1720px){
          .icon-bars a{
              padding: 22px;
          }
      }
      @media (min-width: 1720px){
          .bayram a{
              padding: 20%;
          }
      }
        
.icon-bars {
  position: fixed;
  top: 50%;
  -webkit-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  transform: translateY(-50%);
}

.icon-bars a {
  display: block;
  text-align: center;
  transition: all 0.3s ease;
  color: white;
  font-size: 20px;
}

.icon-bars a:hover {
  background-color: #000;
}

.facebook {
  background: #3B5998;
  color: white;
}

.instagram {
  background: #F4027B;
  color: white;
}

.google {
  background: #dd4b39;
  color: white;
}


.youtube {
  background: #bb0000;
  color: white;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 3; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  -webkit-animation-name: fadeIn; /* Fade in the background */
  -webkit-animation-duration: 0.4s;
  animation-name: fadeIn;
  animation-duration: 0.4s
}

/* Modal Content */
.modal-content {
  position: fixed;
  bottom: 0;
  background-color: #fefefe;
  width: 100%;
  -webkit-animation-name: slideIn;
  -webkit-animation-duration: 0.4s;
  animation-name: slideIn;
  animation-duration: 0.4s
}

/* The Close Button */
.close {
  color: white;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}

/* Add Animation */
@-webkit-keyframes slideIn {
  from {bottom: -300px; opacity: 0} 
  to {bottom: 0; opacity: 1}
}

@keyframes slideIn {
  from {bottom: -300px; opacity: 0}
  to {bottom: 0; opacity: 1}
}

@-webkit-keyframes fadeIn {
  from {opacity: 0} 
  to {opacity: 1}
}

@keyframes fadeIn {
  from {opacity: 0} 
  to {opacity: 1}
}
      a {
          text-decoration: none;
      }
      a:hover{
          text-decoration: none;
      }
      
  </style>
</head>
<body style="font-family: 'Open Sans', sans-serif;
    background-image: url('bgv.jpg');
    background-size: cover;
    background-attachment: fixed;
    background-position: bottom;">

<nav class="navbar navbar-inverse" style="border:none;;background-color:unset;">
  <div class="container-fluid">
      <center><a href="index.php"><img src="prestij.png" class="resim" style="margin-top:1em;"></a> </center>
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
            <!--<a class="navbar-brand" href="#"> asd</a>-->
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <center><ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Anasayfa</a></li>
        <li><a href="hakkimizda.php">Hakkımızda</a></li>
        <li><a href="menu.php">Menümüz</a></li>
        <li><a href="galeri.php">Galeri</a></li>
        <li><a href="iletisim.php">İletişim</a></li>
      </ul></center>
    </div>
  </div>
</nav>

    <center><hr style="border-color: black;
    border-style: solid;
    border-width: 1px;
    width:90%"></center>
    
    
    
<div class="icon-bars" style="z-index:2;">
  <a href="https://www.facebook.com/prestijcafepub" class="facebook"target="_blank"><i class="fa fa-facebook"></i></a> 
  <a href="https://www.instagram.com/prestijcafepub/" class="instagram"target="_blank"><i class="fa fa-instagram"></i></a> 
  <a href="https://www.google.com/search?q=prestij+cafe" class="google"target="_blank"><i class="fa fa-google"></i></a> 
  <a href="https://www.youtube.com/results?search_query=prestij+cafe+bar" class="youtube" target="_blank"><i class="fa fa-youtube"></i></a> 
</div>
    
    
<div class="jumbotron" style="background-color:unset;">
  <div class="container text-center">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
            <li data-target="#myCarousel" data-slide-to="3"></li> 
          </ol>

          <!-- Wrapper for slides -->
          <div class="carousel-inner" > 

            <div class="item active">
              <img src="images/carou/caddeds.jpg" alt="Ferah Bakış">
            </div>

            <div class="item">
              <img src="images/carou/ustshnds.jpg" alt="Üst kat">
            </div>
            <div class="item">
              <img src="images/carou/prestijtbl.jpg" alt="Tabela">
            </div>
            <div class="item">
              <img src="images/carou/dsgc.jpg" alt="Bayram">
            </div>
          </div>

          <!-- Left and right controls -->
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
</div>
  
    
    
<div class="container">
  <div class="row">
    <div class="col-md-4">
      <div class="thumbnail">
        <a href="images/nrgl.jpg" target="_blank">
          <img src="images/nrgl.jpg" alt="nrgl" style="width:100%">
          <div class="caption">
              <center><p>Farklı lezzetler tadabileceğiniz, daima taze ve profesyoneller tarafından hazırlanan nargilelerimizi içmeye bekliyoruz.</p></center>
          </div>
        </a>
      </div>
    </div>
    <div class="col-md-4">
      <div class="thumbnail">
        <a href="images/altort.jpg" target="_blank">
          <img src="images/altort.jpg" alt="cafe" style="width:100%">
          <div class="caption">
            <center><p>Sabahları kahvenizi alıp kitap okuyabileceğiniz, ferah sefa köşemiz.</p></center>
          </div>
        </a>
      </div>
    </div>
    <div class="col-md-4">
      <div class="thumbnail">
        <a href="images/pasta.jpg" target="_blank">
          <img src="images/pasta.jpg" alt="pst" style="width:100%">
          <div class="caption">
             <center><p>Günlük yapılan taze pasta ve kekleri yemeğe, taze sıkılmış portakal suları içmeye sizleri de bekliyoruz.</p></center>
          </div>
        </a>
      </div>
    </div>
    <div class="col-md-4">
      <div class="thumbnail">
        <a href="images/ustshnbr.jpg" target="_blank">
          <img src="images/ustshnbr.jpg" alt="ust" style="width:100%">
          <div class="caption">
             <center><p>Yazın serin, kışın sıcak üst katımızda yemek yemeğe, türk kahvenizi yudumlamaya davetlisiniz.</p></center>
          </div>
        </a>
      </div>
    </div>
    <div class="col-md-4">
      <div class="thumbnail">
        <a href="images/frame.jpg" target="_blank">
          <img src="images/frame.jpg" alt="hyt" style="width:100%">
          <div class="caption">
             <center><p>Hayat birlikte güzel, arkadaşlarınız ve ailenizle paylaşacağınız güzel anılar için kapılarımız sizlere daima açık.</p></center>
          </div>
        </a>
      </div>
    </div>
    <div class="col-md-4">
      <div class="thumbnail">
        <a href="images/ustshngc.jpg" target="_blank">
          <img src="images/ustshngc.jpg" alt="cnl" style="width:100%">
          <div class="caption">
             <center><p>Yaz-kış demeden, her gün bir başka tatta canlı müzik keyfini çıkarmaya bekliyoruz. </p></center>
          </div>
        </a>
      </div>
    </div>
  </div>
</div>

<footer class="container-fluid text-center" style="margin-top:20px;backgroun">
  <p class="bg-info" style="padding-bottom:0px;" >Bu site <a href="#" id="myBtn">Cem Kılıç</a> tarafından 2019'da kurulmuştur.</p>
    
<!-- The Modal -->
<div id="myModal" class="modal" >

  <!-- Modal content -->
  <div class="modal-content" style="background-color:black;color:white;z-index: 2;">
    <div class="modal-header" style="background-color:black;color:white;">
      <span class="close">&times;</span>
      <h2>Cem Kılıç</h2>
    </div>
    <div class="modal-body" style="margin-top:10px;">
      <p>Geleceğin bilgisayar mühendisi, şimdinin programcısı.</p>
      <p>Sosyal medya hesaplarım:</p>
    </div>
    <div class="modal-footer" style="background-color:white;color:black;">
      <center><a href="https://www.instagram.com/cemscem.97" target="_blank"><img src="ins.png"  width="30px;"></a> <a href="https://www.facebook.com/cemscem.97" target="_blank" style="margin-left:15px;"><img src="face.png"  width="30px;"></a></center>
    </div>
  </div>

</div>
</footer>

<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
</body>
</html>
