<?php
/**
 * 日付操作ユーティリティ
 */
declare(strict_types=1);
namespace Alesteq\DateJa;
use \Exception;
use \Throwable;

date_default_timezone_set('Asia/Tokyo');

/**
 * 祝日定数
 */
define("DJ_NO_HOLIDAY", 0);
define("DJ_NEW_YEAR_S_DAY", 1);
define("DJ_COMING_OF_AGE_DAY", 2);
define("DJ_NATIONAL_FOUNDATION_DAY", 3);
define("DJ_THE_SHOWA_EMPEROR_DIED", 4);
define("DJ_VERNAL_EQUINOX_DAY", 5);
define("DJ_DAY_OF_SHOWA", 6);
define("DJ_GREENERY_DAY", 7);
define("DJ_THE_EMPEROR_S_BIRTHDAY", 8);
define("DJ_CROWN_PRINCE_HIROHITO_WEDDING", 9);
define("DJ_CONSTITUTION_DAY", 10);
define("DJ_NATIONAL_HOLIDAY", 11);
define("DJ_CHILDRENS_DAY", 12);
define("DJ_COMPENSATING_HOLIDAY", 13);
define("DJ_CROWN_PRINCE_NARUHITO_WEDDING", 14);
define("DJ_MARINE_DAY", 15);
define("DJ_AUTUMNAL_EQUINOX_DAY", 16);
define("DJ_RESPECT_FOR_SENIOR_CITIZENS_DAY", 17);
define("DJ_SPORTS_DAY", 18);
define("DJ_CULTURE_DAY", 19);
define("DJ_LABOR_THANKSGIVING_DAY", 20);
define("DJ_REGNAL_DAY", 21);
define("DJ_MOUNTAIN_DAY", 22);
define("DJ_EMPEROR_ENTHRONEMENT_DAY", 23);

/**
 * 特定月定数
 */
define("DJ_VERNAL_EQUINOX_DAY_MONTH", 3);
define("DJ_AUTUMNAL_EQUINOX_DAY_MONTH", 9);

/**
 * 曜日定数
 */
define("DJ_SUNDAY", 0);
define("DJ_MONDAY", 1);
define("DJ_TUESDAY", 2);
define("DJ_WEDNESDAY", 3);
define("DJ_THURSDAY", 4);
define("DJ_FRIDAY", 5);
define("DJ_SATURDAY", 6);
define("DJ_Holiday", 7);

class DateUtil
{
	private $_holiday_name = [
		0 => "",
		1 => "元日",
		2 => "成人の日",
		3 => "建国記念の日",
		4 => "昭和天皇の大喪の礼",
		5 => "春分の日",
		6 => "昭和の日",
		7 => "みどりの日",
		8 => "天皇誕生日",
		9 => "皇太子明仁親王の結婚の儀",
		10 => "憲法記念日",
		11 => "国民の休日",
		12 => "こどもの日",
		13 => "振替休日",
		14 => "皇太子徳仁親王の結婚の儀",
		15 => "海の日",
		16 => "秋分の日",
		17 => "敬老の日",
		18 => "体育の日",
		19 => "文化の日",
		20 => "勤労感謝の日",
		21 => "即位礼正殿の儀",
		22 => "山の日",
		23 => "天皇即位の日",
	];
	private $_weekday_name = ["日", "月", "火", "水", "木", "金", "土"];
	private $_lunar_month_name = ["", "睦月", "如月", "弥生", "卯月", "皐月", "水無月", "文月", "葉月", "長月", "神無月", "霜月", "師走"];
	private $_six_weekday = ["大安", "赤口", "先勝", "友引", "先負", "仏滅"];
	private $_twelve_horary_signs = ["申", "酉", "戌", "亥", "子", "丑", "寅", "卯", "辰", "巳", "午", "未"];
	private $_celestial_stems = ["庚", "辛", "壬", "癸", "甲", "乙", "丙", "丁", "戊", "己"];
	private $_era_name = [
		"0" => "",
		"1868" => "明治",
		"1912" => "大正",
		"1926" => "昭和",
		"1989" => "平成",
		"2019" => "令和",
	];
	private $_equinox = [
		3 => [
			2150 => 21.851,	// interim
			2099 => 21.851,
			1979 => 20.8431,
			1899 => 20.8357,
			1850 => 19.8277,
			0 => 19.8277,	// interim
		],
		9 => [
			2150 => 24.2488,	// interim
			2099 => 24.2488,
			1979 => 23.2488,
			1899 => 23.2588,
			1850 => 22.2588,
			1 => 22.2588,	// interim
		]
	];

