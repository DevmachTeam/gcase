
# Getmobil Case

Proje kurulumu 3 ana temelden Oluşuyor


## Docker Optimizasyonu
Eğer daha önce terminalinizde Makefile konfigurasyonu yapmış iseniz aşağıdaki kodu yazmanız yeterli.Makefile tanımlanan docker build,up ve composer update işlemleri sıralı bir şekilde oluşacaktır.

```bash 
   make setup 
```
Doğrudan Docker ile kurulum için anadizinde iken terminalden bu kodu çalıştırınız.  

```bash 
   docker-compose build --no-cache --force-rm 
```

Docker Kurulumlarına başlayacaktır.Bu süreçte Projenin çalışması için gerekli olan apache,mysql,mongodb ve phpmyadmin kurulumu tamamlanmış olacaktır.Sonrsaında Docker Konteynırlarımızı Ayağa Kaldırmak için aşağıdaki kodu terminale yapıştırın.

```bash 
   docker-compose up -d
```
Projenin çalışması için gerekli olan altyapıyı kurduk şimdi projemize geçebiliriz.Öncelikle projenin bulunduğu dizine gidiyoruz.Terminale aşağıdaki kodu yazınız.

```bash 
   cd gcase
```

Daha sonra gerekli kütüphaneler için composer dosyamızı çalıştırıyoruz

```bash 
   composer-update
```
Gerekli olan kütüphanelerin yüklenmesinin ardından ".env" dosyamızda bir değişikliğe gitmiyoruz.Süreç bitiminde genel bilgilerin hepsini not olarak ayrıca paylaşıcam.

Bulunduğumuz dizinde veritabanı işlemleri için migration ve seed aktif hale getiriyoruz.
Makefile kullanıyorsak aşağıdaki satırı yazmamız yeterli.

```bash 
   make data
```

Doğrudan kurulum için sırasıyla aşağıdaki kodları uyguluyoruz.

```bash 
   php artisan migrate
```
```bash 
   php artisan db:seed
```
Altyapımız ve veritabanı işlemlerimiz hazır hale geldi.Şimdi Ana dizinde bulunan GetMobil postman koleksiyonumuzu postman uygulamamıza aktarabiliriz.Bunun için Postman uygulamasında File/Import seçenklerine tıklayarak işlemi tamamlayabiliriz.


Burada Sırasıyla AccessToken isteğine gidiyoruz ve Oauth2 AccessToken alıyoruz.

AccessToken geçerlilik süresi 1 gündür.

```bash 
   Passport::personalAccessTokensExpireIn(now()->addDays(1));
```

Sonrasında LoginCheck İsteği ile Login Kontrolünü Sağlıyoruz.

Products İsteği Bize Tüm Ürünleri getirmekte.

Payment ile Ödeme İşlemlerini Tamamlayıp Stoktan düştükten sonra MongoDB sell_orders koleksiyonuna kaydımızı yapıyoruz.

Kullanılan Teknolojiler 
Laravel,Mysql,MongoDB,Docker

Kullanılan Kütüphaneler

Oauth2 işlemleri için "Laravel-Passport" eklentisi kullanıldı.
MongoDB işlemleri için "jenssegers/mongodb" kütüphanesi kullanıldı.

## NOT
Case içerisinde özellikle satın alma işlemleri içerisinde stok kilitleme ve eşzamanlı işlemlerdeki olası hataların önüne geçmek için ikisinide çözüm getireceğini düşündüğüm ve daha öncede kullandığım tek bir işlem yaptım.

Sql'de kullandığımız FOR UPDATE ile o anda yapılan sql satırını kitleyip eşlenik sorguların mevcut stok yada vb. işlemlere müdahalesini engellemiş oluyoruz.

Aşağıdaki Satırda olduğu gibi payment apisinden aynı anda bir satış gelmesi vb durumlarda önce ilk gelen isteğin işlemleri yapılıp satır kitleniyor (pessimistic locking) böylelikle stoklardaki uyuşmazlık vb durumların önüne geçmiş oluyoruz.


```bash 
    $product = Products::where('id', $productId)->lockForUpdate()->first();  
```


Bunun dışında doğrudan DB:transaction kullanarak tek işlem üzerinden bir kilitleme de yapabiliriz. 

```bash 
   DB::transaction(function () use ($request) {
      .....
   }
```
Böylelikle eşlenik durumlara çözüm sağlayıp mongodb deki crud işlemler yapılıp payment servisi tamamlanmış oluyor.




## Rozetler

[![MIT License](https://img.shields.io/badge/License-MIT-green.svg)](https://choosealicense.com/licenses/mit/)
[![GPLv3 License](https://img.shields.io/badge/License-GPL%20v3-yellow.svg)](https://opensource.org/licenses/)
[![AGPL License](https://img.shields.io/badge/license-AGPL-blue.svg)](http://www.gnu.org/licenses/agpl-3.0)

  