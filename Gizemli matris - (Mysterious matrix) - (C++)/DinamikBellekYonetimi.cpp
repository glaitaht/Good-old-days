#include "DinamikBellekYonetimi.h"
bool DinamikBellekYonetimi::GizemliMatrisMi(int**dizi,int satirSayisi,int sutunSayisi){ // *(*(dizi + (i)) + j ile pointer i�inde dola��cak
	if(KareMi(dizi,satirSayisi,sutunSayisi) == 0){ // e�er kareyse 0 de�eri gelecek ve main fonksiyonuna geri d�necek
		return false;
	}
	for(int i=0;i<satirSayisi;i++){ 
		for(int j=0;j<sutunSayisi;j++){ // iki boyutta dola�t�k
			if (*(*(dizi + (i)) + j) > (sutunSayisi*sutunSayisi) ){
				return false; // e�er elemanlar sutun say�s�n�n karesinden b�y�kse false de�eri ile main fonksiyonuna d�necek
			}
		}
	}
	for(int i=0;i<satirSayisi;i++){ 
		for(int j=0;j<sutunSayisi;j++){ // iki boyutta dola�t�k
			if(VarMi(dizi,satirSayisi,sutunSayisi, *(*(dizi + (i)) + j)) == true ){  // varmi fonksiyonu tekrar eden eleman var m� kontrol ediyor
				return false;//e�er tekrar eden say�lar varsa false de�eri ile maine d�necek
			} 
		}
	}
	int sabit = (satirSayisi * (satirSayisi*satirSayisi +1) ) / 2; // m sabitini buluyoruz
	int esitMi=0; // her sat�r� her sutunu her k��egeni kontrol eden de�i�ken
	for(int i = 0;i<satirSayisi;i++){
		for(int j=0;j<sutunSayisi;j++){
			esitMi= esitMi + *(*(dizi + (i)) + j); // sat�rdaki b�t�n de�erleri toplad�k
			if(j+1 == sutunSayisi && esitMi != sabit){ // e�er son elemana geldiysek kar��la�t�r�youz sabite e�it de�ilse 
				return false;// main fonksiyonuna false de�eri ile d�n�yor.
			}
		}
		esitMi=0;//yeni sat�ra ge�erken s�f�rl�yoruz
	}
	for(int i = 0;i<sutunSayisi;i++){ // s�tunu kontrol edebilmek i�in
		for(int j=0;j<satirSayisi;j++){//iterat�r�n yerini de�i�tirdik
			esitMi= esitMi + *(*(dizi + (j)) + i ); // buu sefer sutunlar� yukardan a��a�� �ekilde topluyor
			if(j+1 == satirSayisi && esitMi != sabit){ // e�er son sat�ra geldiyse ve sabite e�it de�lse maine false ile d�necek
				return false;
			}
		}
		esitMi=0;//yine s�f�rlad�k
	}
	for(int i = 0;i<satirSayisi;i++){ //ilk k��egen i�in yaz�lan d�ng�
		for(int j=0;j<sutunSayisi;j++){
			if(i == j){	
				esitMi= esitMi + *(*(dizi + (i)) + j); // e�er i j ye e�itse �apraz �ekilde a��a�� iniyor demektir.
				if(j+1 == sutunSayisi && esitMi != sabit){ // e�er son elemana ula�t�ysak ve toplam sabite e�it de�ilse 
					return false; // main fonksiyonuna false ile d�encek.
				}
			}
		}
	}
	esitMi=0; // s�f�rlad�k de�eri tekrardan
	for(int i=0;i<satirSayisi;i++){ // son olarak tek boyutta tarad�k, zaten matris kare oldu�u i�in 
		esitMi =esitMi + *(*(dizi + (i)) + satirSayisi-i-1) ; // j inin sat�r say�s�na g�re tam tersi olmak zorunda 3x3 i�in i 0 ise j 2 
		if(i+1 == satirSayisi && esitMi != sabit){ // b�ylece ters k��egeni bulduk
			return false; // e�er sabite e�it de�ilse main fonksiyonuna false de�erle d�necek.
		}
	} 
	return true;//e�er program maine false ile d�nmediyse demektirki bu matris gizemli.
}

