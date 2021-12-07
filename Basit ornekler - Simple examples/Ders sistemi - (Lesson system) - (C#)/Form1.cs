using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace ogrencioto
{
    public partial class Form1 : Form
    {
        public class ogrenci
        {
            public string isim = "";
            public string soyisim = "";
            public string telefon = "";
            public string email = "";
            public string bolum = "";
            public string sifre = "";
            public string harcdurum = "";
            public string sinif = "";
            public string notort = "";
            public string secilendersler = "";
        }


        public static ogrenci[] ogr = new ogrenci[0];
        public static string[] dersno = new string[0];
        public static string[] dersad = new string[0];
        public static int girishali = -1;

        public Form1()
        {
            InitializeComponent();
        }

        private void Form1_Load(object sender, EventArgs e)
        {
            FileStream fs1 = new FileStream("ogrenci.txt", FileMode.Open, FileAccess.Read);
            FileStream fs2 = new FileStream("ogrenimbilgi.txt", FileMode.Open, FileAccess.Read);
            FileStream fs3 = new FileStream("dershavuzu.txt", FileMode.Open, FileAccess.Read);
            StreamReader sr1 = new StreamReader(fs1);
            StreamReader sr2 = new StreamReader(fs2);
            StreamReader sr3 = new StreamReader(fs3);
            string satir;int satirsayisi = 0;
            while (( satir=sr1.ReadLine()) != null)
            {
                Array.Resize(ref ogr, ogr.Length + 1);
                ogr[satirsayisi] = new ogrenci();
                int tani = 0;
                for (int i = 0; i < satir.Length; i++)
                {
                    if (satir[i] == ',') { tani++;continue; }
                    if (tani==0)
                    {
                        ogr[satirsayisi].isim +=  satir[i];
                    }
                    else if (tani==1)
                    {
                        ogr[satirsayisi].soyisim += satir[i];
                    }
                    else if (tani == 2)
                    {
                        ogr[satirsayisi].telefon += satir[i];
                    }
                    else if (tani == 3)
                    {
                        ogr[satirsayisi].email += satir[i];
                    }
                    else if (tani == 4)
                    {
                        ogr[satirsayisi].bolum += satir[i];
                    }
                    else if (tani == 5)
                    {
                        ogr[satirsayisi].sifre += satir[i];
                    }
                }
                satirsayisi++;
            }
            satirsayisi = 0;
            while ((satir = sr2.ReadLine()) != null)
            {
                int tani = 0;
                for (int i = 0; i < satir.Length; i++)
                {
                    if (satir[i] == ',') { tani++; continue; }
                    if (satir[i] == '(' || satir[i] == ')') continue;
                    if (tani == 0)
                    {
                        ogr[satirsayisi].harcdurum += satir[i];
                    }
                    else if (tani == 1)
                    {
                        ogr[satirsayisi].sinif += satir[i];
                    }
                    else if (tani == 2)
                    {
                        ogr[satirsayisi].notort += satir[i];
                    }
                    else if (tani == 3)
                    {
                        ogr[satirsayisi].secilendersler += satir[i];
                    }
                }
                satirsayisi++;
            }
            satirsayisi = 0;
            while ((satir = sr3.ReadLine()) != null)
            {
                Array.Resize(ref dersno, dersno.Length + 1);
                Array.Resize(ref dersad, dersad.Length + 1);
                int tani = 0;
                for (int i = 0; i < satir.Length; i++)
                {
                    if (satir[i] == ',') { tani++; continue; }
                    if (tani == 0)
                    {
                        dersno[satirsayisi] += satir[i];
                    }
                    else if (tani == 1)
                    {
                        dersad[satirsayisi] += satir[i];
                    }
                }
                satirsayisi++;
            }
        }

        private void button1_Click(object sender, EventArgs e)
        {

            Form2 frm = new Form2();
            frm.Visible = true;
            this.Hide();
        }

        private void button2_Click(object sender, EventArgs e)
        {

            Form3 frm = new Form3();
            frm.Visible = true;
            this.Hide();
        }
    }
}
