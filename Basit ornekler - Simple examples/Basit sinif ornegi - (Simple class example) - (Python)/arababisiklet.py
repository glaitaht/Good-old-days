class tasit:
    def __init__(self, bisikletmig, modelg, markag, ortak):
        self.bisikletmi = bisikletmig
        if bisikletmig:
            self.kullanimtipi = ortak
        else:
            self.sinifi = ortak
        self.marka = markag
        self.modely = modelg


    bisikletmi= False
    modely=0000
    marka=""
    sinifi=""
    kullanimtipi=""

    def yazdir(self):
        yaz=""
        if self.bisikletmi:
            yaz=yaz + "Ürün bisiklet ve kullanım tipi : " + self.kullanimtipi
        else:
            yaz = yaz+ "Ürün araba ve sınıfı : "  + self.sinifi
        yaz = yaz + " model yılı: " + str(self.modely) + " markası: " + self.marka
        print(yaz)
def hepsiniyazdir():
    i=1
    for tasit in tasitlar:
        print(str(i) + ". tasit:")
        tasit.yazdir()
        i=i+1

def elemansil(i):
    j = 0
    for tasit in tasitlar:
        if i==j:
            tasitlar.remove(tasit)
            break
        j=j+1


tasitlar = []
tasitlar.append(tasit(True,2015,"Kron","Dağ"))
tasitlar.append(tasit(False,2002,"Fiat","Şehir"))
tasitlar.append(tasit(True,2018,"Salcano","Asfalt"))
tasitlar.append(tasit(False,2015,"Lamborgini","Yarış"))
tasitlar.append(tasit(True,2020,"Giant","Yarış"))


while(1):
    i = int(input("Lüfen listeleme için 1'i, ekleme için 2'i, silme için 3'ü tuşlayın: "))
    if i==1:
        hepsiniyazdir()
    elif i==2:
        bisikletmi = int(input("Eklenecek taşit araba ise 1, bisiklet ise 2 yazınız: "))
        if bisikletmi==1:
            model=int(input("Arabanın modelini giriniz: "))
            marka=input("Arabanın markasını giriniz: ")
            sinif=input("Arabanın sinifini giriniz: ")
            tasitlar.append(tasit(False,model,marka,sinif))
        elif bisikletmi==2:
            model = int(input("Bisikletin modelini giriniz: "))
            marka = input("Bisikletin markasını giriniz: ")
            kullanim = input("Bisikletin kullanım tipini giriniz: ")
            tasitlar.append(tasit(True, model, marka, kullanim))
        else:
            print("Yanlış bir değer girdiniz.")
            continue
    elif i==3:
        silinecek = int(input("Silinecek elemanın numarasi: "))
        elemansil(silinecek-1)
    else:
        print("Yanlış bir değer girdiniz")