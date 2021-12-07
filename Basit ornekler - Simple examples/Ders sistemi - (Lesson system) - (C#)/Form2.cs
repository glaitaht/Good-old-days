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
    public partial class Form2 : Form
    {
        public Form2()
        {
            InitializeComponent();
        }

        private void Form2_FormClosed(object sender, FormClosedEventArgs e)
        {
            Application.Exit();
        }


        private void button1_Click(object sender, EventArgs e)
        {
            if (textBox1.TextLength==0 || textBox2.TextLength==0)
            {
                MessageBox.Show("Lütfen iki girdiyi de giriniz.");
                return;
            }
            for (int i = 0; i < Form1.ogr.Length; i++)
            {
                if (Form1.ogr[i].email == textBox1.Text && Form1.ogr[i].sifre == textBox2.Text)
                {
                    MessageBox.Show("Giriş yapıldı.");
                    Form1.girishali = i;
                    Form4 frm4 = new Form4();
                    frm4.Show();
                    this.Visible = false;
                }
            }
        }

        private void Form2_Load(object sender, EventArgs e)
        {

        }
    }
}
