<?php
/**
 * 日付操作ユーティリティ
 */
declare(strict_types=1);
namespace Alesteq\DateJa;

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
define("DJ_CHILDREN_S_DAY", 12);
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

class DateUtil
{
	private $_holiday_name = array(
		0 => "",
		1 => "元旦",
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
	);
	private $_weekday_name = array("日", "月", "火", "水", "木", "金", "土");
	private $_month_name = array("", "睦月", "如月", "弥生", "卯月", "皐月", "水無月", "文月", "葉月", "長月", "神無月", "霜月", "師走");
	private $_six_weekday = array("大安", "赤口", "先勝", "友引", "先負", "仏滅");
	private $_oriental_zodiac = array("亥", "子", "丑", "寅", "卯", "辰", "巳", "午", "未", "申", "酉", "戌");
	private $_era_name = array("", "明治", "大正", "昭和", "平成", "令和");
	private $_era_calc = array(0, 1867, 1911, 1925, 1988, 2018);

	public function __construct()
	{}
	
	/**
	 * 元号キーを返す
	 *
	 * @param {int} time_stamp タイムスタンプ
	 * @return {int}
	 */
	public function getEraName(int $time_stamp): int
	{
		if (mktime(0, 0, 0, 1, 25, 1868) > $time_stamp) {
			return 0;	// 一世一元の制より前
		} else if (mktime(0, 0, 0, 7, 30, 1912) > $time_stamp) {
			return 1;	// 明治
		} else if (mktime(0, 0, 0, 12, 25, 1926) > $time_stamp) {
			return 2;	// 大正
		} else if (mktime(0, 0, 0, 1, 8, 1989) > $time_stamp) {
			return 3;	// 昭和
		} else if (mktime(0, 0, 0, 5 ,1, 2019) > $time_stamp) {
			return 4;	// 平成
		} else {
			return 5;	// 令和
		}
	}

	/**
	 * 元号を返す
	 *
	 * @param {int} key 元号キー
	 * @return {string}
	 */
	public function viewEraName(int $key): string
	{
		return $this->_era_name[$key];
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
		$key = $this->getEraName($time_stamp);

		return $this->getYear($time_stamp)-$this->_era_calc[$key];
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
	 * @param {int} key 休日キー
	 * @return {string}
	 */
	public function viewHoliday(int $key): string
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
	 * @param {int} key 曜日キー
	 * @return {string}
	 */
	public function viewWeekday(int $key): string
	{
		return $this->_weekday_name[$key];
	}

	/**
	 * 旧暦月名を返す
	 *
	 * @param {int} key 月キー
	 * @return {string}
	 */
	public function viewMonth(int $key): string
	{
		return $this->_month_name[$key];
	}

	/**
	 * 六曜名を返す
	 *
	 * @param {int} key 六曜キー
	 * @return {string}
	 */
	public function viewSixWeekday(int $key): string
	{
		return array_key_exists($key, $this->_six_weekday) ? $this->_six_weekday[$key] : "";
	}

	/**
	 * 干支キーを返す
	 *
	 * @param {int} time_stamp タイムスタンプ
	 * @return {int}
	 */
	public function getOrientalZodiac(int $time_stamp): int
	{
		$res = ($this->getYear($time_stamp)+9)%12;
		return $res;
	}

	/**
	 * 干支を返す
	 *
	 * @param {int} key 干支キー
	 * @return {string}
	 */
	public function viewOrientalZodiac(int $key): string
	{
		return $this->_oriental_zodiac[$key];
	}

	/**
	 * 指定月の第n X曜日（e.g. 第３月曜日）の日付を取得
	 *
	 * @param {int} year 年
	 * @param {int} month 月
	 * @param {int} weekly 曜日
	 * @param {int} renb 第×か
	 * @return {int}
	 */
	public function getDayByWeekly(int $year, int $month, int $weekly, int $renb = 1): int
	{
		switch ($weekly) {
			case 0:
				$map = array(7,1,2,3,4,5,6,);
				break;
			case 1:
				$map = array(6,7,1,2,3,4,5,);
				break;
			case 2:
				$map = array(5,6,7,1,2,3,4,);
				break;
			case 3:
				$map = array(4,5,6,7,1,2,3,);
				break;
			case 4:
				$map = array(3,4,5,6,7,1,2,);
				break;
			case 5:
				$map = array(2,3,4,5,6,7,1,);
				break;
			case 6:
				$map = array(1,2,3,4,5,6,7,);
				break;
		}

		$renb = 7*$renb+1;
		return $renb - $map[$this->getWeekday(mktime(0,0,0,$month,1,$year))];
	}
	
}
?>