# DateJa Reference

DateJaのリファレンスマニュアルです。



## Overview

DateJaパッケージをautoload.phpで読み込むと、必要なライブラリ・クラスが一括でロードされますので、全てのメソッドはDateJaクラスのインスタンスを生成して使用できます。

```php
<?php
require_once "vendor/autoload.php";
use Alesteq\DateJa\DateJa;
$dateJa = new DateJa();

$dateJa->メソッド名();
```



---

### INDEX

- [Constant](#Constant)
  - [祝日定数](#祝日定数)
  - [曜日定数](#曜日定数))
- [isHoliday](#isHoliday)
- [getHolidayList](#getHolidayList)
- [makeDateArray](#makeDateArray)
- [getCalendar](#getCalendar)
- [getYear](#getYear)
- [getMonth](#getMonth)
- [getDay](#getDay)
- [getEraYear](#getEraYear)
- [getEraName](#getEraName)
- [getWeekName](#getWeekName)
- [getLunarMonth](#getLunarMonth)
- [getHolidayName](#getHolidayName)
- [getZodiac](#getZodizc)
- [getDayByWeekly](#getDayByWeekly)
- [getWorkingDay](#getWorkingDay)



---

### Constant

###### 祝日定数

| constant name                      | value | description              |
| ---------------------------------- | ----- | ------------------------ |
| DJ_NO_HOLIDAY                      | 0     | 平日                     |
| DJ_NEW_YEAR_S_DAY                  | 1     | 元日                     |
| DJ_COMING_OF_AGE_DAY               | 2     | 成人の日                 |
| DJ_NATIONAL_FOUNDATION_DAY         | 3     | 建国記念の日             |
| DJ_THE_SHOWA_EMPEROR_DIED          | 4     | 昭和天皇の大喪の礼       |
| DJ_VERNAL_EQUINOX_DAY              | 5     | 春分の日                 |
| DJ_DAY_OF_SHOWA                    | 6     | 昭和の日                 |
| DJ_GREENERY_DAY                    | 7     | みどりの日               |
| DJ_THE_EMPEROR_S_BIRTHDAY          | 8     | 天皇誕生日               |
| DJ_CROWN_PRINCE_HIROHITO_WEDDING   | 9     | 皇太子明仁親王の結婚の儀 |
| DJ_CONSTITUTION_DAY                | 10    | 憲法記念日               |
| DJ_NATIONAL_HOLIDAY                | 11    | 国民の休日               |
| DJ_CHILDRENS_DAY                   | 12    | こどもの日               |
| DJ_COMPENSATING_HOLIDAY            | 13    | 振替休日                 |
| DJ_CROWN_PRINCE_NARUHITO_WEDDING   | 14    | 皇太子徳仁親王の結婚の儀 |
| DJ_MARINE_DAY                      | 15    | 海の日                   |
| DJ_AUTUMNAL_EQUINOX_DAY            | 16    | 秋分の日                 |
| DJ_RESPECT_FOR_SENIOR_CITIZENS_DAY | 17    | 敬老の日                 |
| DJ_SPORTS_DAY                      | 18    | 体育の日                 |
| DJ_CULTURE_DAY                     | 19    | 文化の日                 |
| DJ_LABOR_THANKSGIVING_DAY          | 20    | 勤労感謝の日             |
| DJ_REGNAL_DAY                      | 21    | 即位礼正殿の儀           |
| DJ_MOUNTAIN_DAY                    | 22    | 山の日                   |
| DJ_EMPEROR_ENTHRONEMENT_DAY        | 23    | 天皇即位の日             |

###### 曜日定数

| constant name | value | description |
| ------------- | ----- | ----------- |
| DJ_SUNDAY     | 0     | 日曜日      |
| DJ_MONDAY     | 1     | 月曜日      |
| DJ_TUESDAY    | 2     | 火曜日      |
| DJ_WEDNESDAY  | 3     | 水曜日      |
| DJ_THURSDAY   | 4     | 木曜日      |
| DJ_FRIDAY     | 5     | 金曜日      |
| DJ_SATURDAY   | 6     | 土曜日      |
| DJ_HOLIDAY    | 7     | 祝日・休日  |





---

### isHoliday

祝日・休日かどうかを判定します。

```php
$result = $dateJa->isHoliday($year, $month, $day);
```

###### parameters

| parameter | type | description |
| --------- | ---- | ----------- |
| year      | int  | 西暦        |
| month     | int  | 月          |
| date      | int  | 日          |

###### return values

日付が祝日の場合に`TURE`、それ以外の場合に`FALSE`を返します。



---

### getHolidayList

指定した月の祝日・休日のリストを取得します。

```php
$result = $dateJa->getHolidayList($timestamp);
```

###### parameters

| parameter | type | description                |
| --------- | ---- | -------------------------- |
| timestamp | int  | 指定する月のタイムスタンプ |

###### return values

祝日・休日の日をキーにした祝日定数の配列を返します。

```php
[
  1 => DJ_EMPEROR_ENTHRONEMENT_DAY,
  2 => DJ_NATIONAL_HOLIDAY,
  3 => DJ_CONSTITUTION_DAY,
  4 => DJ_GREENERY_DAY,
  5 => DJ_CHILDRENS_DAY,
  6 => DJ_COMPENSATING_HOLIDAY,
]
```



---

### makeDateArray

日付の詳細情報を取得します。

```php
$result = $dateJa->makeDateArray($timestamp);
```

###### parameters

| parameter | type | description                          |
| --------- | ---- | ------------------------------------ |
| timestamp | int  | 詳細情報を取得する日のタイムスタンプ |

###### return values

タイムスタンプから、年、月、日、曜日、曜日定数、祝日・休日の配列を返します。

```
[
  "Year"    => 年（西暦）,
  "Month"   => 月,
  "Day"     => 日,
  "Weekname"=> 曜日,
  "Weekday" => 曜日定数,
  "Holiday" => 祝日・休日の日をキーにした祝日定数のハッシュ
]
```



---

### getCalendar

カレンダー情報を取得します。

```php
$result = $dateJa->getCalendar($year, $month);
```

###### parameters

| parameter | type | description |
| --------- | ---- | ----------- |
| year      | int  | 西暦        |
| month     | int  | 月          |

###### return values

指定した年月のカレンダー情報の配列を返します。

```php
[
  [
    "time_stamp" => タイムスタンプ,
    "year"       => 年（西暦）,
    "month"      => 月、二桁の数字（先頭にゼロがつく場合も、01から12）,
    "strday"     => 日、二桁の数字（先頭にゼロがつく場合も、01から31）,
    "day"        => 日,
    "week"       => 曜日定数,
    "holiday"    => 祝日・休日の日をキーにした祝日定数のハッシュ
  ],
  [], ...
]
```



---

### getYear

西暦を取得します。

```php
$result = $dateJa->getYear($timestamp);
```

###### parameters

| parameter | type | description                |
| --------- | ---- | -------------------------- |
| timestamp | int  | 取得する年のタイムスタンプ |

###### return values

タイムスタンプから西暦を`int`型で返します。



---

### getMonth

月を取得します。

```php
$result = $dateJa->getMonth($timestamp);
```

###### parameters

| parameter | type | description                |
| --------- | ---- | -------------------------- |
| timestamp | int  | 取得する月のタイムスタンプ |

###### return values

タイムスタンプから月を`int`型で返します。



---

### getDay

日を取得します。

```php
$result = $dateJa->getDay($timestamp);
```

###### parameters

| parameter | type | description                |
| --------- | ---- | -------------------------- |
| timestamp | int  | 取得する日のタイムスタンプ |

###### return values

タイムスタンプから日を`int`型で返します。



---

### getEraYear

元号の年を取得します。

```php
$result = $dateJa->getEraYear($timestamp);
```

###### parameters

| parameter | type | description                |
| --------- | ---- | -------------------------- |
| timestamp | int  | 取得する年のタイムスタンプ |

###### return values

タイムスタンプから元号の年を`int`型で返します。



---

### getEraName

元号名を取得します。

```php
$result = $dateJa->getEraName($timestamp);
```

###### parameters

| parameter | type | description                  |
| --------- | ---- | ---------------------------- |
| timestamp | int  | 取得する元号のタイムスタンプ |

###### return values

タイムスタンプから元号名を`string`型で返します。



---

### getWeekName

曜日を取得します。

```php
$result = $dateJa->getWeekName($timestamp);
```

###### parameters

| parameter | type | description                  |
| --------- | ---- | ---------------------------- |
| timestamp | int  | 取得する曜日のタイムスタンプ |

###### return values

タイムスタンプから曜日を`string`型で返します。



---

### getLunarMonth

旧暦月名を返します。

```php
$result = $dateJa->getLunarMonth($month);
```

###### parameters

| parameter | type | description |
| --------- | ---- | ----------- |
| month     | int  | 月          |

###### return values

指定した月に対応する旧暦の月名を`string`型で返します。



---

### getHolidayName

祝日名を取得します。

```php
$result = $dateJa->getHolidayName($holiday);
```

###### parameters

| parameter | type | description           |
| --------- | ---- | --------------------- |
| holiday   | int  | [祝日定数](#祝日定数) |

###### return values

祝日定数に対応する祝日名を`string`型で返します。



---

### getZodiac

十干と十二支からなる年の干支を取得します。（e,g, 丙午）

```php
$result = $dateJa->getZodiac($timestamp);
```

###### parameters

| parameter | type | description                      |
| --------- | ---- | -------------------------------- |
| timestamp | int  | 取得する干支の年のタイムスタンプ |

###### return values

タイムスタンプから干支を`string`型で返します。



---

### getDayByWeekly

第n X曜日の日を取得します。（e.g. 第２月曜日は）

```php
$result = $dateJa->isHoliday($year, $month, $weekly, $cnt);

// e,g, 2019年5月の第２月曜日は
$result = $dateJa->isHoliday(2019, 5, 1, 2);	// $result is 13.
```

###### parameters

| parameter | type | description                     |
| --------- | ---- | ------------------------------- |
| year      | int  | 西暦                            |
| month     | int  | 月                              |
| weekly    | int  | [曜日定数](#曜日定数)（0 〜 6） |
| cnt       | int  | 何番目かを指定                  |

###### return values

指定した曜日の日を返します。該当する日が無い場合は0を返します。



---

### getWorkingDay

稼働日数を指定して営業日を取得します。

```php
$result = $dateJa->getWorkingDay($timestamp, $days, $closed_week=[], $closed_date=[]);
```

###### parameters

| parameter   | type  | description                                                  | require |
| ----------- | ----- | ------------------------------------------------------------ | :-----: |
| timestamp   | int   | 計算開始日のタイムスタンプ                                   |    ◯    |
| days        | int   | 稼働日数（マイナス指定も可）                                 |    ◯    |
| closed_week | array | 休日とする曜日を[曜日定数](#曜日定数)で指定（e.g. 土日祝を休業 [0, 6, 7]） |         |
| closed_date | array | 休業とする日付を指定（e.g. ['2019-5-7', '2019-5-8']）        |         |

###### return values

営業日の詳細情報の配列を返します。

```php
[
  [
    "Year"    => 年（西暦）,
    "Month"   => 月,
    "Day"     => 日,
    "Weekname"=> 曜日,
    "Weekday" => 曜日定数,
    "Holiday" => 祝日・休日の日をキーにした祝日定数のハッシュ
  ],
  [], ...
]
```



---