#include <iostream> // temel c++ k�t�phanesi cout cin gibi fonksiyonlar i�in
#include <clocale> // t�rk�e karakter i�eren k�t�phane
#include <cstdlib> // rand srand fonksiyonlar� i�in gerekli k�t�phane
#include <ctime> // time fonksiyonu i�in gerekli k�t�phane
#include "DinamikBellekYonetimi.cpp" // header dosyam�z� include ettik.
using namespace std; 
int main(){ 
	setlocale(LC_ALL,"Turkish"); // t�rk�e karakter kullanabilmek i�in b�t�n program� t�rk�ele�tirdik
	srand(time(NULL)); // her �a��r��ta rastgele say� �retmesi i�in fonksiyon �a��rd�k
	int diziBirSatir, diziBirSutun; // birinci dizinin boyutlar�
	int diziIkiSatir, diziIkiSutun; // ikinci dizinin boyutlar�
	cout<<"L�tfen birinci dizinin satir ve s�tun say�s�n� giriniz:\n"; cin>>diziBirSatir>>diziBirSutun; // birinci dizinin boyutlar� kullan�c�dan al�nd�
	cout<<"L�tfen ikinci dizinin satir ve s�tun say�s�n� giriniz:\n"; cin>>diziIkiSatir>>diziIkiSutun;// ikinci dizininde boyutlar� kullan�c�dan al�nd�
	/*int **dizi = new int*[3]; // kontrol i�in tan�mlanan gizemli matris 
	dizi[0] = new int[3]{2,7,6}; 
	dizi[1] = new int[3]{9,5,1}; 
	dizi[2] = new int[3]{4,3,8}; */
	/*int **diziSansli = new int*[3]; // kontrol i�in tan�mlanan i�inde 1 �ansl� eleman olan matris isimleri ayn� 
	dizi[0] = new int[3]{3,7,8}; 
	dizi[1] = new int[3]{9,11,13}; 
	dizi[2] = new int[3]{15,16,17};*/
	int **diziBir = new int*[diziBirSatir]; // birinci diziyi tek boyutta olu�turduk
	for(int i=0;i<diziBirSatir;i++){
		diziBir[i] =new int [diziBirSutun]; // her sat�r i�in s�tunlara denk gelecek boyutta elemanlar ekledik
	}
	int **diziIki = new int*[diziIkiSatir];  // ikinci dizi i�inde tek boyutta olu�turduk
	for(int i=0;i<diziIkiSatir;i++){
		diziIki[i] =new int [diziIkiSutun]; // her sat�ra s�tun de�eri verdik.
	}
	for(int i=0;i<diziBirSatir;i++){ 
		for(int j=0;j<diziBirSutun;j++){ // ilk dizinin i�ini gezdik ve 
			diziBir[i][j] = rand(); // rastgele de�er atad�k
			diziBir[i][j] = diziBir[i][j] % 9; // 9 ile modunu alld�k, 9'a kadar olan elemanlar kald�
		}
	}
	for(int i=0;i<diziIkiSatir;i++){
		for(int j=0;j<diziIkiSutun;j++){
			diziIki[i][j] = rand();
			diziIki[i][j] = diziIki[i][j] % 9; // ayn� �ekilde ikinci diziyide yapt�k
		}
	}
	cout<<"1. Dizi :\n";
	for(int i=0;i<diziBirSatir;i++){
		cout<<"\n";
		for(int j=0;j<diziBirSutun;j++){ // birinci diziyi yazd�rd�k
			cout<<" "<<diziBir[i][j];
		}
	}
	cout<<"\n\n2. Dizi :\n";
	for(int i=0;i<diziIkiSatir;i++){
		cout<<"\n";
		for(int j=0;j<diziIkiSutun;j++){// ikinci diziyi de yazd�rd�k
			cout<<" "<<diziIki[i][j];
		}
	}
	
	/*cout<<"\n\nKontrol Dizi :\n"; // kontrol dizisini de yazd�rd�m 
	for(int i=0;i<3;i++){
		cout<<"\n";
		for(int j=0;j<3;j++){
			cout<<" "<<dizi[i][j]; // 
		}
	}*/
	cout<<"\n\n";
	DinamikBellekYonetimi dinamikBellekYonetimi;// header dosyas�ndaki class'dan eleman olu�turduk
	bool gizemliMatrisMi = dinamikBellekYonetimi.GizemliMatrisMi(diziBir,diziBirSatir,diziBirSutun); // ilk dizi yollad�k return eden de�eri de�i�kene atad�k  
	int sansliElemanSayisi = dinamikBellekYonetimi.SansliMatrisElemanlarininSayisi(diziIki,diziIkiSatir,diziIkiSutun); // ayn� �ekilde ikinci diziyide de�i�kene att�k
	//int kontrolMatrisi = dinamikBellekYonetimi.SansliMatrisElemanlarininSayisi(dizi,3,3); 
	//bool kontrolMatrisi = dinamikBellekYonetimi.GizemliMatrisMi(diziSansli,3,3);
	/*if(kontrolMatrisi==true){
		cout<<"Kontrol matrisi gizemli.\n";
	}
	else{
		cout<<"Kontrol matrisi gizemli de�il.\n";
	}*/
	if(gizemliMatrisMi==true){ // e�er geri d�nen true ise matris gizemli demektir
		cout<<"Birinci matris gizemli matris.\n";
	}
	else{
		cout<<"Birinci matris gizemli de�il.\n";
	}
	cout<<"�kinci matrisin �ansl� eleman say�s� :  "<<sansliElemanSayisi<<"\n"; // son olarak �ansl� eleman say�s�n� yazd�rd�k.
	//cout<<"kontrol matrisin �ansl� eleman say�s� :  "<<kontrolMatrisi<<"\n";
	
	
	delete diziBir;
	delete diziIki;
	return 0;
}
