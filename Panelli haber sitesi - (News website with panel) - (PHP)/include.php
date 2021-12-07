<?php //her dosyada çalışması gereken bağlantıyı barındıran php kodu
$host = "localhost:3306"; //host ipsi local
$user = "root"; //kullanıcı adı hazır olarak root
$password = ""; //şifre yok
$dbname = "haberdb";// kullanılacak veritabanı
$conn = mysqli_connect($host, $user, $password,$dbname);//bağlantıyı oluşturdu
$conn->set_charset("utf8");//bağlantıdan gelecek karakter tipini belirtti
if (!$conn) {//eğer bağlantı gerçekleşmediyse hata verdi.
  die("Connection failed: " . mysqli_connect_error());
}
?>