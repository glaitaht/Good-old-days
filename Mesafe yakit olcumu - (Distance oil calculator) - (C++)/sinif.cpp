#include "sinif.h"
yktMaliyet::yktMaliyet(){//boþ yapýcý
	yktMaliyet::fmesafe=100;//mesafeyi 100
	yktMaliyet::fyakit=80;//yakýtý 80 yapýyor
}
yktMaliyet::yktMaliyet(float x){//float dolu yapýcý
	yktMaliyet::fmesafe=x;//mesafeyi float yapýyor
	yktMaliyet::fyakit=80;//yakýtý 80 yapýyor
}
yktMaliyet yktMaliyet::operator+(yktMaliyet &ikinci){//+ iþlemi
	yktMaliyet yeni;//üçüncü bir nesne oluþturduk
	yeni.fmesafe = this->fmesafe +  ikinci.getMesafe();//yeni nesneye + iþaretinden önceki ve sonraki elemanlarýn 
	return yeni;// toplamýný atadýk ve geriye üçüncü elemaný döndürdük
}
yktMaliyet yktMaliyet::operator=(yktMaliyet &ikinci){//= iþlemi
	this->fmesafe=ikinci.fmesafe;//= iþaretinden önceki nesnenin(this) mesafesini sonrakiyle eþitledik
	this->fyakit=ikinci.fyakit;//ayný þekilde yakýtý eþitledik
}
float yktHesapla(yktMaliyet gidis, yktMaliyet donus){//friend fonksiyon 
	float toplam = (gidis.getMesafe() * gidis.getYakit() * 1.15) +  (donus.getMesafe() * donus.getYakit() * 0.9);
	// float deðiþkene giderken gerekli ve donerken gerekli toplam yakýtý hesaplayýp atýyor
	// gidiþte %15 daha fazla yakýt dönüþte %10 az yakýt yakacaðýný varsaydým, yer deðiþtirilse dahi 
	// sonuç ayný çýkacak. 
	return toplam;//geriye toplam yakýt miktarýný döndürdü
}
float yktMaliyet::yktMaliyet::getMesafe(){
	return yktMaliyet::fmesafe;//geriye mesafeyi döndürdü
}
float yktMaliyet::yktMaliyet::getYakit(){
	return yktMaliyet::fyakit;//geriye yakýtý döndürdü
}
void yktMaliyet::setMesafe(float fx){
	yktMaliyet::fmesafe=fx;//mesafeyi atadý
}
void yktMaliyet::setYakit(float fx){
	yktMaliyet::fyakit=fx;//yakýtý atadý
}
