# To add a new cell, type '# %%'
# To add a new markdown cell, type '# %% [markdown]'
# %%
import pandas as pd
import numpy as np
ogrenciler = pd.read_csv("Sinif.csv", delimiter=",")
ogrSayi = 0
for i in ogrenciler.count(axis='columns'):
    ogrSayi = ogrSayi + 1
while(1):
    hangi = 0
    ogrenciler.reset_index(inplace = True,drop=True)
    print("Yeni giriş için 1'i")
    print("Güncelemek için 2'yi")
    print("Silmek için 3'ü")
    print("Kayıt listeleme için 4'ü")
    print("Başarı notu hesaplamak için 5'i")
    print("Başarı notuna göre sıralama yapmak için 6'yı")
    print("İstatistiksel bilgiler için 7'yi")
    print("Sistemde hesaplanan bilgileri kaydetmek için 8'i tuşlayınız.")
    try : 
        secenek = int(input("Yapmak istediğiniz işlem numarasını giriniz: "))
    except :
        print("Numara girişi yapılmadı program durdu.")
        break
    if secenek == 1:
        no = int(input("Lütfen eklemek istediğiniz öğrencinin numarasını giriniz."))
        if ((ogrenciler.numara == no).any) == True:
            print("Kayıt var.")
            continue
        ad = input("Adı :")
        soyad = input("Soyadı :")
        vize1 = int(input("Vize1 :"))
        vize2 = int(input("Vize2 :"))
        final = int(input("final :"))
        kayit = {'numara':no,'ad':ad,'soyad':soyad,'vize1':vize1,'vize2':vize2,'final':final}
        ogrenciler = ogrenciler.append(kayit,ignore_index=True)
        ogrSayi=ogrSayi+1
        print(ad," ",soyad," isimli öğrenci sisteme eklendi.")
    if secenek == 2:
        no = int(input("Lütfen bilgisini güncellemek istediğiniz öğrencinin numarasını giriniz."))
        if ((ogrenciler.numara == no).any) == False:
            print("Kayıt yok.")
            continue
        for i in range(ogrSayi):
            if (ogrenciler.numara == no ).any == True:
                hangi = i
                continue
        ad = input("Adı :")
        soyad = input("Soyadı :")
        vize1 = int(input("Vize1 :"))
        vize2 = int(input("Vize2 :"))
        final = int(input("final :"))
        ogrenciler.iloc[hangi]=[no,ad,soyad,vize1,vize2,final]
        print("\n Başarıyla güncellendi. \n")
    if secenek == 3:
        no = int(input("Lütfen bilgisini silmek istediğiniz öğrencinin numarasını giriniz."))
        hangi = ogrenciler.index[ogrenciler.numara==no].tolist()
        if  len(hangi) != 0 :
            print(hangi)
        else:
            print("Kayıt yok.")
            continue
        print("Başarıyla silindi.")
        ogrenciler.drop(ogrenciler.index[hangi], inplace=True)
    if secenek == 4:
        print(ogrenciler)
    if secenek == 5:
        basari = 0.000
        sayi = len(ogrenciler)
        for i in range(sayi):
            ogrenciler['basari'] = ogrenciler.apply(lambda row: round(((row.vize1)*20/100 + (row.vize2)*30/100 + (row.final)*50/100),5) , axis = 1) 
        ogrenciler['harf']=''
        ogrenciler['gecme']=''
        for i in range(sayi):
            gectimi = ""
            harfnotu = ""
            if ogrenciler.iloc[i][6] > 90:
                harfnotu = "AA"
                gectimi = "Geçti"
            elif ogrenciler.iloc[i][6] > 84:
                harfnotu = "BA"
                gectimi = "Geçti"
            elif ogrenciler.iloc[i][6] > 79:
                harfnotu = "BB"
                gectimi = "Geçti"
            elif ogrenciler.iloc[i][6] > 74:
                harfnotu = "CB"
                gectimi = "Geçti"
            elif ogrenciler.iloc[i][6] > 69:
                harfnotu = "CC"
                gectimi = "Geçti"
            elif ogrenciler.iloc[i][6] > 64:
                harfnotu = "DC"
                gectimi = "Geçti"
            elif ogrenciler.iloc[i][6] > 59:
                harfnotu = "DD"
                gectimi = "Geçti"
            elif ogrenciler.iloc[i][6] > 49:
                harfnotu = "FD"
                gectimi = "Ş. Geçti" # tek ekrana sığmamsı için kısalttım
            else:
                harfnotu = "FF"
                gectimi = "Kaldı"
            ogrenciler['harf'][i] = harfnotu
            ogrenciler['gecme'][i] = gectimi
        print("\nBaşarı durumları hesaplandı.\n")
    if secenek == 6:
        if 'basari' in ogrenciler:
            ogrenciler.sort_values(by=['basari'], inplace=True,ascending=False)
            print(ogrenciler)
        else : print("\nÖncelikle basari hesaplaması yapınız.\n")
    if secenek == 7:
        end=100
        eny=0
        ort=0
        for i in range(len(ogrenciler)):
            if ogrenciler.iloc[i][6]< end :
                end = ogrenciler.iloc[i][6]
            if ogrenciler.iloc[i][6]> eny :
                eny =ogrenciler.iloc[i][6]
            ort=ort + ogrenciler.iloc[i][6]
        ort = round(ort/len(ogrenciler),5)
        import statistics 
        std = statistics.stdev(ogrenciler['basari'])
        ortu = 0
        for i in range(len(ogrenciler)):
            if ogrenciler.iloc[i][6] > ort:
                ortu = ortu + 1
        print("\nEn düşük not:", end)
        print("En yüksek not:", eny)
        print("Başarı ortalaması:", ort)
        print("Ortalama üstündeki öğrenci sayısı:", ortu)
        print("Standart sapma:",std)
        
        import matplotlib.pyplot as plt
        from scipy.stats import norm
        y = norm(ort,std)
        plt.plot(ogrenciler['basari'],y.pdf(ogrenciler['basari']))
        plt.xlabel('Notlar')
        plt.ylabel('Çan eğrisi')
        plt.title('Çan eğrisi grafiği')
        plt.show()

        plt.hist(ogrenciler['harf'], bins=20) 
        plt.xlabel('Frekansı')
        plt.ylabel('Harf Notu')
        plt.title('Harf notu histogramı')
        plt.ylim((0,15))
        plt.show()
    if secenek == 8:
        if 'basari' in ogrenciler:
            ogrenciler.sort_values(by=['basari'], inplace=True,ascending=False)
            print(ogrenciler)
        else : print("\nÖncelikle basari hesaplaması yapınız.\n")
        ogrenciler.to_csv('output.csv', index=False)
        print("Başarıyla 'output.csv' dosyasına kaydedildi.")
        break


# %%



