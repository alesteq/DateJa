<?php
/**
 * 暦|祝日クラス
 * @author Kyoda <ks.desk@gmail.com>
 *
 * Copyright © 2014 Yasushi Kyoda
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */
declare(strict_types=1);
namespace Alesteq\DateJa;

date_default_timezone_set('Asia/Tokyo');

require_once __DIR__ . '/DateUtil.php';
require_once __DIR__ . '/holiday/JanuaryHoliday.php';
require_once __DIR__ . '/holiday/FebruaryHoliday.php';
require_once __DIR__ . '/holiday/MarchHoliday.php';
require_once __DIR__ . '/holiday/AprilHoliday.php';
require_once __DIR__ . '/holiday/MayHoliday.php';
require_once __DIR__ . '/holiday/JuneHoliday.php';
require_once __DIR__ . '/holiday/JulyHoliday.php';
require_once __DIR__ . '/holiday/AugustHoliday.php';
require_once __DIR__ . '/holiday/SeptemberHoliday.php';
require_once __DIR__ . '/holiday/OctoberHoliday.php';
require_once __DIR__ . '/holiday/NovemberHoliday.php';
require_once __DIR__ . '/holiday/DecemberHoliday.php';

/**
 * 暦|祝日クラス
 */
class DateJa extends DateUtil
{
	private $_month_holiday = [
		1 => "Alesteq\DateJa\Holiday\JanuaryHoliday",
		2 => "Alesteq\DateJa\Holiday\FebruaryHoliday",
		3 => "Alesteq\DateJa\Holiday\MarchHoliday",
		4 => "Alesteq\DateJa\Holiday\AprilHoliday",
		5 => "Alesteq\DateJa\Holiday\MayHoliday",
		6 => "Alesteq\DateJa\Holiday\JuneHoliday",
		7 => "Alesteq\DateJa\Holiday\julyHoliday",
		8 => "Alesteq\DateJa\Holiday\AugustHoliday",
		9 => "Alesteq\DateJa\Holiday\SeptemberHoliday",
		10 => "Alesteq\DateJa\Holiday\OctoberHoliday",
		11 => "Alesteq\DateJa\Holiday\NovemberHoliday",
		12 => "Alesteq\DateJa\Holiday\DecemberHoliday",
	];
	
	/**
	 * コンストラクタ
	 */
	public function __construct()
	{}

	/**
	 * 指定月の祝日リストを取得
	 *
	 * @param {int} time_stamp タイムスタンプ
	 * @param {bool} isRecursion 国民の休日を判定する再帰呼び出しの有無
	 * @return {array}
	 */
	public function getHolidayList(int $time_stamp, bool $isRecursion = true): array
	{
		$year = $this->getYear($time_stamp);
		$month = $this->getMonth($time_stamp);
		$c = new $this->_month_holiday[$month];
		$r = $c->getHoliday($year, $isRecursion);
		
		if ($isRecursion) {
			$r = $this->getNationalHoliday(mktime(0, 0, 0, $month, 1, $year), $r);
		}

		return $r;
	}

	/**
	 * 国民の休日を取得
	 * 前日と翌日が祝日の場合に休日とする
	 *
	 * @param {int} $time_stamp  当該月のタイムスタンプ
	 * @param {array} $holiday_list  当該月の休日
	 * @return {array}
	 */
	public function getNationalHoliday(int $time_stamp, array $holiday_list = []): array
	{
		$one_day = 86400;
		$yesterday = 0;
		$res = [];

		/**
		 * ２進数で昨日と一昨日の祝日フラグを立てる
		 * 祝日:1, それ以外:0
		 * １の位：昨日
		 * 十の位：一昨日
		 */
		$holidays = 0;

		// 当該月1日の00:00のtimestamp
		$year  = (int)date("Y", $time_stamp);
		$month = (int)date("m", $time_stamp);
		$baseSec = mktime(0, 0, 0, $month, 1, $year);
		if (empty($holiday_list)) {
			$holiday_list = $this->getHolidayList($baseSec, false);
		}

		// 当該月末日の00:00のtimestamp
		$targetSec = mktime(0, 0, 0, ++$month, 0, $year);

		while ($baseSec <= $targetSec) {
			$day = $this->getDay($baseSec);
			if (isset($holiday_list[$day]) && $holiday_list[$day] != DJ_NO_HOLIDAY && $holiday_list[$day] != DJ_COMPENSATING_HOLIDAY) {
				$isHoliday = 1;
				if ($holidays == 2) {
					// 本日と一昨日が祝日で昨日が平日(２進数で0b10)
					$res[$yesterday] = DJ_NATIONAL_HOLIDAY;
				}
			} else {
				$isHoliday = 0;
			}

			// フラグをシフト
			$holidays = $holidays << 1;
			$holidays += $isHoliday;
			$holidays = $holidays & 3;

			$yesterday = $day;
			$baseSec += $one_day;
		}

		// 翌月1日の祝日判定
		$holiday_hash = $this->getHolidayList($baseSec, false);
		if (isset($holiday_hash[1]) && $holiday_hash[1] != DJ_NO_HOLIDAY && $holiday_hash[1] != DJ_COMPENSATING_HOLIDAY) {
			if ($holidays == 2) {
				// 本日と一昨日が祝日で昨日が平日(２進数で0b10)
				$res[$yesterday] = DJ_NATIONAL_HOLIDAY;
			}
		}

		$res += $holiday_list;
		
		return $res;
	}

