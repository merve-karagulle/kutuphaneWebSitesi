# kutuphaneWebSitesi
Bu depoda, bir kütüphaneye ait veriler veri tabanından alınarak kullanıcılara çeşitli işlemleri gerçekleştirme olanağı sunulmaktadır.
# 📚 Kütüphane Yönetim Sistemi

Bu proje, bir **kütüphane web sitesi** üzerinden kullanıcıların **giriş yapabildiği**, kitapları **ekleyebildiği**, **güncelleyebildiği** ve **silebildiği** bir yönetim sistemi sunar.  
Proje kapsamında SQL veritabanı kullanılarak kitap, kullanıcı ve kitap takibi işlemleri gerçekleştirilmektedir.

## 🚀 Özellikler

- Kullanıcı giriş sistemi
- Kitaplar için:
  - Ekleme
  - Silme
  - Güncelleme
- Kullanıcılar için:
  - Ekleme
  - Silme
  - Güncelleme
- Kitap Takip Tablosu:
  - Kitap ödünç alma ve iade işlemleri
- SQL veritabanı entegrasyonu
- Temiz ve kullanıcı dostu arayüz

## 🛠️ Kullanılan Teknolojiler

- **HTML / CSS / JavaScript** (Web Arayüzü)
- **PHP** (Arka Plan İşlemleri - varsa)
- **MySQL** (Veri Tabanı)
- **cPanel** (Web barındırma - isteğe bağlı)

## 🗄️ Veritabanı Yapısı

- `kullanicilar` tablosu
- `kitaplar` tablosu
- `kitap_takip` tablosu

Her tabloda **Ekle**, **Sil** ve **Güncelle** butonları bulunmaktadır.

## ⚙️ Kurulum

1. Bu depoyu bilgisayarınıza klonlayın:
   ```bash
   git clone (https://github.com/merve-karagulle/kutuphaneWebSitesi)
2.Veritabanı dosyasını (.sql) kendi MySQL sunucunuza import edin.
3.Bağlantı ayarlarını (config.php gibi) kendi sunucunuza göre düzenleyin.
4.Web tarayıcınızdan localhost/proje-adi adresine giderek kullanmaya başlayın.

🧑‍💻 Katkıda Bulunma
İyileştirme önerileriniz veya katkılarınız için pull request gönderebilirsiniz!

📜 Lisans
Bu proje kişisel kullanım içindir. İsterseniz kendinize göre özelleştirip kullanabilirsiniz.
