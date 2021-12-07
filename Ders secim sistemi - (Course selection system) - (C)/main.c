#include <stdio.h>
#include <locale.h>
#include <conio.h>
#include <string.h>
void girisYap();
void ogrenciGirdi();
void danismanGirdi();
void ogrenciKisisel();
void ogrenciAkademik();
void dosyadanSil(char*);
void ogrenciAlinabilecek();
void dersHavuzuYukle(int);
void ogrenciAlinanDonustur(char*,int);
char girisTC[12];
char girisTip;
char dersHavuzu[48][3][20];
char harcBilgisi[13];
int sinif;
float agno;
char sinifAdi[8];
char alinacakDers[10][6];
char alinabilecekDers[24][3][20];
char kalinanDers[24][6];
int kalinanDersSayisi=0;
char alinanDers[48][2][6];
char onayBekleme[25][4][50];
int main(){
	setlocale(LC_ALL,"Turkish");
	dersHavuzuYukle(0);
	girisYap();
	if(girisTip=='o'){
		ogrenciGirdi();
	}
	else{
		danismanGirdi();
	}
	
	return 0;
}

void girisYap(){
	FILE *fs;
	if((fs=fopen("girisbilgi.txt","r"))!=NULL){
		int c;int i;
		char tc[20][12];
		char sifre[20][20];
		char tip[20];
		int satir=0;
		c=fscanf(fs,"%s %s %s",&tc[satir],&sifre[satir],&tip[satir]);
		while(c!=EOF){
			satir++;
			c=fscanf(fs,"%s %s %s",&tc[satir],&sifre[satir],&tip[satir]);
		}
		char tipg;
		char sifreg[20];
		char tcg[20];
		printf("Öðrenci giriþi için o, akademisyen giriþi için d'yi tuþlayýnýz : ");
		scanf("%c",&tipg);
		printf("TCK no : ");
		scanf("%s",tcg);
		printf("Þifre : ");
		scanf("%s",sifreg);
		for(i=0;i<satir;i++){
			if(tipg==tip[i]&&(strcmp(sifreg,sifre[i]))==0&&(strcmp(tcg,tc[i]))==0){
				system("cls");
				printf("Giriþ baþarýlý.\n");
				girisTip=tipg;
				strcpy(girisTC,tcg);
			}
			else if(i==satir-1 && girisTip==NULL){
				printf("Giriþ yapýlamadý. Uygulama kapatýlacak.");
				exit(1);
			}
		}
	}
	else{
		printf("Giriþ bilgi dosyasý açýlamadý.");
	}
}
void ogrenciGirdi(){
	ogrenciKisisel();
	ogrenciAkademik();
	ogrenciAlinabilecek();
}
void danismanGirdi(){
	int i=0,j=0;
	int satir=0;
	
	dersHavuzuYukle(3);
	char snf[6];
	printf("\nSinif adi giriniz:");scanf("%s",snf);
	FILE *fs;
	if((fs=fopen("onaybekleyen.txt","r"))!=NULL){
		int c;
		c=fscanf(fs,"%s %s %s %s",onayBekleme[satir][0],onayBekleme[satir][1],onayBekleme[satir][2],onayBekleme[satir][3]);
		while(c!=EOF){
			satir++;
			c=fscanf(fs,"%s %s %s %s",onayBekleme[satir][0],onayBekleme[satir][1],onayBekleme[satir][2],onayBekleme[satir][3]);
		}
	}
	else{
		printf("Onay bekleyen dosyasý açýlamadý.");
	}
	for(i=0;i<satir;i++){
		printf("\nOgrenci TC: %s Harcý:%s Seçilen Dersler: ",onayBekleme[i][0],onayBekleme[i][2]);
		for(j=0;j<strlen(onayBekleme[i][3]);j++){
			if(onayBekleme[i][3]==NULL) break;
			if(onayBekleme[i][3][j]==','){
				printf(" ");
			}
			else{
				printf("%c",onayBekleme[i][3][j]);
			}
		}
	}
	char islemtc[12];
	int silinecek=0;
	printf("\nÝþlem yapýlacak ögrenci TC'sini giriniz : ");
	scanf("%s",islemtc);
	printf("Onaylamak için 1'i reddetmek için 2'yi tuþlayýn : ");
	scanf("%d",&silinecek);
	if(silinecek==1){
		for(i=0;i<25;i++){
			if((strcmp(islemtc,onayBekleme[i][0]))==0){
				satir=i;
				break;
			}
		}
		if((strcmp("yatirilmamis",onayBekleme[satir][2]))==0){
			printf("Harç yatýrýlmamýþ program bitti.");
			return;
		}
		FILE *fs2;
		if((fs2=fopen("onaylanan.txt","a"))!=NULL){
			fprintf(fs2,"%s %s %s %s",onayBekleme[satir][0],onayBekleme[satir][1],onayBekleme[satir][2],onayBekleme[satir][3]);
		}
		dosyadanSil(islemtc);
		printf("\nBaþarýyla onaylandý ve onaylanan dosyasýna eklendi.");
	}
	else if(silinecek==2){
		dosyadanSil(islemtc);
		printf("\nBaþarýyla Reddedildi.");
	}
	else{
		printf("\nYanlýþ girdi, programdan çýkýldý.");
	}
}
void ogrenciKisisel(){
	FILE *fs;
	if((fs=fopen("ogrencikisisel.txt","r"))!=NULL){
		int c;
		char tca[12];
		char ad[20];
		char iletisim[20];
		char bolum[30];
		c=fscanf(fs,"%s %s %s %s",tca,ad,iletisim,bolum);
		while(c!=EOF){
			if((strcmp(tca,girisTC))==0){
				printf("Hoþgeldiniz %s. Ýletiþim numaranýz : %s, Bölümünüz: %s\n",ad,iletisim,bolum);
			}
			c=fscanf(fs,"%s %s %s %s",tca,ad,iletisim,bolum);
		}
	}
	else{
		printf("Öðrenci kiþisel dosyasý açýlamadý.");
	}
}
void dersHavuzuYukle(int yukle){
	FILE *fs;
	int satir=0;
	int i;
	if((fs=fopen("dershavuzu.txt","r"))!=NULL){
		int c;
		c=fscanf(fs,"%s %s %s",dersHavuzu[satir][0],dersHavuzu[satir][1],dersHavuzu[satir][2]);
		while(c!=EOF){
			satir++;
			c=fscanf(fs,"%s %s %s",dersHavuzu[satir][0],dersHavuzu[satir][1],dersHavuzu[satir][2]);
		}
	}
	else{
		printf("Ders havuzu dosyasý açýlamadý.");
	}
	if(yukle==3){
		for(i=0;i<satir;i++){
			if(i==0) printf("Dersler ve kodlarý:");
			printf("\n%s %s %s",dersHavuzu[i][0],dersHavuzu[i][1],dersHavuzu[i][2]);
		}
	}
}
void ogrenciAkademik(){
	char alinanDersler[300];
	FILE *fs;
	if((fs=fopen("ogrenciakademik.txt","r"))!=NULL){
		int c;
		char tca[12];
		char harc[13];
		int siniff;
		float agnof;
		char sinifad[8];
		char alinanlar[300];
		c=fscanf(fs,"%s %s %d %f %s %s",tca,harc,&siniff,&agnof,sinifad,alinanlar);
		while(c!=EOF){
			if((strcmp(tca,girisTC))==0){
				printf("Sýnýf:%d(%d) Agno:%.2f Sýnýf Adý:%s",siniff/2,siniff,agnof,sinifad);
				strcpy(alinanDersler,alinanlar);
				strcpy(harcBilgisi,harc);
				strcpy(sinifAdi,sinifad);
				sinif=siniff;
				agno=agnof;
				break;
			}
			c=fscanf(fs,"%s %s %d %f %s %s",tca,harc,&siniff,&agnof,sinifad,alinanlar);
		}
		ogrenciAlinanDonustur(alinanDersler,strlen(alinanDersler));
	}
	else{
		printf("Ogrenci akademik dosyasý açýlamadý.");
	}
}
void ogrenciAlinanDonustur(char* dizi,int uzunluk){
	int i,j;
	int virgul=0;int mec=0;
	for(i=0;i<uzunluk;i=i+7){
		alinanDers[virgul][0][0]=dizi[i];
		alinanDers[virgul][0][1]=dizi[i+1];
		alinanDers[virgul][0][2]=dizi[i+2];
		alinanDers[virgul][0][3]=dizi[i+3];
		alinanDers[virgul][1][0]=dizi[i+5];
		
		virgul++;
	}
	printf("\nAlinan Dersler:");
	for(i=0;i<virgul;i++){
		for(j=0;j<48;j++){
			if((strcmp(alinanDers[i][0],dersHavuzu[j][1]))==0){
				printf("\n%s. donem %s  %s",dersHavuzu[j][0],dersHavuzu[j][2],alinanDers[i][1][0] == 'G' ?  "Geçti" : "Kaldý");
				if(alinanDers[i][1][0]=='K'){
					strcpy(kalinanDers[mec],dersHavuzu[j][1]);
					kalinanDersSayisi++;
					mec++;
				}
			}
		}
	}
}
void ogrenciAlinabilecek(){
	int i,j;
	int alinanlar=0;
	printf("\nAlinabilecek Dersler:");
	for(i=0;i<48;i++){
		char sayi1[10];sprintf(sayi1,"%d",sinif);
		char sayi2[10];sprintf(sayi2,"%d",sinif-2);
		char sayi3[10];sprintf(sayi3,"%d",sinif-4);
		char sayi4[10];sprintf(sayi4,"%d",sinif-6);
		if((strcmp(dersHavuzu[i][0],sayi1))==0 || (strcmp(dersHavuzu[i][0],sayi2))==0|| (strcmp(dersHavuzu[i][0],sayi3))==0|| (strcmp(dersHavuzu[i][0],sayi4)==0)){
			printf("\n%s. donem %s %s",dersHavuzu[i][0],dersHavuzu[i][1],dersHavuzu[i][2]);
			strcpy(alinabilecekDers[alinanlar][0],dersHavuzu[i][0]);
			strcpy(alinabilecekDers[alinanlar][1],dersHavuzu[i][1]);
			strcpy(alinabilecekDers[alinanlar][2],dersHavuzu[i][2]);
			alinanlar++;
			for(j=0;j<24;j++){
				if((strcmp(dersHavuzu[i][1],kalinanDers[j]))==0){
					printf("  Alýnmasý zorunlu.");
				}
			}
		}
	}
	int akts=0;
	int kalinansay=0;
	if(agno>=1.75) akts=45; else akts=30;
	int alinansayi=0;
	int alinmis=0;
	printf("Ders alýmýný bitirmek için . yazýn");
	while(akts>0){
		char alinacak[6];
		printf("\nAlmak istediðiniz dersin kodunu yazýnýz: ");
		scanf("%s",alinacak);
		if(alinacak[0]=='.') break;
		for(i=0;i<10;i++){
			if((strcmp(alinacak,alinacakDers[i]))==0){
				printf("\n Bu ders zaten alýnmýþ.");
				alinmis++;
			}
		}
		if(alinmis==1){
			alinmis=0;
			continue;
		}
		if(sinif/2==1 || sinif/2==0){
			printf("\n%s kodlu ders alýndý", alinacak);
			akts=akts-5;
			strcpy(alinacakDers[alinansayi],alinacak);
			alinansayi++;
			continue;	
		}
		
		for(i=0;i<10;i++){
			if((strcmp(alinacak,kalinanDers[i]))==0){
				printf("\n%s kodlu ders alýndý", kalinanDers[i]);
				akts=akts-5;
				strcpy(alinacakDers[alinansayi],kalinanDers[i]);
				alinansayi++;
				kalinanDers[i][0]=NULL;
				kalinanDersSayisi--;
				break;
			}
			else if(kalinanDersSayisi==0){
				printf("\n%s kodlu ders alýndý", alinacak);
				akts=akts-5;
				strcpy(alinacakDers[alinansayi],alinacak);
				alinansayi++;
				break;
			}
			else if(i==9){
				printf("\nLütfen öncelikli olarak derslerinizi alttan alýnýz.");
			}
		}
	}
	printf("\n\n\nAlýnan Dersler Kaydedildi: ");
	FILE *fs;
	if((fs=fopen("onaybekleyen.txt","a"))!=NULL){
		fprintf(fs,"\n%s %s %s ",girisTC,sinifAdi,harcBilgisi);
	}
	for(i=0;i<alinansayi;i++){
		fprintf(fs,"%s,",alinacakDers[i]);
		printf("%s ", alinacakDers[i]);
	}
	
}
void dosyadanSil(char*tc){
	int i=0;
	int satir=-1;
	for(i=0;i<25;i++){
		if((strcmp(tc,onayBekleme[i][0]))==0){
			satir=i;
			memset(&onayBekleme[i][0][0],0,sizeof(onayBekleme[i][0]));
			memset(&onayBekleme[i][1][0],0,sizeof(onayBekleme[i][1]));
			memset(&onayBekleme[i][2][0],0,sizeof(onayBekleme[i][2]));
			memset(&onayBekleme[i][3][0],0,sizeof(onayBekleme[i][3]));
			break;
		}
	}
	FILE *fs;
	if((fs=fopen("onaybekleyen.txt","w"))!=NULL){
		for(i=0;i<25;i++){
			if(i==satir) continue;
			fprintf(fs,"%s %s %s %s",onayBekleme[i][0],onayBekleme[i][1],onayBekleme[i][2],onayBekleme[i][3]);
		}
	}
}
