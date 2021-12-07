class yktMaliyet{
	private:
		float fmesafe;//d��ardan eri�ilemeyecek de�i�kenleri
		float fyakit;//private i�inde yazd�k
	public:
		yktMaliyet();// bo� yap�c�
		yktMaliyet(float);// float ile dolu yap�c�
	    yktMaliyet operator + (yktMaliyet &ikinci);//+ operat�r� overload�
		yktMaliyet operator = (yktMaliyet &ikinci);//= operat�r� overload�
		friend float yktHesapla(yktMaliyet,yktMaliyet);// friend fonksiyon
		float getMesafe();//mesafeyi d�nd�ren fonksiyon(kaps�lleme i�in)
		float getYakit();//yak�t� d�nd�ren fonksiyon
		void setMesafe(float);//mesafeyi atayan fonksiyon
		void setYakit(float);//yakiti atayan fonksiyon
};
