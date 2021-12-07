using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace WindowsFormsApp1
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent(); 
        } // buradan öncesi vs'nin hazır yaptığı kütüphane ve method tanımlamaları

        private void Form1_Load(object sender, EventArgs e)//form yüklendiğinde çalışacak
        {
            comboBox1.Items.Add("Gıda");//program çalıştığında bu seçenekleri combobox1(ürün sınıfa ekleyecek)
            comboBox1.Items.Add("Elektronik");//hem combobox1 hem combobox2 nin dropdownstyle kısmını dropdownlist yaptık
            comboBox1.Items.Add("Beyaz Eşya");//o yüzden her ihtimale karşı itemleri buradan ekledim
            comboBox1.Items.Add("Temizlik");
            comboBox1.Items.Add("Züccaciye");
            comboBox1.Items.Add("Tuhafiye");
            comboBox1.Items.Add("Unlu Mamül");
        }

        private void comboBox1_SelectedIndexChanged(object sender, EventArgs e)//combobox1'in seçili elemanı değiştinde çalışacak
        {
            //combobox1'in(ürün sınıf) seçilen itemi değiştiğinde combobox2'nin(ürün türü) içindekiler değişecek.
            comboBox2.Items.Clear();//bütün itemleri sıfırladı
            comboBox2.Text = "";//yazılı değeri boşalttı
            if (comboBox1.SelectedIndex == 0)//ilk itemse gıda
            {
                comboBox2.Items.Add("Çikolata");
            }
            else if (comboBox1.SelectedIndex ==1 )//ikinciyse elektronik şeklinde gidecek
            {
                comboBox2.Items.Add("Cep Tel");
            }
            else if (comboBox1.SelectedIndex ==2 )//beyaz eşya
            {
                comboBox2.Items.Add("Çamaşır Mak.");
            }
            else if (comboBox1.SelectedIndex ==3 )//temizlik
            {
                comboBox2.Items.Add("Deterjan");
            }
            else if (comboBox1.SelectedIndex ==4 )//züccaciye
            {
                comboBox2.Items.Add("Yemek Takımı");
            }
            else if (comboBox1.SelectedIndex == 5)//tuhafiye
            {
                comboBox2.Items.Add("Giyim");
            }
            else if (comboBox1.SelectedIndex == 6)//unlu mamül
            {
                comboBox2.Items.Add("Ekmek");
            }
        }

        private void button1_Click(object sender, EventArgs e)// button1'e tıklanınca çalışacak
        {
            float urunfiyat = 0; // float değişken yaptık
            if (comboBox1.Text == "" || comboBox2.Text == "" || textBox1.Text == "" || textBox2.Text == "" || numericUpDown1 == null)
            {
                // eğer combobox1, combobox2, textbox1, textbox2 veya numericupdown1'in texti boş ise
                MessageBox.Show("Hiçbir alan boş bırakılamaz.");// hata verecek
                return;//ve bir şey yapmadan çıkacak
            }
            if(!float.TryParse(textBox2.Text, out urunfiyat))
            {// eğer textbox2 alanına girilen değer float değere dönüştürülemiyorsa
                MessageBox.Show("Fiyat alanına girilen değer çevrilemedi.");//hata verecek
                return;//ve bir şey yapmadan çıkacak
            }
            dataGridView1.Rows.Add(textBox1.Text,comboBox1.Text,comboBox2.Text,numericUpDown1.Value.ToString(),urunfiyat);
            //eğer buraya kadar gelebildiyse datagridview1'e yeni satır ekleyecek(kullanıcıdan aldıklarımızla)
        }

        private void button2_Click(object sender, EventArgs e)// button2'ye tıklanınca çalışacak
        {
            dataGridView2.Rows.Clear();//datagridview2'nin içini boşalttı
            if (textBox3.Text == "")// eğer textbox3'e bir değer girilmemişse hepsini hesaplayacak
            {
                for (int i = 0; i < dataGridView1.RowCount-1; i++)//datagridview1'deki bütün elemanları dolaşacak
                {
                    string isim = dataGridView1.Rows[i].Cells[0].Value.ToString();//datagridview1'in satırındaki elemanları  
                    string sinif = dataGridView1.Rows[i].Cells[1].Value.ToString();//local değişkenlere atadık
                    string tur = dataGridView1.Rows[i].Cells[2].Value.ToString();
                    int adet = int.Parse(dataGridView1.Rows[i].Cells[3].Value.ToString());//adeti tam sayıya çevirdik
                    float alinanfiyat = float.Parse(dataGridView1.Rows[i].Cells[4].Value.ToString());//fiyatı ondalıklı sayıya çevirdik
                    float kdv = 0; float otv = 0;//otv ve kdv diye ondalıklı değişken belirledik
                    if (sinif == "Temizlik" || sinif == "Züccaciye" || sinif == "Tuhafiye")// eğer satırdaki elemanın sinifi bunlardan biriyse
                    {
                        kdv = 18; otv = 0;//kdv ve otv oranı ona göre alacak
                    }
                    else if (sinif == "Elektronik")//ilk ifde değilse buna bakacak
                    {
                        otv = 50; kdv = 18;
                    }
                    else if (sinif == "Beyaz Eşya")//ikinci ifde değilse buna bakacak
                    {
                        otv = 20; kdv = 18;
                    }
                    else if (sinif == "Unlu Mamül")//üçüncü ifde değilse buna bakacak
                    {
                        otv = 0; kdv = 1;//ve sinifa göre kdv otv belirleyecek
                    }
                    else if (sinif == "Gıda")//dördüncüde değilse buna bakacak
                    {
                        otv = 0; kdv = 8;
                    }
                    else//hiçbiri değilse hata var diye uyarı verecek
                    {
                        MessageBox.Show("Hata var");
                    }
                    float kar = (alinanfiyat * 10) / 100;//kar %10 (yani alınan fiyatın 10la çarpılıp 100e bölümü)
                    otv = (otv / 100) * (alinanfiyat + kar);//otv yukarda sinifla belirlenen oran 
                    kdv = (kdv / 100) * (alinanfiyat + kar + otv);//kdv yukarda sinifla belirlenen oran
                    float satis = alinanfiyat + kar + otv + kdv;//satış hepsinin toplamı
                    float beklenen = adet * kar;//beklenense adetle karın çarpımı

                    dataGridView2.Rows.Add(isim, sinif, tur, adet, alinanfiyat+"TL", kar + "TL", otv + "TL", kdv + "TL", satis + "TL", beklenen + "TL");
                    //hepsini yeni bi satır olarak datagridview2'ye ekledik
                }
            }
            else// eğer textbox3'e girilen bir değer varsa sadece o değerin olduğu satırı yazdıracak
            {
                if(dataGridView1.RowCount-1 == 0) { MessageBox.Show("Ürünler tablosu boş");return;}//Eğer datagridview1'de yeterli eleman yoksa hata verip bir şeyyapmadan çıkacak
                for (int i = 0; i < dataGridView1.RowCount-1; i++)//yeterli eleman varsa bütün satılara bakacak
                {
                    if (dataGridView1.Rows[i].Cells[0].Value.ToString() == textBox3.Text)//eğer herhangi bir satırın ilk hücresinde textbox3'e girilen değer varsa
                    {
                        string isim=dataGridView1.Rows[i].Cells[0].Value.ToString();// satırdaki bilgileri değişkenlere alacak
                        string sinif=dataGridView1.Rows[i].Cells[1].Value.ToString();
                        string tur = dataGridView1.Rows[i].Cells[2].Value.ToString();
                        int adet = int.Parse(dataGridView1.Rows[i].Cells[3].Value.ToString());//adeti tam sayı
                        float alinanfiyat = float.Parse(dataGridView1.Rows[i].Cells[4].Value.ToString());//alinan fiyatı ondalıklı sayı olarak alacak
                        float kdv=0; float otv=0; 
                        if(sinif=="Temizlik" || sinif=="Züccaciye" || sinif == "Tuhafiye")//sinifin ismine göre kdv ve otv oranı belirlenecek
                        {
                            kdv = 18; otv = 0;
                        }
                        else if(sinif == "Elektronik")
                        {
                            otv = 50; kdv = 18;
                        }
                        else if(sinif =="Beyaz Eşya")
                        {
                            otv = 20; kdv = 18;
                        }
                        else if(sinif =="Unlu Mamül")
                        {
                            otv = 0;kdv = 1;
                        }
                        else if(sinif == "Gıda")
                        {
                            otv = 0;kdv = 8;
                        }
                        else
                        {
                            MessageBox.Show("Hata var");
                        }
                        float kar = (alinanfiyat * 10) / 100;// kar
                        otv = (otv/100) * (alinanfiyat+kar);//otv
                        kdv = (kdv / 100) * (alinanfiyat + kar + otv);//kdv
                        float satis = alinanfiyat + kar + otv + kdv;//satiş fiyatları belirlenecek
                        float beklenen = adet * kar;// beklenen karı alacak

                        dataGridView2.Rows.Add(isim,sinif,tur,adet,alinanfiyat + "TL", kar + "TL", otv + "TL", kdv + "TL", satis + "TL", beklenen + "TL");
                        //yeni bir satıra ekleyip
                        break;//döngüden çıkacak yani 1 kere çalışacak
                    }
                    else if(i==(dataGridView1.RowCount-2))//eğer son satıra kadar gelmişte o elemanı bulamamışsa 
                    {
                        MessageBox.Show(textBox3.Text + " isimli bir ürün bulunamadı");//öyle bir eleman yok demektir
                        return;//br şey yapmadan çıkacak
                    }
                }

            }
        }
    }
}
