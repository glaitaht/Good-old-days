renkler = [["siyah", "kahverengi", "kırmızı", "turuncu", "sarı", "yeşil", "mavi", "mor", "gri", "beyaz",
             "altın", "gümüş"], ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0.1", "0.01"]]
ilk=str(input("Lütfen ilk rengi giriniz: "))
iki=str(input("Lütfen ikinci rengi giriniz: "))
uc=str(input("Lütfen üçüncü rengi giriniz: "))
ilk = ilk.lower()
iki = iki.lower()
uc = uc.lower()
if ilk == "altın" or ilk == "gümüş" or iki == "altın" or iki == "gümüş":
    print("İlk iki değer altın veya gümüş olamaz.")
else:
    for i in range(12):
        if ilk==renkler[0][i]:
            ilk=renkler[1][i]
        if iki==renkler[0][i]:
            iki=renkler[1][i]
        if uc==renkler[0][i] and uc != "altın" and uc != "gümüş":
            uc=renkler[1][i]

    sayi = ilk + iki
    ucuncu = 1
    if uc == "altın":
        ucuncu = 0.1
    elif uc== "gümüş":
        ucuncu = 0.01
    else:
        for i in range(int(uc)):
            ucuncu=ucuncu*10
    print(int(sayi)*ucuncu)