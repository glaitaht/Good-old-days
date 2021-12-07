#include <stdio.h> 
#include <stdbool.h>
int oyuntahtasi[8][8];//oyun tahtas� ta�lar� tutuyor
char yenecekyerler[128];//yenecek yerleri tutan string
int vezirx=9; //vezirin x kordinat�
int veziry=9; //vezirin y kordinat�
int kalex=9; //kalenin x kordinat�
int kaley=9; //kalenin y kordinat�
void fonksiyon(){//d�ng�leri yapacak fonksiyon
	int i, j;//d�ng�ler i�in tam say� tan�mlamalar�
	for(i=0;i<8;i++){//her sat�r
		for(j=0;j<8;j++){//her s�t�nda dola�acak
			if(i==kalex || j==kaley){//e�er i kalenin x veya j kalenin y kordinat�na e�itse
				oyuntahtasi[i][j]=1;//b�tun sat�r� veya sutunu 1 yapacak
			}
		}
	}
	for(i=0;i<8;i++){//vezirin gidece�i yerler
		for(j=0;j<8;j++){// sat�r s�t�n dola��yor
			if((j==veziry || i==vezirx ) && oyuntahtasi[i][j]==1){//i vezirin x, j vezirin y kordinat�na e�itse ve o yerde 1 varsa
				sprintf(yenecekyerler,"%s%d%d, ",yenecekyerler,i,j);// bu noktada vezir kaleyi yiyebiliyordur, stringe kaydedecek
			}
		}
	}
	int satirgeri=1;//vezirin olduu�u sat�r veya sut�ndan ne kadar uzakla�t���m�z� tutacak
	for(i=vezirx-1;i>=0;i--){ //sat�r vezirin oldu�u sat�r�n 1 eksi�i
		for(j=0;j<8;j++){ //b�t�n sutunlar� dola�acak
			if((j==veziry-satirgeri || j==veziry+satirgeri) && oyuntahtasi[i][j]==1){//e�er j vezirin x kordinat�na e�it uzunlukta uzaksa ve 1 varsa
				sprintf(yenecekyerler,"%s%d%d, ",yenecekyerler,i,j);//bu noktada vezir kaleyi yiyeibliyordur, stringe kaydedecek
			}
		}
		satirgeri++;//ka� sat�r geriye gittiysek okadar uzakla��caz
	}
	satirgeri=1;//bire e�itledik
	for(i=vezirx+1;i<8;i++){//vezirin oldu�u s�tunun 1 ilerisine ge�ti
		for(j=0;j<8;j++){ //b�t�n s�tunlarda bakacak
			if((j==veziry-satirgeri || j==veziry+satirgeri) && oyuntahtasi[i][j]==1){ //ayn� �ekilde e�it uzakl�ktaysa ve 1 varsa
				sprintf(yenecekyerler,"%s%d%d, ",yenecekyerler,i,j);//stringe kaydedecek
			}
		}
		satirgeri++; 
	}
	yenecekyerler[strlen(yenecekyerler)-2]=NULL;//son virg�l� sildi
}
int main(){ 
	FILE *tahta; //tahta dosyas� olu�turduk
	if ((tahta = fopen ("satranc.txt", "r+")) == NULL) { //dosyaya txt yi a�t�k
      printf("tahta a��lmad�");//a��lmad�ysa hata verdi 
      return 0;//bitirdi
  	}
	int i,j; int satir=0,sutun=0; // hata vermediyse program devam etti de�i�ken tuttuk
	while(!feof(tahta)){//dosyan�n en sonuna  gelmediysek okumaya devam edecek
		char karakter = fgetc(tahta); //char de�i�kene dosyadan s�radaki char� ald�k
		if(karakter == '0' || karakter == '1' || karakter == '2' ){ // char de�i�ken 0 1 2 ise girecek
			if(karakter == '0') //0 ise dizide o noktaya 0 yazd�racak
				oyuntahtasi[satir][sutun]=0; 
			if(karakter == '1' && satir<8 ) {//1 ise dizide o noktaya 1 yaz�p kalenin yerini kaydedecek
				oyuntahtasi[satir][sutun]=1; kalex=satir; kaley=sutun; 
			}
			if(karakter == '2' && satir<8 ) {//2 ise dizide o noktaya 2 yaz�p vezirin yerini kaydedecek
				oyuntahtasi[satir][sutun]=2; vezirx=satir; veziry=sutun;
			}
		}
		else continue; //de�ilse devam edecek
		sutun++;//e�er 0 1 2 okunduysa sutun artt�racak
		if(sutun>7){ //s�tun 8e ula�m��sa 
			sutun=sutun%8;//modunu alacak b�ylece 0'a geri d�necek
			satir=satir+1; // sat�r� 1 artt�racak.
		}
	}
	
	if(vezirx==9 || veziry==9 || kalex==9 || kaley==9){// e�er herhangi birine atama yap�lmam��sa
		printf("Vezir veya kalenin yeri dogru gozukmuyor.");//dosyada hata var
		return 0;//program� bitirdi
	}
	
	fonksiyon();//sorun yoksa fonksiyonu �al��t�rcak
	
	
	fprintf(tahta,"\n%d%d pozisyonundaki vezir ta�� %d%d pozisyonundaki kale ta��n� %s pozisyonlar�nda yiyebilmektedir.",vezirx,veziry,kalex,kaley,yenecekyerler);
	//��kan sonucu dosyaya yazd�racak 
	fclose(tahta); // dosyay� kapatacak
	
	return 0;//ve bitireck
}