	/**
	 * タイムスタンプを展開して、日付の詳細配列を取得
	 *
	 * @param {int} time_stamp タイムスタンプ
	 * @return {array}
	 */
	public function makeDateArray(int $time_stamp): array
	{
		$holiday = $this->getHolidayList($time_stamp);
		$day = $this->getDay($time_stamp);
		$week = $this->getWeekday($time_stamp);
		$res = [
			"Year"    => $this->getYear($time_stamp),
			"Month"   => $this->getMonth($time_stamp),
			"Day"     => $day,
			"Weekday" => $week,
			"Weekname"=> $this->viewWeekday($week),
			"Holiday" => isset($holiday[$day]) ? $holiday[$day] : DJ_NO_HOLIDAY,
		];

		return $res;
	}

	/**
	 * タイムスタンプを展開して、日付情報を返す
	 *
	 * @access private
	 * @param {int} time_stamp タイムスタンプ
	 * @return {array}
	 */
	private function parseTime(int $time_stamp): array
	{
		$holiday = $this->getHolidayList($time_stamp);
		$day = $this->getDay($time_stamp);
		$res = [
			"time_stamp" => $time_stamp,
			"year"       => $this->getYear($time_stamp),
			"month"      => date("m", $time_stamp),
			"strday"     => date("d", $time_stamp),
			"day"        => $day,
			"week"       => $this->getWeekday($time_stamp),
			"holiday"    => isset($holiday[$day]) ? $holiday[$day] : DJ_NO_HOLIDAY,
		];
		return $res;
	}

	/**
	 * 祝日判定
	 *
	 * @param {int} year 年
	 * @param {int} month 月
	 * @param {int} day 日
	 * @return {bool} Returns TRUE if it is a holiday, FALSE otherwise.
	 */
	public function isHoliday(int $year, int $month, int $day): bool
	{
		$res = $this->parseTime(mktime(0, 0, 0, $month, $day, $year));
		return $res['holiday'] !== DJ_NO_HOLIDAY;
	}

	/**
	 * 指定月のカレンダー配列を取得
	 *
	 * @param {int} year 年
	 * @param {int} month 月
	 * @return {array}
	 */
	public function getCalendar(int $year, int $month): array
	{
		$lim = (int)date("t", mktime(0, 0, 0, $month, 1, $year));
		return $this->getSpanCalendar($year, $month, 1, $lim);
	}
	
	/**
	 * 指定範囲のカレンダー配列を取得す
	 *
	 * @param {int} year 年
	 * @param {int} month 月
	 * @param {int} str 開始日
	 * @param {int} lim 期間(日)
	 * @return {array}
	 */
	public function getSpanCalendar(int $year, int $month, int $str, int $lim): array
	{
		$res = [];
		if ($lim <= 0) {
			return $res;
		}

		$time_stamp = mktime(0, 0, 0, $month, $str-1, $year);

		while ($lim != 0) {
			$time_stamp = mktime(0, 0, 0, (int)date("n", $time_stamp), (int)date("j", $time_stamp) + 1, (int)date("Y", $time_stamp));
			$res[] = $this->parseTime($time_stamp);
			$lim--;
		}
		return $res;
	}

	/**
	 * 営業日を取得
	 *
	 * @param {int} time_stamp 取得開始日
	 * @param {int} days 取得日数（マイナスも可）
	 * @param {array} closed_week 休業する曜日定数の配列、[7 => 祝日を休業とする場合は1] (optional)
	 * @param {array} closed_date 休業する日付（Y-m-d）若しくはタイムスタンプの配列 (optional)
	 * @return {array} 営業日の配列
	 */
	public function getWorkingDay(int $time_stamp, int $days, array $closed_week = [], array $closed_date = []): array
	{
		$closed_week = empty($closed_week) ?: array_flip($closed_week);
		$closed_date = $this->getTimestampFor($closed_date);
		$res = [];
		$adjust = $days>0? 1: -1;
		$one_day = 86400 * $adjust;
		$job = 0;
		$time_stamp = mktime(0, 0, 0, (int)date("n", $time_stamp), (int)date("j", $time_stamp), (int)date("Y", $time_stamp));
		while ($job != $days) {
			$gc = $this->parseTime($time_stamp);
			if (
				(array_key_exists($gc["week"], $closed_week) == false) && 
				(array_key_exists($gc["time_stamp"], $closed_date) == false) && 
				(isset($closed_week[7]) ? $gc["holiday"] == DJ_NO_HOLIDAY : true)
			) {
				$res[] = $gc;
				$job += $adjust;
			}
			$time_stamp += $one_day;
		}
		return $res;
	}
	
	/**
	 * 受け取った日付の配列をそれぞれ当日00:00のタイムスタンプに変換
	 *
	 * @access private
	 * @param {array} $args  日付文字列の配列
	 * @return {array} タイムスタンプをキーにしたハッシュ
	 */
	public function getTimestampFor(array $args): array
	{
		$r = [];
		foreach ($args as $value) {
			if (preg_match("/^[1-9][0-9]*$/", $value)!==1) {
				$value = strtotime($value) ?: 0;
			}
			$r[mktime(0, 0, 0, (int)date("n", $value), (int)date("j", $value), (int)date("Y", $value))] = 1;
		}
		
		return $r;
	}
}
?>