#include <iostream>
using namespace std;
class yktMaliyet{
	private:
		float fmesafe;//dýþardan eriþilemeyecek deðiþkenleri
		float fyakit;//private içinde yazdýk
	public:
		yktMaliyet();// boþ yapýcý
		yktMaliyet(float);// float ile dolu yapýcý
	    yktMaliyet operator + (yktMaliyet &ikinci);//+ operatörü overloadý
		yktMaliyet operator = (yktMaliyet &ikinci);//= operatörü overloadý
		friend float yktHesapla(yktMaliyet,yktMaliyet);// friend fonksiyon
		float getMesafe();//mesafeyi döndüren fonksiyon(kapsülleme için)
		float getYakit();//yakýtý döndüren fonksiyon
		void setMesafe(float);//mesafeyi atayan fonksiyon
		void setYakit(float);//yakiti atayan fonksiyon
};
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
int main(){
	char secenek;
	int mesafe=100;
	cout<<"AB arasi mesafeyi girmek istiyor musunuz?(e/h): ";cin>>secenek;//parametre olacak mý sorduk
	if(secenek=='E' || secenek=='e'){//evet ise
		cout<<"A B arasi mesafeyi giriniz: "; cin>>mesafe; //iki þehir arasý mesafeyi alacak
	}
	yktMaliyet gidis(mesafe);// eðer kullanici parametre girmediyse mesafe 100 olacak.
	yktMaliyet donus;//donus nesnesi parametresiz ise mesafeyi 100 yaptý
	donus=gidis;//donus nesnesinin mesafesini gidiþe eþitledim
	yktMaliyet toplam=donus+gidis; // üçüncü bir nesne oluþturup toplam mesafeyi buldum.
	cout<<"Toplam mesafe: "<<toplam.getMesafe()<<endl;//toplam mesafeyi yazdýrdým
	cout<<"Toplam kullanilacak yakit: "<<yktHesapla(gidis,donus)<<"ml";//friend fonksiyonu kullanarak yakiti buldum.
	
	
	return 0;
}
