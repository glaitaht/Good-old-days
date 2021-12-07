using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Runtime.CompilerServices;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace MtArmsSayi
{
    public partial class Form2 : Form
    {
        public Form2()
        {
            InitializeComponent();
        }
        public int[,] oynf = new int[5,5]; //ilk formdan buraya geçen oyun dizisi
        public int[,] mayinSayi = new int[5, 5]; // ilk formdan buraya geçen mayın yakınlık dizisi
        public void Form2_Load(object sender, EventArgs e)
        {
            for (int i = 0; i < 5; i++) // satır gezdik
            {
                for (int j = 0; j < 5; j++) // sütun gezdik
                {
                    Button btn = (Button)(this.Controls.Find("button" + ((i * 5) + j + 1), true)[0]);
                    //formdaki kontrolleri dolaşıp adı button1'den button25'e kadar olanları işleme aldık
                    btn.Text = mayinSayi[i, j].ToString();//butonun textini değiştirip mayın yakınları dizisiyle eşledi
                    if (oynf[i, j] == 1) // eğer mayın varsa arka planı kırmızı
                    {
                        btn.BackColor = Color.FromArgb(255, 0, 0);
                    }
                    else
                    { // yoksa yeşil yaptık.
                        btn.BackColor = Color.FromArgb(0, 255, 0);
                    }
                }
            }
        }
    }
}
