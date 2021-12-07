#include <iostream> // temel c++ kütüphanesi cout cin gibi fonksiyonlar için
#include <clocale> // türkçe karakter içeren kütüphane
#include <cstdlib> // rand srand fonksiyonlarý için gerekli kütüphane
#include <ctime> // time fonksiyonu için gerekli kütüphane
#include "DinamikBellekYonetimi.cpp" // header dosyamýzý include ettik.
using namespace std; 
int main(){ 
	setlocale(LC_ALL,"Turkish"); // türkçe karakter kullanabilmek için bütün programý türkçeleþtirdik
	srand(time(NULL)); // her çaðýrýþta rastgele sayý üretmesi için fonksiyon çaðýrdýk
	int diziBirSatir, diziBirSutun; // birinci dizinin boyutlarý
	int diziIkiSatir, diziIkiSutun; // ikinci dizinin boyutlarý
	cout<<"Lütfen birinci dizinin satir ve sütun sayýsýný giriniz:\n"; cin>>diziBirSatir>>diziBirSutun; // birinci dizinin boyutlarý kullanýcýdan alýndý
	cout<<"Lütfen ikinci dizinin satir ve sütun sayýsýný giriniz:\n"; cin>>diziIkiSatir>>diziIkiSutun;// ikinci dizininde boyutlarý kullanýcýdan alýndý
	/*int **dizi = new int*[3]; // kontrol için tanýmlanan gizemli matris 
	dizi[0] = new int[3]{2,7,6}; 
	dizi[1] = new int[3]{9,5,1}; 
	dizi[2] = new int[3]{4,3,8}; */
	/*int **diziSansli = new int*[3]; // kontrol için tanýmlanan içinde 1 þanslý eleman olan matris isimleri ayný 
	dizi[0] = new int[3]{3,7,8}; 
	dizi[1] = new int[3]{9,11,13}; 
	dizi[2] = new int[3]{15,16,17};*/
	int **diziBir = new int*[diziBirSatir]; // birinci diziyi tek boyutta oluþturduk
	for(int i=0;i<diziBirSatir;i++){
		diziBir[i] =new int [diziBirSutun]; // her satýr için sütunlara denk gelecek boyutta elemanlar ekledik
	}
	int **diziIki = new int*[diziIkiSatir];  // ikinci dizi içinde tek boyutta oluþturduk
	for(int i=0;i<diziIkiSatir;i++){
		diziIki[i] =new int [diziIkiSutun]; // her satýra sütun deðeri verdik.
	}
	for(int i=0;i<diziBirSatir;i++){ 
		for(int j=0;j<diziBirSutun;j++){ // ilk dizinin içini gezdik ve 
			diziBir[i][j] = rand(); // rastgele deðer atadýk
			diziBir[i][j] = diziBir[i][j] % 9; // 9 ile modunu alldýk, 9'a kadar olan elemanlar kaldý
		}
	}
	for(int i=0;i<diziIkiSatir;i++){
		for(int j=0;j<diziIkiSutun;j++){
			diziIki[i][j] = rand();
			diziIki[i][j] = diziIki[i][j] % 9; // ayný þekilde ikinci diziyide yaptýk
		}
	}
	cout<<"1. Dizi :\n";
	for(int i=0;i<diziBirSatir;i++){
		cout<<"\n";
		for(int j=0;j<diziBirSutun;j++){ // birinci diziyi yazdýrdýk
			cout<<" "<<diziBir[i][j];
		}
	}
	cout<<"\n\n2. Dizi :\n";
	for(int i=0;i<diziIkiSatir;i++){
		cout<<"\n";
		for(int j=0;j<diziIkiSutun;j++){// ikinci diziyi de yazdýrdýk
			cout<<" "<<diziIki[i][j];
		}
	}
	
	/*cout<<"\n\nKontrol Dizi :\n"; // kontrol dizisini de yazdýrdým 
	for(int i=0;i<3;i++){
		cout<<"\n";
		for(int j=0;j<3;j++){
			cout<<" "<<dizi[i][j]; // 
		}
	}*/
	cout<<"\n\n";
	DinamikBellekYonetimi dinamikBellekYonetimi;// header dosyasýndaki class'dan eleman oluþturduk
	bool gizemliMatrisMi = dinamikBellekYonetimi.GizemliMatrisMi(diziBir,diziBirSatir,diziBirSutun); // ilk dizi yolladýk return eden deðeri deðiþkene atadýk  
	int sansliElemanSayisi = dinamikBellekYonetimi.SansliMatrisElemanlarininSayisi(diziIki,diziIkiSatir,diziIkiSutun); // ayný þekilde ikinci diziyide deðiþkene attýk
	//int kontrolMatrisi = dinamikBellekYonetimi.SansliMatrisElemanlarininSayisi(dizi,3,3); 
	//bool kontrolMatrisi = dinamikBellekYonetimi.GizemliMatrisMi(diziSansli,3,3);
	/*if(kontrolMatrisi==true){
		cout<<"Kontrol matrisi gizemli.\n";
	}
	else{
		cout<<"Kontrol matrisi gizemli deðil.\n";
	}*/
	if(gizemliMatrisMi==true){ // eðer geri dönen true ise matris gizemli demektir
		cout<<"Birinci matris gizemli matris.\n";
	}
	else{
		cout<<"Birinci matris gizemli deðil.\n";
	}
	cout<<"Ýkinci matrisin þanslý eleman sayýsý :  "<<sansliElemanSayisi<<"\n"; // son olarak þanslý eleman sayýsýný yazdýrdýk.
	//cout<<"kontrol matrisin þanslý eleman sayýsý :  "<<kontrolMatrisi<<"\n";
	
	
	delete diziBir;
	delete diziIki;
	return 0;
}
