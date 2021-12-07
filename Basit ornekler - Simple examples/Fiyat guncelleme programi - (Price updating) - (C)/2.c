#include <stdio.h>
int main(){
	FILE *liste=fopen("kitap_listesi.txt","r");
	FILE *yeni= fopen("yeni_liste.txt","w+");
	char str[250];
	char ekle[250];
	float fiyat;
	int say=0;
	while(fscanf(liste,"%s",str)!= EOF){
		if(say%4==1){
			strcpy(ekle,str);
		}
		else if(say%4==2){
			sscanf(str,"%f",&fiyat);
		}
		else if(say%4==3){
			fprintf(yeni,"%d. %-40s \t %.2f\tTL\n",(say/4+1),ekle,fiyat*1.15);
		}
		say++;
	}
	fclose(liste);
	fclose(yeni);
	return 0;
}
