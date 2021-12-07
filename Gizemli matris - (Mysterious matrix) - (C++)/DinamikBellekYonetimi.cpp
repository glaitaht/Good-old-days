#include "DinamikBellekYonetimi.h"
bool DinamikBellekYonetimi::GizemliMatrisMi(int**dizi,int satirSayisi,int sutunSayisi){ // *(*(dizi + (i)) + j ile pointer içinde dolaþýcak
	if(KareMi(dizi,satirSayisi,sutunSayisi) == 0){ // eðer kareyse 0 deðeri gelecek ve main fonksiyonuna geri dönecek
		return false;
	}
	for(int i=0;i<satirSayisi;i++){ 
		for(int j=0;j<sutunSayisi;j++){ // iki boyutta dolaþtýk
			if (*(*(dizi + (i)) + j) > (sutunSayisi*sutunSayisi) ){
				return false; // eðer elemanlar sutun sayýsýnýn karesinden büyükse false deðeri ile main fonksiyonuna dönecek
			}
		}
	}
	for(int i=0;i<satirSayisi;i++){ 
		for(int j=0;j<sutunSayisi;j++){ // iki boyutta dolaþtýk
			if(VarMi(dizi,satirSayisi,sutunSayisi, *(*(dizi + (i)) + j)) == true ){  // varmi fonksiyonu tekrar eden eleman var mý kontrol ediyor
				return false;//eðer tekrar eden sayýlar varsa false deðeri ile maine dönecek
			} 
		}
	}
	int sabit = (satirSayisi * (satirSayisi*satirSayisi +1) ) / 2; // m sabitini buluyoruz
	int esitMi=0; // her satýrý her sutunu her köþegeni kontrol eden deðiþken
	for(int i = 0;i<satirSayisi;i++){
		for(int j=0;j<sutunSayisi;j++){
			esitMi= esitMi + *(*(dizi + (i)) + j); // satýrdaki bütün deðerleri topladýk
			if(j+1 == sutunSayisi && esitMi != sabit){ // eðer son elemana geldiysek karþýlaþtýrýyouz sabite eþit deðilse 
				return false;// main fonksiyonuna false deðeri ile dönüyor.
			}
		}
		esitMi=0;//yeni satýra geçerken sýfýrlýyoruz
	}
	for(int i = 0;i<sutunSayisi;i++){ // sütunu kontrol edebilmek için
		for(int j=0;j<satirSayisi;j++){//iteratörün yerini deðiþtirdik
			esitMi= esitMi + *(*(dizi + (j)) + i ); // buu sefer sutunlarý yukardan aþþaðý þekilde topluyor
			if(j+1 == satirSayisi && esitMi != sabit){ // eðer son satýra geldiyse ve sabite eþit deðlse maine false ile dönecek
				return false;
			}
		}
		esitMi=0;//yine sýfýrladýk
	}
	for(int i = 0;i<satirSayisi;i++){ //ilk köþegen için yazýlan döngü
		for(int j=0;j<sutunSayisi;j++){
			if(i == j){	
				esitMi= esitMi + *(*(dizi + (i)) + j); // eðer i j ye eþitse çapraz þekilde aþþaðý iniyor demektir.
				if(j+1 == sutunSayisi && esitMi != sabit){ // eðer son elemana ulaþtýysak ve toplam sabite eþit deðilse 
					return false; // main fonksiyonuna false ile döencek.
				}
			}
		}
	}
	esitMi=0; // sýfýrladýk deðeri tekrardan
	for(int i=0;i<satirSayisi;i++){ // son olarak tek boyutta taradýk, zaten matris kare olduðu için 
		esitMi =esitMi + *(*(dizi + (i)) + satirSayisi-i-1) ; // j inin satýr sayýsýna göre tam tersi olmak zorunda 3x3 için i 0 ise j 2 
		if(i+1 == satirSayisi && esitMi != sabit){ // böylece ters köþegeni bulduk
			return false; // eðer sabite eþit deðilse main fonksiyonuna false deðerle dönecek.
		}
	} 
	return true;//eðer program maine false ile dönmediyse demektirki bu matris gizemli.
}

