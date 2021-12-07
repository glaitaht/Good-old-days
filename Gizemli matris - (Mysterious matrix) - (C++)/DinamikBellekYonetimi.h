class DinamikBellekYonetimi{
	public:
		bool GizemliMatrisMi(int**,int,int); // 1. k�s�mda istenen gizemli matris olup olmad���n� kontrol eden fonksiyon
		int SansliMatrisElemanlarininSayisi(int**,int,int); // 2. k�s�mda istenen �ansl� eleman say�s�n� bulan fonksiyon
	private:
		int KareMi(int**,int,int); // bir matrisin kare olup olmad���n� kontrol eden fonksiyon
		bool VarMi(int**,int,int,int); // bir matrisin i�inde 4. parametreyi arayan fonksiyon
		int KacTaneSansli(int*,int*,int,int); // iki dizinin i�indeki elemanlar� kar��la�t�ran ve �ansl� eleman say�s�n� fonksiyona d�nd�ren fonksiyon
};
