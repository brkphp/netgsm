<<<<<<< Updated upstream
# Netgsm santral paketi

Hakkında
====================

Netgsm Santral geçmiş görüşme raporları laravel paketi

> Sms class'ı yazılmaktadır. santralde tarih , telefon numarası ve uniqid ile sorgu yapabilmektedir.
> Paket tamamlanmamıştır , geliştirilmektedir.

Kullanımı
====================

> Laravel 5.*

 **Kurmak için :** 
```
composer require brkphp/netgsm
```
- App.php Dosyasına Provider olarak ekleyiniz : 
``` 
Brkphp\Netgsm\NetgsmServiceProvider::class,
```
- App.php Dosyasına Aliases olarak ekleyiniz : 
``` 
'Netgsm' => Brkphp\Netgsm\Facade\Netgsm::class,
```
 
 Ayarları Yayınlamak için : 
```
php artisan vendor:publish 
```

 Ayarları Yapmak için  : 
```
Config/netgsm.php içinde sisteme giriş yaparken kullandığınız bilgileri giriniz.
```

**Bugünün Kayıtlarını çekmek için** 

```
$new = new \Brkphp\Netgsm\Santral();
return $new->dateQuery();
```


>Sadece dateQuery fonkisyonunu çağırırsanız , bugünün kayıtlarını çekecektir.


**Tarih Bazlı Kayıtları çekmek için** 

```
$new = new \Brkphp\Netgsm\Santral();
$new->startDate(250820170000);
$new->stopDate(270820172359);
return $new->dateQuery();
```


>Tarihler date('dmYHi') formatında olmalıdır.


**Telefon Numarası ile Kayıtları çekmek için** 

```
$new = new \Brkphp\Netgsm\Santral();
$new->phone(123456789);
$new->phone(987654321);
return $new->sendQuery();
```


**Uniqid ile Kayıtları çekmek için** 

```
$new = new \Brkphp\Netgsm\Santral();
$new->uniqId(123456789);
$new->uniqId(987654321);
return $new->sendQuery();
```


> Parametreler ile ilgili detaylı bilgi Netgsm Api Dökümanında bulunmaktadır. 
> [Net Gsm Api](https://www.netgsm.com.tr/Dokuman/sanal-santral.asp "Net Gsm Api")
=======
# Netgsm santral paketi

Hakkında
====================

Netgsm Santral geçmiş görüşme raporları laravel paketi

> Sms class'ı yazılmaktadır. santralde tarih , telefon numarası ve uniqid ile sorgu yapabilmektedir.
> Paket tamamlanmamıştır , geliştirilmektedir.

Kullanımı
====================

> Laravel 5.*

 **Kurmak için :** 
```
"brkphp/netgsm" : "1.0.*"
```
- App.php Dosyasına Provider olarak ekleyiniz : 
``` 
Brkphp\Netgsm\NetgsmServiceProvider::class,
```
- App.php Dosyasına Aliases olarak ekleyiniz : 
``` 
'Netgsm' => Brkphp\Netgsm\Facade\Netgsm::class,
```
 
 **Ayarları Yayınlamak için :** 
```
php artisan vendor:publish 
```

 **Ayarları Yapmak için  :** 
```
Config/netgsm.php içinde sisteme giriş yaparken kullandığınız bilgileri giriniz.
```

**Bugünün Kayıtlarını çekmek için** 

```
$new = new \Brkphp\Netgsm\Santral();
return $new->dateQuery();
```


>Sadece dateQuery fonkisyonunu çağırırsanız , bugünün kayıtlarını çekecektir.


**Tarih Bazlı Kayıtları çekmek için** 

```
$new = new \Brkphp\Netgsm\Santral();
$new->startDate(250820170000);
$new->stopDate(270820172359);
return $new->dateQuery();
```


>Tarihler date('dmYHis') formatında olmalıdır.


**Telefon Numarası ile Kayıtları çekmek için** 

```
$new = new \Brkphp\Netgsm\Santral();
$new->phone(123456789);
return $new->sendQuery();
```


**Uniqid ile Kayıtları çekmek için** 

```
$new = new \Brkphp\Netgsm\Santral();
$new->uniqId(123456789);
return $new->sendQuery();
```


> Parametreler ile ilgili detaylı bilgi Netgsm Api Dökümanında bulunmaktadır. 
> [Net Gsm Api](https://www.netgsm.com.tr/Dokuman/sanal-santral.asp "Net Gsm Api")
>>>>>>> Stashed changes
