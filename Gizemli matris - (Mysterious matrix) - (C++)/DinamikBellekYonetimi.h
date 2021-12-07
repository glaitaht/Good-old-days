class DinamikBellekYonetimi{
	public:
		bool GizemliMatrisMi(int**,int,int); // 1. kýsýmda istenen gizemli matris olup olmadýðýný kontrol eden fonksiyon
		int SansliMatrisElemanlarininSayisi(int**,int,int); // 2. kýsýmda istenen þanslý eleman sayýsýný bulan fonksiyon
	private:
		int KareMi(int**,int,int); // bir matrisin kare olup olmadýðýný kontrol eden fonksiyon
		bool VarMi(int**,int,int,int); // bir matrisin içinde 4. parametreyi arayan fonksiyon
		int KacTaneSansli(int*,int*,int,int); // iki dizinin içindeki elemanlarý karþýlaþtýran ve þanslý eleman sayýsýný fonksiyona döndüren fonksiyon
};
