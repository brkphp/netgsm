<?php
    return [
        /*
         * Dil Ayarı , gönderilen smslerde mesajlara türkçe karakter eklensin
         */

        "tr" => false,

        /*
         * Santral Api Url
         */
        "santral_api_url" => "https://api.netgsm.com.tr/santral/rapor",

        /*
         * Sms Api Url
         */
        "sms_api_url" => "https://api.netgsm.com.tr/xmlbulkhttppost.asp",

        /*
         * Netgsm onaylı başlığınız. Eğer mesaj başlığınızın abone numaranızın olmasını istiyorsanız, bu ayara abone numaranızı yazınız.
         */
        "title" => "",

        /*
         * Netgsm paneline girerken kullandığımız kullanıcı adı ve şifreyi giriniz
         */
        "username" =>  "",
        "password" => "",

        /*
         * Santral Arama süreleri boş ise göster
         */
        'check_duration' => false,

        /*
         * Ses Dosyası Olmayanları Göster
         */
        'check_file' => false,
    ];