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
    public partial class Form5 : Form
    {
        public Form5()
        {
            InitializeComponent();
        }

        private void Form5_FormClosed(object sender, FormClosedEventArgs e)
        {
            Form4 frm4 = new Form4();
            frm4.Show();
        }

        private void Form5_Load(object sender, EventArgs e)
        {
            for (int i = 0; i < Form1.ogr.Length; i++)
            {
                if (!treeView1.Nodes.ContainsKey(Form1.ogr[i].sinif))
                {
                    treeView1.Nodes.Add(Form1.ogr[i].sinif, Form1.ogr[i].sinif);
                }
            }
            for (int i = 0; i < Form1.ogr.Length; i++)
            {
                treeView1.Nodes[Form1.ogr[i].sinif].Nodes.Add(Form1.ogr[i].isim+" "+ Form1.ogr[i].soyisim, Form1.ogr[i].isim + " " + Form1.ogr[i].soyisim);
            }
        }
    }
}
