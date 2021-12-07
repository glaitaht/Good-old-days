#include <stdio.h> 
#include <stdbool.h>
int oyuntahtasi[8][8];//oyun tahtasý taþlarý tutuyor
char yenecekyerler[128];//yenecek yerleri tutan string
int vezirx=9; //vezirin x kordinatý
int veziry=9; //vezirin y kordinatý
int kalex=9; //kalenin x kordinatý
int kaley=9; //kalenin y kordinatý
void fonksiyon(){//döngüleri yapacak fonksiyon
	int i, j;//döngüler için tam sayý tanýmlamalarý
	for(i=0;i<8;i++){//her satýr
		for(j=0;j<8;j++){//her sütünda dolaþacak
			if(i==kalex || j==kaley){//eðer i kalenin x veya j kalenin y kordinatýna eþitse
				oyuntahtasi[i][j]=1;//bütun satýrý veya sutunu 1 yapacak
			}
		}
	}
	for(i=0;i<8;i++){//vezirin gideceði yerler
		for(j=0;j<8;j++){// satýr sütün dolaþýyor
			if((j==veziry || i==vezirx ) && oyuntahtasi[i][j]==1){//i vezirin x, j vezirin y kordinatýna eþitse ve o yerde 1 varsa
				sprintf(yenecekyerler,"%s%d%d, ",yenecekyerler,i,j);// bu noktada vezir kaleyi yiyebiliyordur, stringe kaydedecek
			}
		}
	}
	int satirgeri=1;//vezirin olduuðu satýr veya sutündan ne kadar uzaklaþtýðýmýzý tutacak
	for(i=vezirx-1;i>=0;i--){ //satýr vezirin olduðu satýrýn 1 eksiði
		for(j=0;j<8;j++){ //bütün sutunlarý dolaþacak
			if((j==veziry-satirgeri || j==veziry+satirgeri) && oyuntahtasi[i][j]==1){//eðer j vezirin x kordinatýna eþit uzunlukta uzaksa ve 1 varsa
				sprintf(yenecekyerler,"%s%d%d, ",yenecekyerler,i,j);//bu noktada vezir kaleyi yiyeibliyordur, stringe kaydedecek
			}
		}
		satirgeri++;//kaç satýr geriye gittiysek okadar uzaklaþýcaz
	}
	satirgeri=1;//bire eþitledik
	for(i=vezirx+1;i<8;i++){//vezirin olduðu sütunun 1 ilerisine geçti
		for(j=0;j<8;j++){ //bütün sütunlarda bakacak
			if((j==veziry-satirgeri || j==veziry+satirgeri) && oyuntahtasi[i][j]==1){ //ayný þekilde eþit uzaklýktaysa ve 1 varsa
				sprintf(yenecekyerler,"%s%d%d, ",yenecekyerler,i,j);//stringe kaydedecek
			}
		}
		satirgeri++; 
	}
	yenecekyerler[strlen(yenecekyerler)-2]=NULL;//son virgülü sildi
}
int main(){ 
	FILE *tahta; //tahta dosyasý oluþturduk
	if ((tahta = fopen ("satranc.txt", "r+")) == NULL) { //dosyaya txt yi açtýk
      printf("tahta açýlmadý");//açýlmadýysa hata verdi 
      return 0;//bitirdi
  	}
	int i,j; int satir=0,sutun=0; // hata vermediyse program devam etti deðiþken tuttuk
	while(!feof(tahta)){//dosyanýn en sonuna  gelmediysek okumaya devam edecek
		char karakter = fgetc(tahta); //char deðiþkene dosyadan sýradaki charý aldýk
		if(karakter == '0' || karakter == '1' || karakter == '2' ){ // char deðiþken 0 1 2 ise girecek
			if(karakter == '0') //0 ise dizide o noktaya 0 yazdýracak
				oyuntahtasi[satir][sutun]=0; 
			if(karakter == '1' && satir<8 ) {//1 ise dizide o noktaya 1 yazýp kalenin yerini kaydedecek
				oyuntahtasi[satir][sutun]=1; kalex=satir; kaley=sutun; 
			}
			if(karakter == '2' && satir<8 ) {//2 ise dizide o noktaya 2 yazýp vezirin yerini kaydedecek
				oyuntahtasi[satir][sutun]=2; vezirx=satir; veziry=sutun;
			}
		}
		else continue; //deðilse devam edecek
		sutun++;//eðer 0 1 2 okunduysa sutun arttýracak
		if(sutun>7){ //sütun 8e ulaþmýþsa 
			sutun=sutun%8;//modunu alacak böylece 0'a geri dönecek
			satir=satir+1; // satýrý 1 arttýracak.
		}
	}
	
	if(vezirx==9 || veziry==9 || kalex==9 || kaley==9){// eðer herhangi birine atama yapýlmamýþsa
		printf("Vezir veya kalenin yeri dogru gozukmuyor.");//dosyada hata var
		return 0;//programý bitirdi
	}
	
	fonksiyon();//sorun yoksa fonksiyonu çalýþtýrcak
	
	
	fprintf(tahta,"\n%d%d pozisyonundaki vezir taþý %d%d pozisyonundaki kale taþýný %s pozisyonlarýnda yiyebilmektedir.",vezirx,veziry,kalex,kaley,yenecekyerler);
	//çýkan sonucu dosyaya yazdýracak 
	fclose(tahta); // dosyayý kapatacak
	
	return 0;//ve bitireck
}
