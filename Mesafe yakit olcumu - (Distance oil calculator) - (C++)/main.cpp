#include <iostream>
using namespace std;
class yktMaliyet{
	private:
		float fmesafe;//d��ardan eri�ilemeyecek de�i�kenleri
		float fyakit;//private i�inde yazd�k
	public:
		yktMaliyet();// bo� yap�c�
		yktMaliyet(float);// float ile dolu yap�c�
	    yktMaliyet operator + (yktMaliyet &ikinci);//+ operat�r� overload�
		yktMaliyet operator = (yktMaliyet &ikinci);//= operat�r� overload�
		friend float yktHesapla(yktMaliyet,yktMaliyet);// friend fonksiyon
		float getMesafe();//mesafeyi d�nd�ren fonksiyon(kaps�lleme i�in)
		float getYakit();//yak�t� d�nd�ren fonksiyon
		void setMesafe(float);//mesafeyi atayan fonksiyon
		void setYakit(float);//yakiti atayan fonksiyon
};
yktMaliyet::yktMaliyet(){//bo� yap�c�
	yktMaliyet::fmesafe=100;//mesafeyi 100
	yktMaliyet::fyakit=80;//yak�t� 80 yap�yor
}
yktMaliyet::yktMaliyet(float x){//float dolu yap�c�
	yktMaliyet::fmesafe=x;//mesafeyi float yap�yor
	yktMaliyet::fyakit=80;//yak�t� 80 yap�yor
}
yktMaliyet yktMaliyet::operator+(yktMaliyet &ikinci){//+ i�lemi
	yktMaliyet yeni;//���nc� bir nesne olu�turduk
	yeni.fmesafe = this->fmesafe +  ikinci.getMesafe();//yeni nesneye + i�aretinden �nceki ve sonraki elemanlar�n 
	return yeni;// toplam�n� atad�k ve geriye ���nc� eleman� d�nd�rd�k
}
yktMaliyet yktMaliyet::operator=(yktMaliyet &ikinci){//= i�lemi
	this->fmesafe=ikinci.fmesafe;//= i�aretinden �nceki nesnenin(this) mesafesini sonrakiyle e�itledik
	this->fyakit=ikinci.fyakit;//ayn� �ekilde yak�t� e�itledik
}
float yktHesapla(yktMaliyet gidis, yktMaliyet donus){//friend fonksiyon 
	float toplam = (gidis.getMesafe() * gidis.getYakit() * 1.15) +  (donus.getMesafe() * donus.getYakit() * 0.9);
	// float de�i�kene giderken gerekli ve donerken gerekli toplam yak�t� hesaplay�p at�yor
	// gidi�te %15 daha fazla yak�t d�n��te %10 az yak�t yakaca��n� varsayd�m, yer de�i�tirilse dahi 
	// sonu� ayn� ��kacak. 
	return toplam;//geriye toplam yak�t miktar�n� d�nd�rd�
}
float yktMaliyet::yktMaliyet::getMesafe(){
	return yktMaliyet::fmesafe;//geriye mesafeyi d�nd�rd�
}
float yktMaliyet::yktMaliyet::getYakit(){
	return yktMaliyet::fyakit;//geriye yak�t� d�nd�rd�
}
void yktMaliyet::setMesafe(float fx){
	yktMaliyet::fmesafe=fx;//mesafeyi atad�
}
void yktMaliyet::setYakit(float fx){
	yktMaliyet::fyakit=fx;//yak�t� atad�
}
int main(){
	char secenek;
	int mesafe=100;
	cout<<"AB arasi mesafeyi girmek istiyor musunuz?(e/h): ";cin>>secenek;//parametre olacak m� sorduk
	if(secenek=='E' || secenek=='e'){//evet ise
		cout<<"A B arasi mesafeyi giriniz: "; cin>>mesafe; //iki �ehir aras� mesafeyi alacak
	}
	yktMaliyet gidis(mesafe);// e�er kullanici parametre girmediyse mesafe 100 olacak.
	yktMaliyet donus;//donus nesnesi parametresiz ise mesafeyi 100 yapt�
	donus=gidis;//donus nesnesinin mesafesini gidi�e e�itledim
	yktMaliyet toplam=donus+gidis; // ���nc� bir nesne olu�turup toplam mesafeyi buldum.
	cout<<"Toplam mesafe: "<<toplam.getMesafe()<<endl;//toplam mesafeyi yazd�rd�m
	cout<<"Toplam kullanilacak yakit: "<<yktHesapla(gidis,donus)<<"ml";//friend fonksiyonu kullanarak yakiti buldum.
	
	
	return 0;
}
