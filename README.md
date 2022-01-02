# MirHamit/PodBankService

[![Latest Version on Packagist](https://img.shields.io/packagist/v/vendor_slug/package_slug.svg?style=flat-square)](https://packagist.org/packages/mirhamit/pod-bank-service)
[![Total Downloads](https://img.shields.io/packagist/dt/vendor_slug/package_slug.svg?style=flat-square)](https://packagist.org/packages/mirhamit/pod-bank-service)

---
این پکیج برای استفاده از سرویس بانکی پاد در لاراول تهیه شده است، شما میتوانید مستندات کامل را از وبسایت پادیوم دریافت
کنید

استفاده از این پکیج بلامانع است، اما به دلیل حساسیت بالای تراکنش ها و انتقال وجه، منتشر کننده این پکیج هیچ گونه مسئولیتی در قبال مسائل مربوطه ندارد.


[راهنمای کلی سرویس](https://podium.ir/services/3292395/%D8%B3%D8%B1%D9%88%DB%8C%D8%B3-%D9%87%D8%A7%DB%8C-%D8%A8%D8%A7%D9%86%DA%A9%DB%8C/document)

## نصب

نصب لاراول

```bash
laravel new laravel-pod-bank-service-package
cd laravel-pod-bank-service-package
```

نصب پکیج

```bash
composer require mirhamit/pod-bank-service
```

## راه اندازی و تنظیمات

استخراج فایل کانفیگ و اضافه کردن رمز عبور و کلید دسترسی و دیگر موارد مورد نیاز پکیج و وب سرویس پادیوم در فایل کانفیگ

```bash
php artisan vendor:publish --tag=pod-config
```

و اگه به هر دلیلی دوست نداشتین رمز عبور و ... رو توی فایل کانفیگ بزارین میتونین به صورت دستی کلید های مورد نیاز رو در
فایل

.env

موجود بزارین و موارد مورد نیاز رو جایگزین کنین

```bash
pod_UserName="نام کاربری که از بانک دریافت کرده‌اید"
pod_DepositNumber="شماره حسابی که به بانک معرفی کرده‌اید"
pod_Sheba="شماره شبای حسابی که به بانک معرفی کرده‌اید"
pod_token="کلیدی که از قسمت ورود یکپارچه لیست کلیدها یا کلید جدید دریافت میکنید"

# کلیدهایی که طبق راهنمای موجود در بالای همین صفحه و وبسایت پادیوم دریافت میکنین

pod_scApiKeyEstelamSheba="سپرده / استعلام - اطلاعات شبا"
pod_scApiKeyMojudi="سپرده - موجودی حساب"
pod_scApiKeyEnteghalPaya="سپرده - انتقال وجه - ( داخلی و پایا )"
pod_scApiKeySuratHesab="سرویس صورتحساب و وضعیت انتقال"

pod_scProductIdEstelamSheba=1115396
pod_scProductIdMojudi=1077449
pod_scProductIdEnteghalPaya=1076566
pod_scProductIdSuratHesab=1077467
```

---

## استفاده

[راهنمایی](https://podium.ir/services/3292395/%D8%B3%D8%B1%D9%88%DB%8C%D8%B3-%D9%87%D8%A7%DB%8C-%D8%A8%D8%A7%D9%86%DA%A9%DB%8C/document)


###سرویس دریافت اطلاعات شماره شبا (همه ی بانکها)
شناسه سرویس : 1115396

```php
use MirHamit\PodBankService\Services\SavingAccount;

$account = new SavingAccount();
return $account->estelamSheba($sheba, $paymentId);
```


###سرویس دریافت موجودی حساب
شناسه سرویس : 1077449

```php
use MirHamit\PodBankService\Services\SavingAccount;

$account = new SavingAccount();
return $account->mojudi()
```


###سرویس دریافت صورتحساب حساب
شناسه سرویس : 1077467

```php
use MirHamit\PodBankService\Services\SavingAccount;

$account = new SavingAccount();
return $account->suratHesab($fromDate, $toDate, $fromHour, $toHour, $resultCount);
```

###سرویس انتقال وجه پایا بین بانکی ( با قابلیت انجام انتقال وجه داخلی بانک پاسارگاد )
شناسه سرویس : 1076566

```php
use MirHamit\PodBankService\Services\SavingAccount;

$account = new SavingAccount();

return $account->enteghalVajhPaya(
        1000,
        'IR200610000000700813563379',
        'نام و نام خانوادگی',
        '1400/10/11', //تاریخ
        'شرح انتقال',
        'شرح مقصد',
        '123123123123', //شناسه‌ی واریز
        '' //شناسه یکتای تراکنش
    );
```

## خروجی توابع

نمونه خروجی یکی از توابع در زیر آمده است که در صورت نیاز به راهنمایی بیشتر میتوانید به راهنمای ذکر شده در بالای این صفحه
رجوع کنید


---

## Tests

```text
As Soon As Possible
```

---

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

---

## Security Vulnerabilities

Please review and check security vulnerabilities and report them in issues section.

---

## Credits

- [Həmid Musəvi](https://github.com/mirhamit)
- [All Contributors](../../contributors)

---

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
