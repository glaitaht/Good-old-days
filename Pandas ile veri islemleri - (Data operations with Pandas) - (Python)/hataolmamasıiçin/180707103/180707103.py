# To add a new cell, type '# %%'
# To add a new markdown cell, type '# %% [markdown]'
# %%
class Ogrenci():
    no = 0
    ad = ""
    soyad = ""
    vize1 = 0
    vize2 = 0
    final = 0
    basari = float(0)


# %%
ogr = []
ogrSayi = 0
dosya = open('Sinif.csv','r+',encoding="utf8")
for satir in dosya:
    ogr.append(Ogrenci())
    sayac = 0
    for harf in satir:
        if harf == ',':
            sayac = sayac + 1
        elif sayac == 0:
            ogr[ogrSayi].no = ogr[ogrSayi].no*10 + int(harf)
        elif sayac == 1:
            ogr[ogrSayi].ad = ogr[ogrSayi].ad + harf
        elif sayac == 2:
            ogr[ogrSayi].soyad = ogr[ogrSayi].soyad + harf
        elif sayac == 3:
            ogr[ogrSayi].vize1 = ogr[ogrSayi].vize1*10 + int(harf)
        elif sayac == 4:
            ogr[ogrSayi].vize2 = ogr[ogrSayi].vize2*10 + int(harf)
        elif sayac == 5:
            if harf == "\n":
                continue
            ogr[ogrSayi].final = ogr[ogrSayi].final*10 + int(harf)
    ogrSayi = ogrSayi+1
dosya.close()


