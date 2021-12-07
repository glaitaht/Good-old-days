using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace ogrencioto
{
    public partial class Form4 : Form
    {
        public Form4()
        {
            InitializeComponent();
        }

        private void Form4_Load(object sender, EventArgs e)
        {
            if (Form1.ogr[Form1.girishali].harcdurum == "0")
            {
                button1.BackColor = Color.FromArgb(255, 0, 0);
            }
            else
            {
                button1.BackColor = Color.FromArgb(0, 255, 0);
            }
            label7.Text = Form1.ogr[Form1.girishali].isim;
            label8.Text = Form1.ogr[Form1.girishali].soyisim;
            label9.Text = Form1.ogr[Form1.girishali].telefon;
            label10.Text = Form1.ogr[Form1.girishali].email;
            label11.Text = Form1.ogr[Form1.girishali].bolum;
            label12.Text = Form1.ogr[Form1.girishali].sinif;
        }

        private void Form4_FormClosed(object sender, FormClosedEventArgs e)
        {
            Application.Exit();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            if (button1.BackColor == Color.FromArgb(255, 0, 0))
            {
                System.Diagnostics.Process.Start("https://www.harcode.com");
            }
            else
            {
                MessageBox.Show("Harç borcunuz bulunmuyor.");
            }
        }

        private void alınanDerslerToolStripMenuItem_Click(object sender, EventArgs e)
        {
            string dersler = "";
            string derslerstring = Form1.ogr[Form1.girishali].secilendersler;
            string iki = "";
            for (int i = 0; i < derslerstring.Length; i++)
            {
                if (derslerstring[i] == '.')
                {
                    for (int j = 0; j < Form1.dersno.Length; j++)
                    {
                        if (Form1.dersno[j]==iki)
                        {
                            dersler += Form1.dersad[j] + "\n";
                        }
                    }
                    iki = "";
                }
                else
                {
                    iki += derslerstring[i];
                }
            }
            iki = derslerstring[derslerstring.Length - 2] +""+ derslerstring[derslerstring.Length - 1];
            for (int j = 0; j < Form1.dersno.Length; j++)
            {
                if (Form1.dersno[j] == iki)
                {
                    dersler += Form1.dersad[j] + "\n";
                    break;
                }
            }
            MessageBox.Show(dersler);
        }

        private void sınıfArkadaşlarıToolStripMenuItem_Click(object sender, EventArgs e)
        {
            Form5 frm5 = new Form5();
            frm5.Visible = true;
            this.Hide();
        }
    }
}