	public function __construct()
	{}
	
	/**
	 * 元号元年の西暦を返す
	 *
	 * @param {int} time_stamp タイムスタンプ
	 * @return {int}
	 */
	public function getEraNewYear(int $time_stamp): int
	{
		$r = 0;	// 一世一元の制より前
		
		// 令和
		if (mktime(0, 0, 0, 5 ,1, 2019) <= $time_stamp) $r = 2019;
		
		// 平成
		if (mktime(0, 0, 0, 1, 8, 1989) <= $time_stamp && mktime(0, 0, 0, 5 ,1, 2019) > $time_stamp) {
			$r = 1989;
		}
		
		// 昭和
		if (mktime(0, 0, 0, 12, 25, 1926) <= $time_stamp && mktime(0, 0, 0, 1, 8, 1989) > $time_stamp) {
			$r = 1926;
		}
		
		// 大正
		if (mktime(0, 0, 0, 7, 30, 1912) <= $time_stamp && mktime(0, 0, 0, 12, 25, 1926) > $time_stamp) {
			$r = 1912;
		}
		
		// 明治
		if (mktime(0, 0, 0, 1, 25, 1868) <= $time_stamp && mktime(0, 0, 0, 7, 30, 1912) > $time_stamp) {
			$r = 1868;
		}
		
		return $r;
	}

	/**
	 * 元号を返す
	 *
	 * @param {int} time_stamp タイムスタンプ
	 * @return {string}
	 */
	public function getEraName(int $time_stamp): string
	{
		return $this->_era_name[$this->getEraNewYear($time_stamp)];
	}

	/**
	 * 和暦を返す
	 * 元号対応以前（明治より前）は西暦を返す
	 *
	 * @param {int} time_stamp タイムスタンプ
	 * @return {int}
	 */
	public function getEraYear(int $time_stamp): int
	{
		$year = $this->getEraNewYear($time_stamp);
		$year = empty($year) ?: --$year;

		return $this->getYear($time_stamp) - $year;
	}

	/**
	 * 西暦を数値化して返す
	 *
	 * @param {int} time_stamp タイムスタンプ
	 * @return {int}
	 */
	public function getYear(int $time_stamp): int
	{
		return (int)date("Y", $time_stamp);
	}

	/**
	 * 月を数値化して返す
	 *
	 * @param {int} time_stamp タイムスタンプ
	 * @return {int}
	 */
	public function getMonth(int $time_stamp): int
	{
		return (int)date("n", $time_stamp);
	}

	/**
	 * 日を数値化して返す
	 *
	 * @param {int} time_stamp タイムスタンプ
	 * @return {int}
	 */
	public function getDay(int $time_stamp): int
	{
		return (int)date("j", $time_stamp);
	}

	/**
	 * 休日名を返す
	 *
	 * @param {int} key 休日定数
	 * @return {string}
	 */
	public function getHolidayName(int $key): string
	{
		return $this->_holiday_name[$key];
	}

	/**
	 * 七曜を数値化して返す
	 *
	 * @param {int} time_stamp タイムスタンプ
	 * @return {int} 0:日, 1:月, 2:火, 3:水, 4:木, 5:金, 6:土
	 */
	public function getWeekday(int $time_stamp): int
	{
		return (int)date("w", $time_stamp);
	}

	/**
	 * 曜日名を返す
	 *
	 * @param {int} time_stamp タイムスタンプ
	 * @return {string}
	 */
	public function getWeekName(int $time_stamp): string
	{
		return $this->_weekday_name[(int)date("w", $time_stamp)];
	}

	/**
	 * 旧暦月名を返す
	 *
	 * @param {int} key 月
	 * @return {string}
	 */
	public function getLunarMonth(int $month): string
	{
		return $this->_lunar_month_name[$month];
	}

	/**
	 * 六曜名を返す
	 *
	 * @param {int} key 六曜キー
	 * @return {string}
	 */
	public function getSixWeekday(int $key): string
	{
		return array_key_exists($key, $this->_six_weekday) ? $this->_six_weekday[$key] : "";
	}

	/**
	 * 十干を返す
	 *
	 * @param {int} time_stamp タイムスタンプ
	 * @return {string}
	 */
	public function getCelestialStems(int $time_stamp): string
	{
		$idx = $this->getYear($time_stamp) % 10;
		return $this->_celestial_stems[$idx];
	}

