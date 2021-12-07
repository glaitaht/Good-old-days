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
