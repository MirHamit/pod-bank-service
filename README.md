# MirHamit/PodBankService

[![Latest Version on Packagist](https://img.shields.io/packagist/v/vendor_slug/package_slug.svg?style=flat-square)](https://packagist.org/packages/mirhamit/pod-bank-service)
[![Total Downloads](https://img.shields.io/packagist/dt/vendor_slug/package_slug.svg?style=flat-square)](https://packagist.org/packages/mirhamit/pod-bank-service)

---
این پکیج برای استفاده از سرویس بانکی پاد در لاراول تهیه شده است، شما میتوانید مستندات کامل را از وبسایت پادیوم دریافت
کنید

[راهنمای کلی سرویس](https://podium.ir/services/2974845/%D8%B3%D8%B1%D9%88%DB%8C%D8%B3%E2%80%8C%D9%87%D8%A7%DB%8C%20%D8%A8%D8%A7%D9%86%DA%A9%20%D9%BE%D8%A7%D8%B3%D8%A7%D8%B1%DA%AF%D8%A7%D8%AF)

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
# کلیدهایی که از قسمت میز کار سرویس گیرنده میگیرید
pod_scApiKeyEstelamSheba="سپرده / استعلام - اطلاعات شبا"
pod_scApiKeyMojudi="سپرده - موجودی حساب"
pod_scApiKeyShebaToSeporde="پاسارگاد - سپرده / تبدیل - شبا به شماره سپرده"
pod_scApiKeyPasargadToSheba="پاسارگاد - سپرده / تبدیل - شماره سپرده به شبا"
pod_scApiKeyEstelamHesabPasargad="سپرده / استعلام - اطلاعات سپرده ( شخص و سایرین )"
pod_scApiKeyEnteghalPaya="سپرده - انتقال وجه - ( داخلی و پایا )"
pod_scApiKeyEnteghalSatna="سپرده - انتقال وجه - ( داخلی و ساتنا )"
pod_scApiKeyEnteghalVajhPayaGuruhi="سپرده - انتقال وجه - گروهی/دسته ای ( داخلی و پایا )"
pod_scApiKeyEstelamEnteghal="سپرده - وضعیت انتقال وجه"
pod_scApiKeyPayBill="سپرده - پرداخت قبض از طریق سپرده"

pod_scProductIdEstelamSheba=437012
pod_scProductIdMojudi=434002
pod_scProductIdShebaToSeporde=671932
pod_scProductIdPasargadToSheba=671929
pod_scProductIdEstelamHesabPasargad=671933
pod_scProductIdEnteghalPaya=445929
pod_scProductIdEnteghalSatna=465435
pod_scProductIdEnteghalVajhPayaGuruhi=440226
pod_scProductIdEstelamEnteghal=487396
pod_scProductIdPayBill=487397
```

---

## استفاده

[راهنمایی](https://podium.ir/services/2974845/%D8%B3%D8%B1%D9%88%DB%8C%D8%B3%E2%80%8C%D9%87%D8%A7%DB%8C%20%D8%A8%D8%A7%D9%86%DA%A9%20%D9%BE%D8%A7%D8%B3%D8%A7%D8%B1%DA%AF%D8%A7%D8%AF)

ورودی آخر همه توابع به صورت

true یا false

میباشد که عنوان میکند خروجی به دست آمده از سمت بانک به صورت

json

نیز تحلیل شده و در

bankData

ذکر شود یا نه، این پارامتر در صورت اضافه نشدن به صورت پیشفرض true خواهد بود.

---

###سرویس دریافت اطلاعات شماره شبا (همه ی بانکها)
شناسه سرویس : 437012

```php
use MirHamit\PodBankService\Services\SavingAccount;

$account = new SavingAccount();
return $account->estelamSheba($sheba, true)
```


###سرویس دریافت موجودی حساب
شناسه سرویس : 434002

```php
use MirHamit\PodBankService\Services\SavingAccount;

$account = new SavingAccount();
return $account->mojudi(true)
```

###سرویس تبدیل شبا بانک پاسارگاد ، به شماره سپرده
شناسه سرویس : 671932

```php
use MirHamit\PodBankService\Services\SavingAccount;

$account = new SavingAccount();
return $account->shebaToSeporde($sheba, true);
```

###سرویس تبدیل شماره سپرده پاسارگاد به شماره شبا
شناسه سرویس : 671929

```php
use MirHamit\PodBankService\Services\SavingAccount;

$account = new SavingAccount();
return $account->pasargadToSheba($shomareHesab);
```

###استعلام اطلاعات سپرده اشخاص در بانک پاسارگاد
شناسه سرویس : 671933

```php
use MirHamit\PodBankService\Services\SavingAccount;

$account = new SavingAccount();
return $account->estelamHesabPasargad($shomareHesab);
```

###سرویس انتقال وجه پایا بین بانکی ( با قابلیت انجام انتقال وجه داخلی بانک پاسارگاد )
شناسه سرویس : 445929

```php
use MirHamit\PodBankService\Services\SavingAccount;

$account = new SavingAccount();

return $account->enteghalVajhPaya(
        'IR*',
        'کد علت انتقال برای ثبت در بانک مرکزی طبق جدول',
        'نام دریافت کننده',
        'نام خانوادگی دریافت کننده',
        'مبلغ',
        'شرح مبدا',
        'شرح مقصد',
        'شناسه یکتا',
        ,'شماره حساب پاسارگاد ـ اختیاری'
        true);
```


###سرویس انتقال وجه ساتنا بین بانکی ( با قابلیت انجام انتقال وجه داخلی بانک پاسارگاد )
شناسه سرویس : 465435

```php
use MirHamit\PodBankService\Services\SavingAccount;

$account = new SavingAccount();
return $account->enteghalVajhSatna(
    'IR*',
    '16',
    'نام گیرنده',
    'نام خانوادگی گیرنده',
    'مبلغ',
    'شرح مبدا',
    'شرح مقصد',
    'شماره یکتا',
    'شماره حساب پاسارگاد ـ اختیاری',
    'کد بانک مقصد ـ اختیاری',
    true
);
```

###- سرویس انتقال وجه پایا گروهی / دسته ای بین بانکی ( با قابلیت انجام انتقال وجه داخلی بانک پاسارگاد )
شناسه سرویس : 440226

```php
use MirHamit\PodBankService\Services\SavingAccount;

$data = (object) [];
    $data->FileUniqueIdentifier = "ACHDepositNumber1";
    $data->TransferMoneyBillNumber = 1;
    $data->CentralBankTransferDetailType = 16;
    $data->BatchPayaItemInfos = [
        [
            "Amount"              => 1000, // rial
            "BeneficiaryFullName" => "نام کامل گیرنده",
            "Description"         => "شرح برای تراکنش",
            "DestShebaNumber"     => "شماره شبا گیرنده",
            "BillNumber"          => "شماره پیگیری"
        ],
    ];
    $data->Timestamp = date('Y/m/d H:i:s:B');
    
    $account = new SavingAccount();
    return $account->enteghalVajhPayaGuruhi($data);
```

###سرویس دریافت وضعیت انتقال وجه
شناسه سرویس : 487396

```php
use MirHamit\PodBankService\Services\SavingAccount;

$account = new SavingAccount();
return $account->estelamEnteghal($paymentId, $year, $month, $date);
```

###سرویس پرداخت قبض از طریق سپرده
شناسه سرویس : 487397

```php
use MirHamit\PodBankService\Services\SavingAccount;

    $account = new SavingAccount();
    return $account->payBill('shenaseGhabz', 'shenasePardakht');
```


## خروجی توابع

نمونه خروجی یکی از توابع در زیر آمده است که در صورت نیاز به راهنمایی بیشتر میتوانید به راهنمای ذکر شده در بالای این صفحه
رجوع کنید

```json
{
"data": {
    "hasError": false,
    "messageId": 0,
    "referenceNumber": "2751164124",
    "errorCode": 0,
    "count": 0,
    "ott": "e294359f23475729",
    "result": {
        "result": "<?xml version=\"1.0\" encoding=\"utf-8\"?><soap:Envelope xmlns:
        soap=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:
        xsd=\"http://www.w3.org/2001/XMLSchema\"><soap:Body><GetShebaInfoResponse
        xmlns=\"http://ibank.toranj.fanap.co.ir/UserServices\"><GetShebaInfoResult>{\"IsSuccess\":true,\"Message\":\"استعلام
        شماره شبا با موفقیت انجام شد.\",\"Data\":{\"Sheba\":\"IR*
        \",\"AccountOwners\":[{\"FirstName\":\"نام صاحب حساب\",\"LastName\":\"نام خانوادگی صاحب حساب\"}],\"AccountStatus\":
        \"02\",\"AccountStatusName\":\"حساب فعال است.\"},\"MessageCode\":16000,\"ErrorCode\":
        16000
    },
    </GetShebaInfoResult></GetShebaInfoResponse></soap:Body></soap:Envelope>",
    "header": {
        "X-Frame-Options": "SAMEORIGIN",
        "Strict-Transport-Security": "max-age=15552000",
        "Cache-Control": "private, max-age=0",
        "Server": "",
        "X-Content-Type-Options": "nosniff",
        "Set-Cookie": "cookiesession1=678B286BRSUVWXYZABCDEFGHIJKL556B;Expires=Thu, 17 Nov 2022 14:33:16 GMT;Path=/;HttpOnly",
        "X-XSS-Protection": "1",
        "Date": "Wed, 17 Nov 2021 18:03:08 GMT",
        "Content-Type": "text/xml; charset=utf-8"
    },
    "statusCode": 200
    }
},

"bankData": {
    "IsSuccess": true,
    "Message": "استعلام شماره شبا با موفقیت انجام شد.",
    "Data": {
        "Sheba": "IR*",
        "AccountOwners": [
            {
            "FirstName": "نام صاحب حساب",
            "LastName": "نام خانوادگی صاحب حساب"
            }
        ],
        "AccountStatus": "02",
        "AccountStatusName": "حساب فعال است."
    },
    "MessageCode": 16000,
    "ErrorCode": 16000 
} 
}
```


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