int DinamikBellekYonetimi::KareMi(int **dizi,int satirSayisi,int sutunSayisi){ // satiri sutuna kar��la�t�ran fonksiyon
	if(satirSayisi == sutunSayisi){
		return 1;// e�er sat�r sutuna e�itse 1 de�ilse 0 d�nd�r�r
	}
	else{
		return 0;
	}
}

bool DinamikBellekYonetimi::VarMi(int**dizi,int satirSayisi,int sutunSayisi,int arananSayi){
	int tekrarSayisi=0; // aranan say� dizide ba�ka bir yerde var m� diye kontrol eden fonksiyon
	for(int i=0;i<satirSayisi;i++){
		for(int j=0;j<sutunSayisi;j++){ // tekrar say�s� her eleman� g�r��te  1 art�yor
			if( *(*(dizi + (i)) + j)  == arananSayi){,
				tekrarSayisi++;
			}
		}
	}
	if(tekrarSayisi ==1){ // e�er 1 kere g�r�ld�yse tekrar eden eleman yok demektir
		return false;
	}
	else{
		return true; // di�er t�rl� var demek oldu�undan false de�eri d�n�yor.
	}
}


int DinamikBellekYonetimi::SansliMatrisElemanlarininSayisi(int**dizi,int satirSayisi,int sutunSayisi){ // sansli elemanlar� d�nd�ren fonksiyon
	int sansliElemanlar = 0; // sansli eleanlar� dondurecek de�i�ken.
	for(int i=0;i<satirSayisi;i++){
		for(int j=0;j<sutunSayisi;j++){ // 2 boyutta dola�t�k
			if(VarMi(dizi,satirSayisi,sutunSayisi,*(*(dizi + (i)) + j)) == true ){ // e�er tekrar eden eleman varsa sansli eleman yok dmektir 0 d�nd�r�r
				return 0;
			}
		}
	}
	int minimumEleman[satirSayisi]; // her bi sat�rdaki eleman� bu dizi tutacak, her sat�ra kar��l�k 1 veri
	int maksimumEleman[sutunSayisi]; // ayn� �ekilde her s�tuna kar�� 1 veri
	for(int i=0;i<satirSayisi;i++){ // 2 boyutta d�necek
		minimumEleman[satirSayisi]=*(*(dizi + (i)) + 0); // her sat�r ba�lang�c�nda dizinin ilk eleman�n� veriyoruz ki en k����� bulabilelim
		for(int j=0;j<sutunSayisi;j++){
			if( *(*(dizi + (i)) + j)< minimumEleman[i]){ // e�er bi eleman daha k���kse
				minimumEleman[i]=*(*(dizi + (i)) + j); // yeni k���k eleman o oluyor
			}
		}
	}
	for(int i = 0;i<sutunSayisi;i++){ // iki boyutta dola�acak 
		maksimumEleman[i]=0; // en b�y��� bulaca��m�z i�in 0 dedik
		for(int j=0;j<satirSayisi;j++){ 
			 if(*(*(dizi + (j)) + i ) > maksimumEleman[i] ){ // e�er herhangi bi eleman maksimum eleman�n o sat�rdaki de�erinden b�y�kse
			 	maksimumEleman[i] = *(*(dizi + (j)) + i ); // yeni b�y�k eleman o oldu
			 }
		}
	}
	sansliElemanlar = KacTaneSansli(maksimumEleman,minimumEleman,sutunSayisi,satirSayisi); // iki diziyi g�nderik boyutlar�yla
	return sansliElemanlar;//buldu�umuz sonucu maine g�nderdik.
}
int DinamikBellekYonetimi::KacTaneSansli(int*diziBir,int*diziIki,int diziBirBoyut, int diziIkiBoyut){ // iki dizi iki boyut de�i�keniyle al�nd�
	int kacTane =0; // ka� tane �ansl� eleman varm�� tutan de�i�ken 
	for(int i=0;i<diziBirBoyut;i++){ 
		for(int j=0;j<diziIkiBoyut;j++){ // iki boyutta dola�t�k
			if(diziBir[i]==diziIki[j]){ // her ilk dizi eleman� i�in ikinci dizinin b�t�n elemanlar�n� kontrol ettik
				kacTane++; // e�er bulunduysa ki matrisdeki elemanlar�n hepsi benzersizdi, ka� tane oldu�unu tuttk
			}
		}
	}
	return kacTane; // ve fonksiyona geri d�nd�rd�k�
}


