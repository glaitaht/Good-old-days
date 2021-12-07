using System;
using System.IO;
using System.Collections;
namespace odev1
{
    class Program
    {
        static void Main(string[] args)
        {
            ArrayList takimlar = new ArrayList();
            int takimsayi = 0;
            string dosya_yolu = @"C:\Users\kariyer\Desktop\1. ödev c#\odev1\Takimlar.txt";
            FileStream file = new FileStream(dosya_yolu, FileMode.Open, FileAccess.Read);
            StreamReader yazilar = new StreamReader(file);
            string yazi = yazilar.ReadLine();
            while (yazi != null)
            {
                takimlar.Add(yazi);
                takimsayi++;
                yazi = yazilar.ReadLine();
            }
            file.Close();
            if (takimsayi % 2 == 1) { takimlar.Add("X"); takimsayi++; }
            for (int i = 0; i < takimsayi; i++)
            {
                Console.WriteLine(takimlar[i]);
            }
            ArrayList birinci = new ArrayList();
            ArrayList ikinci = new ArrayList();
            int olusan = 0;
            for (int i = 0; i < takimsayi; i++)
            {
                for (int j = i+1; j < takimsayi; j++)
                {
                    birinci.Add(takimlar[i]); ikinci.Add(takimlar[j]); olusan++;
                }
            }
            /*for (int i = 0; i < olusan; i++)
            {
                Console.WriteLine(birinci[i] + "  " + ikinci[i]);
            }*/
            bool fiksture = false;
            ArrayList fikstr = new ArrayList();
            int hafta=1; int kontrol = 0; bool cikis;
            var rand = new Random();
            while (!fiksture)
            {
                cikis = false;
                int olasilik = rand.Next(olusan);
                for (int i = 0; i < kontrol; i++)
                {
                    if(fikstr[i].ToString() == (birinci[olasilik] + "-" + ikinci[olasilik]) || fikstr[i].ToString() == (ikinci[olasilik] + "-" + birinci[olasilik]))
                    {
                        cikis = true;
                    }
                }
                if (!cikis)
                {
                    fikstr.Add(birinci[olasilik]+"-"+ikinci[olasilik]);
                    Console.WriteLine(fikstr[kontrol]);
                    kontrol++;
                    hafta = kontrol / (takimsayi/2);
                    Console.WriteLine(kontrol + " " + hafta);
                }
                if( hafta == (takimsayi - 1))
                {
                    fiksture = true;
                }
            }
            for (int i = 0; i < kontrol; i++)
            {
                if (i % (takimsayi / 2) == 0 ) Console.WriteLine((i / (takimsayi / 2) + 1) + ". hafta:\n");
                Console.WriteLine(fikstr[i]);
            }
        }
    }
}
