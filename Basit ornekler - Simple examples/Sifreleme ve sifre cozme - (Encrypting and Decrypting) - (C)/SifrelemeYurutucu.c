#include <stdio.h>
char diziHarf[26]={'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'};
		// 26 elemanl� harfler dizisi
int main(){
	int i,j; // d�ng� i�in de�er tan�mlamas�
	int islem=0; //hangi i�lem yap�lacak onu tutan tam deger tan�mlamas�
	char kelime[10]; // max 10 karakterli kelime tutan dizi
	char key[3];int keyKac[3]; // 3 harfli anahtar kelime ve onun say�sal de�erini tutan diziler
	printf("3 karakterli anahtar kelimeyi yaziniz\n"); 
	scanf("%s",key); // anahtar kelime al�nd�
	printf("en fazla 10 karakterli metin yaziniz\n");
	scanf("%s",kelime); // sifre islemi yap�lacak kelime al�nd�
	printf("1. sifrele\n"); // hangi i�lem yap�lacak soruldu
	printf("2. sifre coz\n?");
	scanf("%d",&islem); // i�lem al�nd�
	for(i=0;i<3;i++){ // anahtar kelime i�in d�ng�
		for(j=0;j<26;j++){ // 3 x 26 dola�acak
			if(key[i]==diziHarf[j]) keyKac[i]=j; // anahtardaki harf harfler dizisinde ka��nc� indisde ise int dizide tutacak
		}
	}
	if(islem==1){ // sifreleme
		for(i=0;i<strlen(kelime);i++){ // kelime uzunlu�u kadar d�necek max 10
			char harf=kelime[i]; // kelimedeki harfi ald�
			int diziElemani=-1; // kacinci indis eleman� oldu�una bakacak
			for(j=0;j<26;j++){
				if(diziHarf[j]==harf){ // harf bulununca 
					diziElemani=j;//indis de�erini tuttu
				}
			}
			kelime[i]=diziHarf[(diziElemani+keyKac[i%3])%26]; // indis say�s� ile anahtardaki say�y� toplad�
										// i%3 indisin ba�tan tekrar etmesini sa�l�yor : notnotno gibi
										// %26 s�n�r�n d���na ��karsa ba�tan tekrar ba�lamas�na yar�yor
		}
		printf("sifrelenmis kelime: %s",kelime);//��kan sonu� yazd�r�ld�
	}
	else if(islem==2){ // sifre ��zme 
		for(i=0;i<strlen(kelime);i++){ 
			char harf=kelime[i]; 
			int diziElemani=-1;
			for(j=0;j<26;j++){
				if(diziHarf[j]==harf){
					diziElemani=j;
				}
			}
			if((diziElemani-keyKac[i%3]) < 0){// �ifrelemeden tek fark� 
				diziElemani=diziElemani+26;// harfin indisini bulduktan sonra anahtar� ��kart�yor olmas�. 
										// dolay�s�yla 0'�n alt�na d��erse �st s�n�r olan 26'dan tekrar ba�lamal�
										//+26 yazmam�z�n sebebi o
			}
			kelime[i]=diziHarf[(diziElemani-keyKac[i%3])%26];
		}
		printf("sifre cozumu yapilen kelime: %s",kelime); // ��kan sonucu yazd�rd�k.
	}
	return 0;
}
