using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.IO;
using System.Reflection.Emit;

namespace algoritmik
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }


        private void button1_Click(object sender, EventArgs e)
        {
            int[] deger = new int[1]; //dinamik boyutta olacağı için değer dizimizi 1 boyutta 1 elemanla oluşturduk
            FileStream fs = new FileStream("dosya1.txt", FileMode.Open, FileAccess.Read);
            //dosyayı yalnızca okuma yetkisiyle açtık 
            StreamReader st = new StreamReader(fs); // dosyayı okuyacak değişkeni tanımladık
            string satir = st.ReadLine();//dosyadan bi satırı okuyup string değişkene atadık
            int eleman=0;//kaç eleman okumuşuz onu tutacak degişken
            for (int i = 0; i < satir.Length; i++)//bütün satırdaki elemanları kontrol edecek
            {
                 int sayi; //satirdan alınacak sayı 
                 bool donusturme = int.TryParse(satir[i].ToString(), out sayi);//satırdaki eleman int'e çevrilebiliyor ise çevirecek
                 if (donusturme){//çeviremiyorsa false değeri ile if'e girmeyecek
                    Array.Resize(ref deger, deger.Length + 1);// deger isimli diziyi genişlettik
                    deger[eleman] = sayi;//degerin elemanıncı kısmına dönüştürdüğümüz sayıyı yazacak
                    eleman++;//okunan eleman sayısını arttıracak.(node'ların değeri 2 haneli ise düzgün çalışmayacaktır)
                 }
            }
            int uzunluk = deger.Length - 1; //uzunluk deger dizisinin uzunluğunun 1 eksiği(index farkı)
            int[,] baglanti = new int[deger.Length-1, deger.Length-1];// kare şekilde matris yaptık
            FileStream fs2 = new FileStream("dosya2.txt", FileMode.Open, FileAccess.Read);
            //2. dosyayı açtı 
            StreamReader st2 = new StreamReader(fs2);// açılan dosyayı okudu
            string satir2 = st2.ReadLine();// okuna ilk satırı satır2'ye attı, 
            int satirS = 0;//satır sayısını tuttu
            int sutunS = 0;//sutun sayısını tuttu
            while (satir2!= null) // satırın değeri boş olmadıkça çalışacak (son satırı bitirince bir başka satıra geçmek boş değer döndürür)
            {
                for (int i = 0; i < satir2.Length; i++) //satırdaki bütün elemanları dolaşacak
                {
                    if (satir2[i]==' ')//satırdaki eleman boşluksa döngü bir sonraki elemana geçecek
                    {
                        continue;
                    }
                    int sayi;//okunacak sayı
                    bool donusturme = int.TryParse(satir2[i].ToString(), out sayi);//değer tam sayıya çeviriliyor mu?
                    if (donusturme)// eğer çevriliyorsa değer, çevrilmiyorsa false dönecek
                    {
                        baglanti[satirS, sutunS] = sayi;// bağlantı dizisine sayıyı atadık
                        sutunS++;//sütün sayısını arttırdık
                    }
                }
                satirS++;sutunS = 0;//her satır bittiğinde sutunu 0'a çekerken satırı 1 arttırdık
                satir2= st2.ReadLine();// sonraki satıra geçtik
            }
            HesaplamaFunc(deger, baglanti,uzunluk);// işlemi yapacak fonksiyona dizileri ve uzunluğu gönderdik
            fs.Close();
            fs2.Close();
            st.Close();
            st2.Close();
        }
        void HesaplamaFunc(int[] deger, int[,] baglanti, int uzunluk)// geri birşey döndürmeyecek
        {
            for (int i = 0; i < uzunluk; i++)//baglantı dizisinin satırı
            {
                baglanti[i, i] = 1; // köşegenler 1 olmak zorunda çünkü her bi node kendinden başlayarak sonraki nodeları toplayacak
                for (int j = i; j < uzunluk; j++) //baglantı dizisinin sutunu kadar dönecek
                {
                    if (baglanti[i, j] == 1) //eğer satır ve sutundaki değer 1 ise yani bağlantısı var ise
                    {
                        for (int k = 0; k < uzunluk; k++) //sutunları dolaşacak
                        {
                            if (baglanti[j, k] == 1)// i ve j ile rastladığımız 1'in ait olduğu satıra gidip(j)
                            {                       //oradaki bütün 1'leri şuan olduğumuz satıra taşıdık(i)
                                baglanti[i, k] = 1;// böylece henüz 1. satırdaki 2. elemana geçmeden onun eriştiği elemana da ulaşacağız
                            }
                        }
                    }
                }
            }
            textBox1.Text = "";// textbox'u sıfırladık.(eğer textbox içerisine uzun şekilde yazılması isteniyorsa bu satırdan /* satırına kadar silin)
            for (int i = 0; i < uzunluk; i++) // satır dolaşacak
            {
                int toplam = 0;//her satırdaki toplamı bulacak
                for (int j = 0; j < uzunluk; j++) // sütun dolaşacak
                {
                    if (baglanti[i, j] == 1) // eğer baglantıdaki satır ve sutuna karşılık 1 varsa
                    {
                        toplam += deger[j];//toplam değişkeninde toplayacak
                    }
                }
                textBox1.Text += toplam; //toplanan değeri textbox'a yazacak
                if (i!=(uzunluk-1)) textBox1.Text += "-";// eğer son elemana gelmediyse "-" şeklini ekleyecek
            }
            /*for (int i = 0; i < uzunluk; i++) 
            {
                string satir = (i + 1) + " nolu düğümün puanı: ";
                int toplam = 0;
                for (int j = 0; j < uzunluk; j++)
                {
                    if (baglanti[i, j] == 1)
                    {
                        satir += deger[j].ToString();
                        toplam += deger[j];
                        if (j == uzunluk-1)
                        {
                            satir += "=" + toplam.ToString();
                        }
                        else
                        {
                            satir += "+";
                        }
                    }
                }
                textBox1.AppendText(satir);
                textBox1.AppendText(Environment.NewLine);
            }*/
        }

        
    }
}
