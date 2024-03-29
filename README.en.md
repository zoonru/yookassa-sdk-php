# The YooKassa API PHP Client Library

[![Build Status](https://img.shields.io/travis/yoomoney/yookassa-sdk-php)](https://travis-ci.org/yoomoney/yookassa-sdk-php)
[![Latest Stable Version](https://img.shields.io/packagist/v/yoomoney/yookassa-sdk-php?label=stable)](https://packagist.org/packages/yoomoney/yookassa-sdk-php)
[![Total Downloads](https://img.shields.io/packagist/dt/yoomoney/yookassa-sdk-php)](https://packagist.org/packages/yoomoney/yookassa-sdk-php)
[![Monthly Downloads](https://img.shields.io/packagist/dm/yoomoney/yookassa-sdk-php)](https://packagist.org/packages/yoomoney/yookassa-sdk-php)
[![License](https://img.shields.io/packagist/l/yoomoney/yookassa-sdk-php)](https://packagist.org/packages/yoomoney/yookassa-sdk-php)

[Russian](README.md) | English

This product is used for managing payments under [The YooKassa API](https://yookassa.ru/en/developers/api)
For usage by those who implemented YooKassa using the API method.

## Requirements
PHP 8.1 (or later version) with the libcurl library

## Installation
### Under console using Composer

1. Install Composer, a package manager.
2. In the console, run the following command:
```bash
composer require zoonru/yookassa-sdk-php
```

### Do the following for the composer.json file of your project:
1. Add a string `"zoonru/yookassa-sdk-php": "^2.6.3"` to the list of dependencies of your project in the composer.json file
```
...
   "require": {
        "php": "^8.1",
        "zoonru/yookassa-sdk-php": "^2.6.3"
...
```
2. Refresh the project's dependencies. In the console, navigate to the catalog with composer.json and run the following command:
```bash
composer update
```
3. Adjust your project's code to activate automated uploading of files for our product:
```php
require __DIR__ . '/vendor/autoload.php';
```

### Manually

1. Download [the YooKassa API PHP Client Library archive](https://git.yoomoney.ru/rest/api/latest/projects/SDK/repos/yookassa-sdk-php/archive?format=zip), extract it and copy the lib catalog to the required place of your project.
2. Adjust your project's code to activate automated uploading of files for our product:
```php
require __DIR__ . '/lib/autoload.php'; 
```

## Commencing work

1. Import required classes
```php
use YooKassa\Client;
```
2. Create a sample of a client object, then set the store's identifier and secret key (you can get them under your YooKassa's Merchant Profile). [Issuing a secret key](https://yookassa.ru/docs/support/merchant/payments/implement/keys?lang=en)
```php
$client = new Client();
$client->setAuth('shopId', 'secretKey');
```
3. Call the required API method. 
   
   [More details in our documentation for the YooKassa API](https://yookassa.ru/en/developers/api#create_payment).

   [More details in our documentation for the YooKassa SDK](docs/readme.md).

## Examples of using the API SDK

#### [YooKassa SDK Settings](docs/examples/01-configuration.md)
* [Authentication](docs/examples/01-configuration.md#Аутентификация)
* [Statistics about the environment used](docs/examples/01-configuration.md#Статистические-данные-об-используемом-окружении)
* [Getting information about the store](docs/examples/01-configuration.md#Получение-информации-о-магазине)
* [Working with Webhook](docs/examples/01-configuration.md#Работа-с-Webhook)
* [Notifications](docs/examples/01-configuration.md#Входящие-уведомления)

#### [Working with payments](docs/examples/02-payments.md)
* [Request to create a payment](docs/examples/02-payments.md#Запрос-на-создание-платежа)
* [Request to create a payment via the builder](docs/examples/02-payments.md#Запрос-на-создание-платежа-через-билдер)
* [Request for partial payment confirmation](docs/examples/02-payments.md#Запрос-на-частичное-подтверждение-платежа)
* [Request to cancel an incomplete payment](docs/examples/02-payments.md#Запрос-на-отмену-незавершенного-платежа)
* [Get payment information](docs/examples/02-payments.md#Получить-информацию-о-платеже)
* [Get a list of payments with filtering](docs/examples/02-payments.md#Получить-список-платежей-с-фильтрацией)

#### [Working with refunds](docs/examples/03-refunds.md)
* [Request to create a refund](docs/examples/03-refunds.md#Запрос-на-создание-возврата)
* [Request to create a refund via the builder](docs/examples/03-refunds.md#Запрос-на-создание-возврата-через-билдер)
* [Get refund information](docs/examples/03-refunds.md#Получить-информацию-о-возврате)
* [Get a list of returns with filtering](docs/examples/03-refunds.md#Получить-список-возвратов-с-фильтрацией)

#### [Working with receipts](docs/examples/04-receipts.md)
* [Request to create a receipt](docs/examples/04-receipts.md#Запрос-на-создание-чека)
* [Request to create a receipt via the builder](docs/examples/04-receipts.md#Запрос-на-создание-чека-через-билдер)
* [Get information about the receipt](docs/examples/04-receipts.md#Получить-информацию-о-чеке)
* [Get a list of receipts with filtering](docs/examples/04-receipts.md#Получить-список-чеков-с-фильтрацией)

#### [Working with safe deals](docs/examples/05-deals.md)
* [Request to create a deal](docs/examples/05-deals.md#Запрос-на-создание-сделки)
* [Request to create a deal via the builder](docs/examples/05-deals.md#Запрос-на-создание-сделки-через-билдер)
* [Request to create a payment with info about deal](docs/examples/05-deals.md#Запрос-на-создание-платежа-с-привязкой-к-сделке)
* [Request to create a payout](docs/examples/05-deals.md#Запрос-на-выплату-продавцу)
* [Get deal information](docs/examples/05-deals.md#Получить-информацию-о-сделке)
* [Get a list of deals with filtering](docs/examples/05-deals.md#Получить-список-сделок-с-фильтрацией)
* [Get payout information](docs/examples/05-deals.md#Получить-информацию-о-выплате)
