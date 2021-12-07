girişbilgi - bu dosyada danışman ve öğrencilerin giriş bilgileri tutulur
ogrencikisisel - bu dosyada öğrenciye ait iletişim ve bölüm adı bilgileri tutulur.
ogrenciakademik - bu dosyada ogrencinin harç yatırma bilgisi dönem bilgisi sınıf adı ve daha önce aldığı dersler tutulur
dershavuzu - derslerin dönemi, kodu ve adı bu dosyada tutulur
onaybekleyen - ders seçimi yapan öğrencinin tc'si seçim yapılan bölüm harç yatırma bilgisi ve seçilen derslerin kodu tutulur
onaylanan - onaylanan ders seçimleri danışman onaylayınca bu dosyaya kaydedilir.

1. senaryo öğrenci girişi
-öğrenci giriş tipine o, tcsini ve şifresini yazarak giriş yapar.
-öğrencinin kişisel bilgileri ekrana yazdırılır
-öğrencinin daha önce almış olduğu dersler ekrana yazdırılır.( kaldı / geçti şeklinde)
-öğrencinin alabileceği dersler ekrana yazdırılır (eğer alttan alınması zorunluysa yanında yazar)
-öğrencinin almak istediği dersin kodu alınır
-eğer agnosu 1.75'in üstünde ise 45, altında ise 30 akts doldurana kadar bir önceki adım tekrar edilir(ders almayı bitirmek için '.' yazıp çıkar)
-seçilen dersler kayıt edilir.(onaybekleyen dosyasına)

2. senaryo danışman girişi
-danışman giriş tipine d, tcsini ve şifresini yazarak giriş yapar.
-ders havuzu ekrana yazdırılır.(ders havuzu dosyasından)
-ders seçim işlemlerini görmek istediği sınıf bilgisi sorulur(öğrenci akademik dosyasından  sınıf bilgileri görülebilir)
-sınıf bilgilerine göre öğrenciler tcno, harc yatırma ve seçtiği derslerin koduyla sıralanır.
-danışman onaylamak veya reddetmek istediği öğrencinin tcsini girer(öğrencinin harcı ödenmediyse yazdırılıp program biter)
-red/onay alınır ve işlem yapılır(onaylanırsa onaylanan dosyasına yazılır,red edilirse o satır silinir)