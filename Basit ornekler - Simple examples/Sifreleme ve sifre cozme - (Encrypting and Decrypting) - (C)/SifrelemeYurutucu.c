#include <stdio.h>
char diziHarf[26]={'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'};
		// 26 elemanlý harfler dizisi
int main(){
	int i,j; // döngü için deðer tanýmlamasý
	int islem=0; //hangi iþlem yapýlacak onu tutan tam deger tanýmlamasý
	char kelime[10]; // max 10 karakterli kelime tutan dizi
	char key[3];int keyKac[3]; // 3 harfli anahtar kelime ve onun sayýsal deðerini tutan diziler
	printf("3 karakterli anahtar kelimeyi yaziniz\n"); 
	scanf("%s",key); // anahtar kelime alýndý
	printf("en fazla 10 karakterli metin yaziniz\n");
	scanf("%s",kelime); // sifre islemi yapýlacak kelime alýndý
	printf("1. sifrele\n"); // hangi iþlem yapýlacak soruldu
	printf("2. sifre coz\n?");
	scanf("%d",&islem); // iþlem alýndý
	for(i=0;i<3;i++){ // anahtar kelime için döngü
		for(j=0;j<26;j++){ // 3 x 26 dolaþacak
			if(key[i]==diziHarf[j]) keyKac[i]=j; // anahtardaki harf harfler dizisinde kaçýncý indisde ise int dizide tutacak
		}
	}
	if(islem==1){ // sifreleme
		for(i=0;i<strlen(kelime);i++){ // kelime uzunluðu kadar dönecek max 10
			char harf=kelime[i]; // kelimedeki harfi aldý
			int diziElemani=-1; // kacinci indis elemaný olduðuna bakacak
			for(j=0;j<26;j++){
				if(diziHarf[j]==harf){ // harf bulununca 
					diziElemani=j;//indis deðerini tuttu
				}
			}
			kelime[i]=diziHarf[(diziElemani+keyKac[i%3])%26]; // indis sayýsý ile anahtardaki sayýyý topladý
										// i%3 indisin baþtan tekrar etmesini saðlýyor : notnotno gibi
										// %26 sýnýrýn dýþýna çýkarsa baþtan tekrar baþlamasýna yarýyor
		}
		printf("sifrelenmis kelime: %s",kelime);//çýkan sonuç yazdýrýldý
	}
	else if(islem==2){ // sifre çözme 
		for(i=0;i<strlen(kelime);i++){ 
			char harf=kelime[i]; 
			int diziElemani=-1;
			for(j=0;j<26;j++){
				if(diziHarf[j]==harf){
					diziElemani=j;
				}
			}
			if((diziElemani-keyKac[i%3]) < 0){// þifrelemeden tek farký 
				diziElemani=diziElemani+26;// harfin indisini bulduktan sonra anahtarý çýkartýyor olmasý. 
										// dolayýsýyla 0'ýn altýna düþerse üst sýnýr olan 26'dan tekrar baþlamalý
										//+26 yazmamýzýn sebebi o
			}
			kelime[i]=diziHarf[(diziElemani-keyKac[i%3])%26];
		}
		printf("sifre cozumu yapilen kelime: %s",kelime); // çýkan sonucu yazdýrdýk.
	}
	return 0;
}
