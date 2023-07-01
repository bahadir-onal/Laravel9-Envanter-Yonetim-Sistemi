# Laravel Envanter Yönetim Sistemi

Bu proje, Laravel 9 kullanılarak geliştirilmiş bir envanter yönetim sistemi örneğidir. Proje, envanter takibi yapmak ve envanterdeki ürünleri yönetmek için tasarlanmıştır.

Bu projenin amacı, işletmelerin envanter yönetim süreçlerini basitleştirmek ve verimliliği artırmaktır. Laravel'in güçlü özelliklerini kullanarak, kullanıcı dostu bir arayüzle envanter takibi yapmayı mümkün kılmaktadır.

Projenin geliştirilmesi devam etmektedir ve yeni özelliklerin eklenmesi ve iyileştirmelerin yapılması planlanmaktadır. Herhangi bir katkı veya öneriye açığız.

## Özellikler

-   Kullanıcılar, envanterdeki ürünleri görüntüleyebilir, ekleme yapabilir, düzenleyebilir ve silebilir.
-   Ürünler kategorilere ayrılabilir ve kategori bazında filtreleme yapılabilir.
-   Kullanıcılar, envanter hareketlerini (ürün alımları, satışları vb.) kaydedebilir ve raporlarını alabilir.

## Kurulum

1.  Bu projeyi yerel makinenize klonlayın veya ZIP dosyası olarak indirin.
2.  Proje klasörüne gidin ve terminalde aşağıdaki komutu çalıştırın:

	`composer install` 

3.  `.env.example` dosyasının adını `.env` olarak değiştirin ve veritabanı bağlantı bilgilerinizi girin.
4.  Terminalde aşağıdaki komutu çalıştırarak veritabanını oluşturun:

	`php artisan migrate -seed` 

5.  Projeyi çalıştırmak için aşağıdaki komutu kullanın:

	   php artisan serve

6.  Tarayıcınızda `http://localhost:8000` adresine gidin ve uygulamayı kullanmaya başlayın.

## İletişim

bahadironal3@gmail.com
