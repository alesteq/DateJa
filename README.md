# DateJa

[![Build Status](https://travis-ci.org/alesteq/DateJa.svg?branch=master)](https://travis-ci.org/alesteq/DateJa) [![Maintainability](https://api.codeclimate.com/v1/badges/38c00763b074927d785c/maintainability)](https://codeclimate.com/github/alesteq/DateJa/maintainability) [![Test Coverage](https://api.codeclimate.com/v1/badges/38c00763b074927d785c/test_coverage)](https://codeclimate.com/github/alesteq/DateJa/test_coverage) ![Packagist Pre Release Version](https://img.shields.io/packagist/vpre/alesteq/date-ja.svg) ![PHP from Packagist](https://img.shields.io/packagist/php-v/alesteq/date-ja.svg?color=important) ![GitHub code size in bytes](https://img.shields.io/github/languages/code-size/alesteq/DateJa.svg)

日本の暦と祝日・休日、及びカレンダーを取得するPHPライブラリです。



## Features

- 指定した月の祝日と休日を取得
- 指定日の祝日判定
- 祝日の名称を取得
- 和暦、西暦、月日、曜日を取得
- 元号を取得
  - 明治, 大正, 昭和, 平成, 令和
- 曜日を取得
  - 日, 月, 火, 水, 木, 金, 土
- 旧暦月名を取得
  - 睦月, 如月, 弥生, 卯月, 皐月, 水無月, 文月, 葉月, 長月, 神無月, 霜月, 師走
- 干支を取得
  - 十干
    - 甲, 乙, 丙, 丁, 戊, 己, 庚, 辛, 壬, 癸
  - 十二支
    - 子, 丑, 寅, 卯, 辰, 巳, 午, 未, 申, 酉, 戌, 亥
- 指定月の第n X曜日（e.g. 第２月曜日）の日付を取得
- 月毎のカレンダーの日付情報を取得
- 営業日を取得



## Installation

DateJaライブラリを使用するにあたり、composerによるパッケージのインストールを行います。

```php
composer require alesteq/date-ja
```



## Usage

はじめにautoload.phpを読み込み、ネームスペースを宣言します。

```php
<?php
require_once "vendor/autoload.php";
use Alesteq\DateJa\DateJa;
```

次にDateJaクラスのインスタンスを生成します。

```php
$dateJa = new DateJa();
```

e.g. 指定日が祝日かどうか判定する場合

```php
// 祝日の場合はTRUE、平日の場合はFALSE
$holiday = $dateJa->isHoliday(2019, 5, 1);	// TRUE
```



メソッドの詳細は[リファレンスマニュアルへ]( https://github.com/alesteq/DateJa/docs/README.md)



## License

The MIT License (MIT) 2019 - [Alesteq](https://github.com/alesteq/). Please have a look at the [LICENSE](https://github.com/alesteq/DateJa/blob/master/LICENSE) for more details.