int DinamikBellekYonetimi::KareMi(int **dizi,int satirSayisi,int sutunSayisi){ // satiri sutuna karþýlaþtýran fonksiyon
	if(satirSayisi == sutunSayisi){
		return 1;// eðer satýr sutuna eþitse 1 deðilse 0 döndürür
	}
	else{
		return 0;
	}
}

bool DinamikBellekYonetimi::VarMi(int**dizi,int satirSayisi,int sutunSayisi,int arananSayi){
	int tekrarSayisi=0; // aranan sayý dizide baþka bir yerde var mý diye kontrol eden fonksiyon
	for(int i=0;i<satirSayisi;i++){
		for(int j=0;j<sutunSayisi;j++){ // tekrar sayýsý her elemaný görüþte  1 artýyor
			if( *(*(dizi + (i)) + j)  == arananSayi){,
				tekrarSayisi++;
			}
		}
	}
	if(tekrarSayisi ==1){ // eðer 1 kere görüldüyse tekrar eden eleman yok demektir
		return false;
	}
	else{
		return true; // diðer türlü var demek olduðundan false deðeri dönüyor.
	}
}


int DinamikBellekYonetimi::SansliMatrisElemanlarininSayisi(int**dizi,int satirSayisi,int sutunSayisi){ // sansli elemanlarý döndüren fonksiyon
	int sansliElemanlar = 0; // sansli eleanlarý dondurecek deðiþken.
	for(int i=0;i<satirSayisi;i++){
		for(int j=0;j<sutunSayisi;j++){ // 2 boyutta dolaþtýk
			if(VarMi(dizi,satirSayisi,sutunSayisi,*(*(dizi + (i)) + j)) == true ){ // eðer tekrar eden eleman varsa sansli eleman yok dmektir 0 döndürür
				return 0;
			}
		}
	}
	int minimumEleman[satirSayisi]; // her bi satýrdaki elemaný bu dizi tutacak, her satýra karþýlýk 1 veri
	int maksimumEleman[sutunSayisi]; // ayný þekilde her sütuna karþý 1 veri
	for(int i=0;i<satirSayisi;i++){ // 2 boyutta dönecek
		minimumEleman[satirSayisi]=*(*(dizi + (i)) + 0); // her satýr baþlangýcýnda dizinin ilk elemanýný veriyoruz ki en küçüðü bulabilelim
		for(int j=0;j<sutunSayisi;j++){
			if( *(*(dizi + (i)) + j)< minimumEleman[i]){ // eðer bi eleman daha küçükse
				minimumEleman[i]=*(*(dizi + (i)) + j); // yeni küçük eleman o oluyor
			}
		}
	}
	for(int i = 0;i<sutunSayisi;i++){ // iki boyutta dolaþacak 
		maksimumEleman[i]=0; // en büyüðü bulacaðýmýz için 0 dedik
		for(int j=0;j<satirSayisi;j++){ 
			 if(*(*(dizi + (j)) + i ) > maksimumEleman[i] ){ // eðer herhangi bi eleman maksimum elemanýn o satýrdaki deðerinden büyükse
			 	maksimumEleman[i] = *(*(dizi + (j)) + i ); // yeni büyük eleman o oldu
			 }
		}
	}
	sansliElemanlar = KacTaneSansli(maksimumEleman,minimumEleman,sutunSayisi,satirSayisi); // iki diziyi gönderik boyutlarýyla
	return sansliElemanlar;//bulduðumuz sonucu maine gönderdik.
}
int DinamikBellekYonetimi::KacTaneSansli(int*diziBir,int*diziIki,int diziBirBoyut, int diziIkiBoyut){ // iki dizi iki boyut deðiþkeniyle alýndý
	int kacTane =0; // kaç tane þanslý eleman varmýþ tutan deðiþken 
	for(int i=0;i<diziBirBoyut;i++){ 
		for(int j=0;j<diziIkiBoyut;j++){ // iki boyutta dolaþtýk
			if(diziBir[i]==diziIki[j]){ // her ilk dizi elemaný için ikinci dizinin bütün elemanlarýný kontrol ettik
				kacTane++; // eðer bulunduysa ki matrisdeki elemanlarýn hepsi benzersizdi, kaç tane olduðunu tuttk
			}
		}
	}
	return kacTane; // ve fonksiyona geri döndürdükç
}


