#include "sinif.h"
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