	/**
	 * 十二支を返す
	 *
	 * @param {int} time_stamp タイムスタンプ
	 * @return {string}
	 */
	public function getTwelveHorarySigns(int $time_stamp): string
	{
		$idx = $this->getYear($time_stamp) % 12;
		return $this->_twelve_horary_signs[$idx];
	}

	/**
	 * 干支を返す
	 *
	 * @param {int} time_stamp タイムスタンプ
	 * @return {string}
	 */
	public function getZodiac(int $time_stamp): string
	{
		
		return $this->getCelestialStems($time_stamp) . $this->getTwelveHorarySigns($time_stamp);
	}

	/**
	 * ハッピーマンデーの判定
	 *
	 * @param {int} year
	 * @param {int} month
	 * @return {array} ハッピーマンデーがある場合にその日付と祝日名のハッシュを返す、ない場合は[]を返す
	 */
	public function getHappyMonday(int $year, int $month): array
	{
		$res = [];
		$holiday_name_2000 = [
			1 => DJ_COMING_OF_AGE_DAY,
			10 => DJ_SPORTS_DAY,
		];
		$holiday_name_2003 = [
			7 => DJ_MARINE_DAY,
			9 => DJ_RESPECT_FOR_SENIOR_CITIZENS_DAY,
		];
		
		if ($year >= 2000 && array_key_exists($month, $holiday_name_2000)) {
			$second_monday = $this->getDayByWeekly($year, $month, DJ_MONDAY, 2);
			$res[$second_monday] = $holiday_name_2000[$month];
		}
		
		if ($year >= 2003 && array_key_exists($month, $holiday_name_2003)) {
			$third_monday = $this->getDayByWeekly($year, $month, DJ_MONDAY, 3);
			$res[$third_monday] = $holiday_name_2003[$month];
		}
		
		return $res;
	}

	/**
	 * 振替休日の判定
	 *
	 * @param {int} time_stamp  判定を行う日のタイムスタンプ
	 * @param {array} holidays  振替休日の場合に追加する祝日の配列
	 * @param {int} addition  何日後に振替休日にするか指定 (optional)
	 * @raturn {array} 振替休日になる場合に{@code $holidays}に追加して返す
	 */
	public function getCompensatory(int $time_stamp, array $holidays, int $addition = 1): array
	{
		if ($this->getWeekDay($time_stamp) == DJ_SUNDAY) {
			$day = $this->getDay($time_stamp) + $addition;
			$holidays[$day] = DJ_COMPENSATING_HOLIDAY;
		}
		
		return $holidays;
	}

	/**
	 * 春分秋分の日を返す（1851〜2150 の間の予測）
	 * 前年2/1に官報に掲載される暦要項（国立天文台が発表）による
	 *
	 * @param {int} time_stamp
	 * @return {int} 春分若しくは秋分の日のタイムスタンプ、どちらでもない場合は0を返す
	 */
	public function getEquinoxDay(int $time_stamp): int
	{
		$year = $this->getYear($time_stamp);
		$month = $this->getMonth($time_stamp);
		if (!array_key_exists($month, $this->_equinox)) return 0;
		
		foreach ($this->_equinox[$month] as $start => $val) {
			if ($start < $year) {
				$adj = $val;
				break;
			}
		}
		
		$day = floor($adj + (0.242194 * ($year - 1980)) - floor(($year - 1980) / 4));

		return mktime(0, 0, 0, $month, (int)$day, $year);
	}

	/**
	 * 指定月の第n X曜日（e.g. 第３月曜日）の日付を取得
	 *
	 * @param {int} year 年
	 * @param {int} month 月
	 * @param {int} weekly 曜日
	 * @param {int} cnt 第×か
	 * @return {int} 該当する日が当該月にない場合は0を返す
	 */
	public function getDayByWeekly(int $year, int $month, int $weekly, int $cnt = 1): int
	{
		try {
			if ($cnt < 1) throw new Exception();
			$ary = array(1,2,3,4,5,6,7,1,2,3,4,5,6,);
			$start = 6 - $weekly;
			for ($i = 0, $idx = $start; $i < 7; $i++, $idx++) {
				$map[] = $ary[$idx];
			}
			$cnt = 7 * $cnt + 1;
			$r = $cnt - $map[$this->getWeekday(mktime(0, 0, 0, $month, 1, $year))];
			$lim = (int)date("t", mktime(0, 0, 0, $month, 1, $year));
			if ($r > $lim) throw new Exception();
		} catch (Throwable $t) {
			$r = 0;
		}
		
		return $r;
	}
	
}
?>