#include <stdio.h>
int buyukten(int *dizi){
	int i,j;
	for(i=0;i<5;i++){
		for(j=i+1;j<5;j++){
			if(dizi[i]<dizi[j]){
				int temp=dizi[i];
				dizi[i]=dizi[j];
				dizi[j]=temp;
			}
		}
	}
}
int kucukten(int *dizi){
	int i,j;
	for(i=0;i<5;i++){
		for(j=i+1;j<5;j++){
			if(dizi[i]>dizi[j]){
				int temp=dizi[i];
				dizi[i]=dizi[j];
				dizi[j]=temp;
			}
		}
	}
}
int girilentersi(int *dizi){
	int i,j;
	for(i=0;i<2;i++){
		int temp=dizi[i];
		dizi[i]=dizi[5-1-i];
		dizi[5-1-i]=temp;
	}
}
int main(){
	int fonksiyon[5];
	int i;
	for(i=0;i<5;i++){
		printf("Lutfen %d. sayiyi giriniz: ",i+1);
		scanf("%d",&fonksiyon[i]);
	}
	int secenek=-1;
	printf("Sayilari buyukten kucuge siralamak icin 1\n");
	printf("Sayilari kucukten buyuge siralamak icin 2\n");
	printf("Sayilari girildigi siranin tersine siralamak icin 3 yaziniz.\n");
	printf("Lutfen yapmak istediginiz islemi yaziniz: ");
	scanf("%d",&secenek);
	if(secenek==1){
		buyukten(fonksiyon);
	}
	else if(secenek==2){
		kucukten(fonksiyon);
	}
	else if(secenek==3){
		girilentersi(fonksiyon);
	}
	else{
		printf("Yanlis girdi, program bitti.");
		return 0;
	}
	for(i=0;i<5;i++){
		printf("%d ", fonksiyon[i]);
	}
	return 0;
}
