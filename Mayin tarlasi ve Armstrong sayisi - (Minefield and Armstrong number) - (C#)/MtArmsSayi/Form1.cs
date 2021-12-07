using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Globalization;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace MtArmsSayi
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        public int[,] oyun = new int[5,5]; //mayın tarlasıda mayınların tutulacağı dizi
        public int[,] mayinSayi = new int[5, 5]; // mayınlar yerleştikten sonra hangi butona kaç tane mayın yakın gösteren dizi
        int sure = 0; int mayin=0; int zamanKisiti = 30; // sure timer eklentisinin zamanı için, mayin oyuncunun seçtiği mayın sayısı
        bool oyunBasla = false; // zamankisiti oyuncunun seçtiği zaman kısıtlaması, oyunbaşla oyunun başlayıp bitmesini takip ediyor.
        int kackaldi = 0; // işaretlenen butonların kaç tane kaldıığını takip eden değişken
        Form2 frm2 = new Form2(); // form2 nesnesi, bağlantı kurmak için.
        void mayinHesapla() // oyun başlayınca oyun matrisine göre yakındaki matrisleri hesaplayan fonksiyon
        {
            for (int k = 0; k < 5; k++) // k satırı 
            {
                for (int l = 0; l < 5; l++) //l sütunu ifade ediyor. 
                {
                    int kacMayin = 0;
                    if (l<4 && oyun[k, l +  1] == 1) kacMayin++; // baktığımız olasılıklar 8 tane, bir butonun 8 tarafı
                    if (l>0 && oyun[k, l + -1] == 1) kacMayin++;// 8 kontrolü yaparken ekstradan ve'ler ekledik
                    if (k < 4 && oyun[k+1, l ] == 1) kacMayin++; //  amacı dizi sınırlarını aşmamak
                    if (k < 4 && l < 4 &&oyun[k + 1, l+1] == 1) kacMayin++;  // k ve l satir sutun kontrolü yaptığı için
                    if (k < 4 && l > 0 &&oyun[k + 1, l-1] == 1) kacMayin++; // bir sonraki satır elemanına bakacaksak satırın 4den küçük olması durumuna bakıyoruz
                    if (k > 0 && oyun[k-1, l ] == 1) kacMayin++; // bir önceki satır elemanına bakacaksak satırın 0dan büyük olması durumuna bakıyoruz
                    if (k > 0 && l<4 &&oyun[k - 1, l+1] == 1) kacMayin++;
                    if (k > 0 && l> 0&&oyun[k - 1, l-1] == 1) kacMayin++;
                    mayinSayi[k, l] = kacMayin; // kaç tane mayının olduğunu bulup belli indise işliyoruz. 
                }
            }
        }

        void oyunBitti() // oyun tamamen bitince herşeyi sıfır haline getirmesi için yazılan fonksiyon
        {
            for (int i = 0; i < 5; i++)
            {
                for (int j = 0; j < 5; j++)
                {
                    Button btn = (Button)(this.Controls.Find("button" + ((i * 5) + j + 1), true)[0]);
                    btn.BackColor = Color.FromArgb(128, 128, 128);
                    btn.Text = ""; // buton içindeki yazıları ve renkleri temizliyor
                }
            }
            timer1.Stop(); sure = 0; // zamanlayıcıyı durduruyor ve timerdaki süreyi 0lıyor.
            oyunBasla = false; // oyunun bittiğini belirtiyor 
        }

        private void Form1_Load(object sender, EventArgs e)
        { // uygulama ilk açıldığında bazı elle yapmamız gereken ayarları yapıyoruz
            timer1.Interval = 1000; // timer 1sn ile artsın
            panel1.BackColor = Color.FromArgb(200, 200, 200); // bazı kontrollerin arkaplan rengini ayarlasın
            panel2.BackColor = Color.FromArgb(255, 255, 255);
            label1.BackColor = Color.FromArgb(191, 205, 219);
            label6.BackColor = Color.FromArgb(191, 205, 219);
            label2.BackColor = Color.FromArgb(240, 248, 255);
            label3.BackColor = Color.FromArgb(240, 248, 255);
            label4.BackColor = Color.FromArgb(240, 248, 255);
            label7.BackColor = Color.FromArgb(191, 205, 219);
            bul.BackColor = Color.FromArgb(0, 102, 204); 
            basla.BackColor = Color.FromArgb(0, 102, 204);
            this.FormBorderStyle = FormBorderStyle.FixedSingle; // formun şeklini değiştirmesin
            foreach (Control buton in this.panel2.Controls) // panel2'deki bütün butonların arka plan rengini 
            {                                               // ve textlerini tamamen silsin.
                if (buton is Button)
                {
                    buton.BackColor = Color.FromArgb(128, 128, 128);
                    buton.Text = "";
                }
            }
        }

        private void bul_Click(object sender, EventArgs e) // 2. sorudaki Armstrong sayılarını hesaplayan click eventi
        { 
            listBox1.Items.Clear();//öncesinde kullanıldıysa diye listbox'u temizledik
            int altsinir = int.Parse(altSinir.Text); // altsiniri integere çevirdik
            int ustsinir = int.Parse(ustSinir.Text); // üstsiniri integere çevirdik
            for (int i = altsinir; i < ustsinir; i++) // altsinirdan üst sınıra kadar bütün sayıları döngüye soktuk
            {
                int sayi, hatirlatici, sonuc = 0;
                sayi = i;

                while (sayi != 0) // döngüdeki her sayı 0a eşit olmadıkça while işleminde kalıyor
                {
                    hatirlatici = sayi % 10; // sayının 10 ile modunu alıyoruz, elimizde en son basamaktaki sayi oldu
                    sonuc += hatirlatici * hatirlatici * hatirlatici; // en son basamaktaki sayının küpünü topladık
                    sayi /= 10; // sayı int değer idi 10a bölünce en son basamak kayboldu. ve başa döndü
                }

                if (sonuc == i) // en sondaki basamakların küpünü toplayarak elde ettiğimiz sayı döngüye giren sayıya eşitse
                {               // listbox'a ekledik
                    listBox1.Items.Add(i);
                }
            }

        }

        private void altSinir_KeyPress(object sender, KeyPressEventArgs e) // alt sınırın sadece sayı olmasını sağladık, nokta dahil
        {
            if (!char.IsControl(e.KeyChar) && !char.IsDigit(e.KeyChar) && !(e.KeyChar != '.'))
            {
                e.Handled = true;
            }
        }

        private void ustSinir_KeyPress(object sender, KeyPressEventArgs e) // üst sınırında sadece sayı olmasını sağladık, nokta dahil.
        {
            if (!char.IsControl(e.KeyChar) && !char.IsDigit(e.KeyChar) && !(e.KeyChar != '.'))
            {
                e.Handled = true;
            }
        }

        private void butonClick(object sender, EventArgs e) // panel2 içerisindeki bütün butonların ortak click eventi
        {
            if (oyunBasla)// eğer oyun true yani başlamış halde ise bu kısma giricek
            {    
                timer1.Stop(); sure = 0;
                timer1.Start(); // önceden açık olan süre durdu, sıfırlandı ve tekrar başladı oynamak için zamanKisiti kadar vaktimiz var
                Button buton = (Button)sender; // gelen sender objesi butona dönüştürüldü
                for (int i = 0; i < 5; i++) // satır sayısı kadar döndü
                {
                    for (int j = 0; j < 5; j++) // sütün sayısı kadar döndü
                    {
                        Button btn = (Button)(this.Controls.Find("button" + ((i * 5) + j + 1), true)[0]);//bütün butonlara ulaştık
                        // buradaki amaç formdaki bütün kontrolleri dolaşıp adı sender objesindekiyle bir olan butonu bulmak
                        if (buton.Name == btn.Name) // bunun karşılaştırmasını yaptık
                        {
                            buton.Text = mayinSayi[i, j].ToString(); // doğru butonda girdi ve yakın mayın sayısını yazdı
                            if (oyun[i, j] == 1) // eğer bu noktada mayın varsa buraya girecek
                            { // buraya girdiğinde butonu kırmızı yapacak ve oyunu kaybettiğimizi söylecek.
                                buton.BackColor = Color.FromArgb(255, 0, 0);
                                MessageBox.Show("Mayını seçtiniz, oyunu kaybettiniz");
                                oyunBitti();// oyun bitince çalışan fonksiyonu çağırdı.
                            }
                            else
                            { // yoksa buraya girecek ve butonu yeşil yapacak
                                buton.BackColor = Color.FromArgb(0, 255, 0);
                                kackaldi--; // eğer mayına basmadıysak kalan mayın sayısını 1 eksilticez.
                                if (kackaldi == 0) { MessageBox.Show("Tebrikler oyunu kazandınız."); oyunBitti(); } // eksilttiğimiz zaman 0 kalıyorsa oyunu yendik demektir.
                            }
                        }
                    }
                }

            }
            else
            { // eğer oyunBasla false yani başlatılmadıysa sadece hata verecek.
                MessageBox.Show("Henüz oyun başlatmadınız.");
            }
        }



        private void basla_Click(object sender, EventArgs e) // oyunu başlatan düğme eventi
        {
            if (oyunBasla) //oyun zaten halihazırda açılmışsa true olmuşsa buraya girecek.
            {  
                DialogResult res = MessageBox.Show("Yeni oyuna başlamak istediğinize emin misiniz ?", "Uyarı", MessageBoxButtons.YesNo, MessageBoxIcon.Question); 
                // kullanıcıya soruyu sorduk
                if(res==DialogResult.Yes) { oyunBitti(); basla_Click(sender, e); return; }
                // cevap evetse oyunu bitir fonksiyonunu çağırdık, sonra tekrar bu düğmeye basmasını sağladık ve 2 kere tıklanmış halde olduğu için 1 kere çıkarttık.
                else { return; } // eğer hayır deyip oyuna devam edecekse sadece eventten çıkarttık.
            }
            mayin = Convert.ToInt32(numericUpDown1.Value);//kullanıcının seçtiği mayın sayısını atadık
            zamanKisiti = Convert.ToInt32(numericUpDown2.Value);// kullanıcının seçtiği süreyi atadık
            if (mayin > 24 || mayin < 1) { MessageBox.Show("Mayın sayısı hatalı."); return; } // eğer mayın 24 den fazla veya 1den azsa oyun olmayacağı için eventten çıktı.
            if (zamanKisiti < 2) { MessageBox.Show("Süre hatalı."); return; } // eğer süre kısıtlaması 2 sn az ise oyun oynanamayacağı için eventten çıktık
            kackaldi = 25 - mayin;//kullanıcının seçtiği mayın sayısını toplam buton sayısından çıkartıp kaç tane mayınsız alan kaldığını takip ettiriyoruz
            sure = 0;  // butona basmaya kalan süreyi 0'ladık 
            timer1.Start();// timer1'i başlattık
            oyunBasla = true; // oyunun başladığını belirttik
            for (int i = 0; i < 5; i++)
            {// satır sayısı kadar dönecek
                for (int j = 0; j < 5; j++)
                {//sütün sayısı kadar dönecek
                    oyun[i, j] = 0; // her satır ve sütundaki elemanı 0 yapacak
                }
            }
            while (mayin > 0) // kullanıcının girdiği mayın sayısı 0 olana kadar döngüde kalacak
            {
                Random rastgele = new Random(); // random sayı üretmek için random nesnesi ürettik
                int random = rastgele.Next(0, 5); // random nesnesinden 5 e kadar 1 sayı seçtik
                int random2 = rastgele.Next(0, 5); // bir sayı daha seçtik
                if (oyun[random,random2] == 0) // bu iki sayının olduğu yerde mayın olmadığından emin olduk
                {
                    oyun[random,random2] = 1;// mayın koyduk
                    mayin--;// kullanıcının istediği  mayın sayısını bir azalttık
                }
            }
            mayinHesapla();// etraftaki mayınların sayısını fonksiyonla hesaplattık
            for (int i = 0; i < 5; i++)
            { 
                for (int j = 0; j < 5; j++)
                {
                    frm2.oynf[i,j] = oyun[i, j]; // her satır ve sütun elemanını frm2'deki oyun dizisine gönderdik
                    frm2.mayinSayi[i, j] = mayinSayi[i, j];// her satır ve sütun elemanını mayın sayısını tutan diziye gönderdik
                }
            }
            frm2.Form2_Load(sender,e); // düğmeye her basıldığında form2'nin load olmasını sağladık.
            frm2.Show();// form2'yi gösterdik (unhide)

        }

        private void timer1_Tick(object sender, EventArgs e) // timer tool'unun ana fonksiyonu
        {
            sure++;// her saniye süreyi 1 arttırdı
            label7.Text = "Kalan Süre =  " + (zamanKisiti - sure + 1).ToString(); // sol alttaki label'a kalan süreyi yazdırdı.
            if (zamanKisiti < sure)// süre kullanıcının istediği zaman kısıtını geçince 
            {
                timer1.Stop(); //timer'ı durdurduk
                MessageBox.Show("Süre bitti, kaybettiniz");//süre bittiği için kaybettiğini yazdırdık
                oyunBitti();// oyunu bitirdik.
            }
        }
    }
}
