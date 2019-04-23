<?php
/**
 * ９月の祝日一覧を取得
 */
declare(strict_types=1);
namespace Alesteq\DateJa\Holiday;
require_once __DIR__ . '/HolidayList.php';
require_once __DIR__ . '/../DateUtil.php';
use Alesteq\DateJa\DateUtil;
class SeptemberHoliday extends DateUtil implements HolidayList
{

	public function __construct()
	{}

	/**
	 * 祝日判定
	 *
	 * @access private
	 * @param {int} year 西暦
	 * @return {array}
	 */
	public function getHoliday(int $year): array
	{
		$res = $this->getHappyMonday($year, 9);
		
		$autumnEquinoxDay = $this->getAutumnEquinoxDay($year);
		if ($autumnEquinoxDay !== 0) {
			$autumnDay = $this->getDay($autumnEquinoxDay);
			$res[$autumnDay] = DJ_AUTUMNAL_EQUINOX_DAY;
			//振替休日
			$res = $this->getCompensatory($autumnEquinoxDay, $res);
		}

		if ($year >= 1966 && $year < 2003) {
			$res[15] = DJ_RESPECT_FOR_SENIOR_CITIZENS_DAY;
			//振替休日
			$res = $this->getCompensatory(mktime(0, 0, 0, 9, 15, $year), $res);
		}

		return $res;
	}
	
	/**
	 * 秋分の日を取得
	 * 1851〜2150 の間の予測
	 *
	 * @param {int} year 西暦
	 * @return {int} タイムスタンプ
	 */
	public function getAutumnEquinoxDay(int $year): int
	{
		if ($year <= 1850 || $year > 2150) {
			return 0;
		}
		if ($year > 2099 && $year <= 2150) {
			$adjust = 24.2488;
		}
		if ($year > 1979 && $year <= 2099) {
			$adjust = 23.2488;
		}
		if ($year > 1899 && $year <= 1979) {
			$adjust = 23.2588;
		}
		if ($year > 1850 && $year <= 1899) {
			$adjust = 22.2588;
		}
		$day = floor($adjust + (0.242194 * ($year - 1980)) - floor(($year - 1980) / 4));
		
		return mktime(0, 0, 0, DJ_AUTUMNAL_EQUINOX_DAY_MONTH, (int)$day, $year);
	}
}
?>