# %%
while(1):
    varmi = 0
    hangisi = -1
    print("\nYeni giriş için 1'i")
    print("Güncelemek için 2'yi")
    print("Silmek için 3'ü")
    print("Kayıt listeleme için 4'ü")
    print("Başarı notu hesaplamak için 5'i")
    print("Başarı notuna göre sıralama yapmak için 6'yı")
    print("İstatistiksel bilgiler için 7'yi")
    print("Sistemde hesaplanan bilgileri kaydetmek için 8'i tuşlayınız.\n")
    try :
        secenek = int(input("Lütfen yapacağınız işlemin numarasını tuşlayınız:"))
    except :
        print("Numara girilmedi, program bitti.")
        break
    if secenek==1:
        numara = int(input("Öğrenci numarası giriniz:"))
        for i in range(ogrSayi):
            if ogr[i].no == numara:
                print("Girdiğiniz numarada kayıt mevcut.")
                varmi = 1
        if varmi == 1:
            continue
        ad = input("Ad giriniz:")
        soyad = input("Soyad giriniz:")
        vize1 = int(input("Vize1 giriniz:"))
        vize2 = int(input("Vize2 giriniz:"))
        final = int(input("Final giriniz:"))
        ogr.append(Ogrenci())
        ogr[ogrSayi].no = numara 
        ogr[ogrSayi].ad = ad
        ogr[ogrSayi].soyad = soyad
        ogr[ogrSayi].vize1 = vize1
        ogr[ogrSayi].vize2 = vize2
        ogr[ogrSayi].final = final
        ogrSayi = ogrSayi+1
        print(ad, " ",soyad," isimli öğrenci sisteme eklendi.")
    if secenek==2:
        guncelle = int(input("Güncellemek istediniz kaydın öğrenci numarasını giriniz:"))
        for i in range(ogrSayi):
            if ogr[i].no == guncelle:
                varmi = 1
                hangisi = i
        if varmi == 0:
            print("Güncellemek istediğiniz numaraya kayıtlı öğrenci bulunamadı.")
            continue
        ad = input("Adı:")
        soyad = input("Soyadı:")
        vize1 = int(input("Vize1 notu:"))
        vize2 = int(input("Vize2 notu:"))
        final = int(input("Final notu:"))
        ogr[hangisi].ad = ad
        ogr[hangisi].soyad = soyad
        ogr[hangisi].vize1 = vize1
        ogr[hangisi].vize2 = vize2
        ogr[hangisi].final = final
        print(ad," ",soyad," isimli öğrencinin bilgileri güncellendi.")
    if secenek==3:
        sil = int(input("Silmek istediğiniz kaydın öğrenci numarasını giriniz."))
        for i in range(ogrSayi):
            if ogr[i].no == sil:
                varmi = 1
                hangisi = i
        if varmi == 0:
            print("Girdiğiniz numaraya ait kayıt bulunmadı.")
        else:
            print(ogr[hangisi].ad," ",ogr[hangisi].soyad, " isimli öğrenci başarıyla silindi.")
        if ogrSayi-1 == hangisi:
            ogrSayi = ogrSayi-1
            continue
        for i in range(ogrSayi-hangisi):
            if i+hangisi+1 >= ogrSayi:
                continue
            ogr[hangisi+i].no = ogr[hangisi+i+1].no
            ogr[hangisi+i].ad = ogr[hangisi+i+1].ad
            ogr[hangisi+i].soyad = ogr[hangisi+i+1].soyad
            ogr[hangisi+i].vize1 = ogr[hangisi+i+1].vize1
            ogr[hangisi+i].vize2 = ogr[hangisi+i+1].vize2
            ogr[hangisi+i].final = ogr[hangisi+i+1].final
        ogrSayi = ogrSayi - 1
    if secenek==4: 
        for i in range(ogrSayi):
            print(i+1,". Öğrencinin "," No : ", ogr[i].no, " Adı : ",ogr[i].ad, " Soyadı :", ogr[i].soyad,
            " Vize 1, vize 2, final notları : ", ogr[i].vize1, " ", ogr[i].vize2, " ", ogr[i].final)
    if secenek==5:
        for i in range(ogrSayi):
            ogr[i].basari = round((float(ogr[i].vize1) * 20/100 + float(ogr[i].vize2 * 30/100) + float(ogr[i].final * 50/100)),5)
        for i in range(ogrSayi):
            if ogr[i].basari > 90:
                harfnotu = "AA"
                gectimi = "Geçti"
            elif ogr[i].basari > 84:
                harfnotu = "BA"
                gectimi = "Geçti"
            elif ogr[i].basari > 79:
                harfnotu = "BB"
                gectimi = "Geçti"
            elif ogr[i].basari > 74:
                harfnotu = "CB"
                gectimi = "Geçti"
            elif ogr[i].basari > 69:
                harfnotu = "CC"
                gectimi = "Geçti"
            elif ogr[i].basari > 64:
                harfnotu = "DC"
                gectimi = "Geçti"
            elif ogr[i].basari > 59:
                harfnotu = "DD"
                gectimi = "Geçti"
            elif ogr[i].basari > 50:
                harfnotu = "FD"
                gectimi = "Şartlı Geçti"
            else:
                harfnotu = "FF"
                gectimi = "Kaldı"
            print(i+1,". Öğrencinin "," No : ", ogr[i].no, " Adı : ",ogr[i].ad, " Soyadı :", ogr[i].soyad,
            " Başarı harf notu : ", harfnotu , " ", gectimi)
    if secenek == 6:
        if ogr[0].basari == 0:
            print("Henüz başarı hesaplaması yapmadınız.")
            continue
        ogr.sort(key= lambda ogr: ogr.basari,reverse=True)
        for i in range(ogrSayi):
            if ogr[i].basari > 90:
                harfnotu = "AA"
                gectimi = "Geçti"
            elif ogr[i].basari > 84:
                harfnotu = "BA"
                gectimi = "Geçti"
            elif ogr[i].basari > 79:
                harfnotu = "BB"
                gectimi = "Geçti"
            elif ogr[i].basari > 74:
                harfnotu = "CB"
                gectimi = "Geçti"
            elif ogr[i].basari > 69:
                harfnotu = "CC"
                gectimi = "Geçti"
            elif ogr[i].basari > 64:
                harfnotu = "DC"
                gectimi = "Geçti"
            elif ogr[i].basari > 59:
                harfnotu = "DD"
                gectimi = "Geçti"
            elif ogr[i].basari > 50:
                harfnotu = "FD"
                gectimi = "Şartlı Geçti"
            else:
                harfnotu = "FF"
                gectimi = "Kaldı"
            print(i+1,". Öğrencinin "," No : ", ogr[i].no, " Adı : ",ogr[i].ad, " Soyadı :", ogr[i].soyad,
            " Başarı harf notu : ", harfnotu , " ", gectimi)
    if secenek == 7:
        if ogr[0].basari == 0:
            print("Henüz başarı hesaplaması yapmadınız.")
            continue
        ogr.sort(key= lambda ogr: ogr.basari,reverse=True)
        print("En yüksek başarı notu :",ogr[0].basari)
        print("En düşük başarı notu :",ogr[-1].basari)
        ort = 0
        ortu = 0
        notlar = []
        for i in range(ogrSayi):
            ort = ort + ogr[i].basari
        ort = round(ort/ogrSayi,5)
        for i in range(ogrSayi):
            notlar.append(int())
            notlar[i] = ogr[i].basari
            if ogr[i].basari > ort:
                ortu = ortu + 1
        import statistics
        standart = statistics.stdev(notlar)
        print("Sınıf ortalaması : ",ort)
        print("Sınıf ortalaması üstünde olan kişi sayısı : ",ortu)
        print("Standart sapma =", round(statistics.stdev(notlar),5))
        import matplotlib.pyplot as plt
        import numpy as np
        from scipy.stats import norm
        x_deger = notlar
        y_deger = norm(ort,standart)

        plt.plot(x_deger, y_deger.pdf(x_deger))
        plt.xlabel('Notlar')
        plt.ylabel('Çan eğrisi')
        plt.title('Çan eğrisi grafiği')
        plt.show()
        harfnotlar = []
        for i in range(ogrSayi):
            harfnotlar.append(str())
            if notlar[i] > 89:
                harfnotlar[i] = 'AA'
            elif notlar[i] > 84:
                harfnotlar[i] = 'BA'
            elif notlar[i] > 79:
                harfnotlar[i] = 'BB'
            elif notlar[i] > 74:
                harfnotlar[i] = 'CB'
            elif notlar[i] > 69:
                harfnotlar[i] = 'CC'
            elif notlar[i] > 64:
                harfnotlar[i] = 'DC'
            elif notlar[i] > 59:
                harfnotlar[i] = 'DD'
            elif notlar[i] > 49:
                harfnotlar[i] = 'FD'
            else : 
                harfnotlar[i] ='FF'
        plt.hist(harfnotlar, color='red',histtype='bar' )
        plt.show()
    if secenek == 8:
        if ogr[0].basari == 0:
            print("Henüz başarı hesaplaması yapmadınız.")
            continue
        dosya = open("Output.csv","w+")
        for i in range(ogrSayi):
            satir = str(ogr[i].no) + "," + ogr[i].ad + ","+ ogr[i].soyad + ","+ str(ogr[i].vize1) + ","+ str(ogr[i].vize2) + ","+ str(ogr[i].final) + ","+ str(ogr[i].basari) + "\n"
            dosya.write(satir)
        dosya.close()
        print("Başarıyla Output.csv ismiyle kaydedildi.")


# %%



