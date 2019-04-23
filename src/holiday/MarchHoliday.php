<?php
/**
 * ３月の祝日一覧を取得
 */
declare(strict_types=1);
namespace Alesteq\DateJa\Holiday;
require_once __DIR__ . '/HolidayList.php';
require_once __DIR__ . '/../DateUtil.php';
use Alesteq\DateJa\DateUtil;
class MarchHoliday extends DateUtil implements HolidayList
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
		$VrenalEquinoxDay = $this->getVrenalEquinoxDay($year);
		if ($VrenalEquinoxDay==0) return array();

		$res[$this->getDay($VrenalEquinoxDay)] = DJ_VERNAL_EQUINOX_DAY;
		//振替休日確認
		if ($this->getWeekDay($VrenalEquinoxDay) == DJ_SUNDAY) {
			$res[$this->getDay($VrenalEquinoxDay)+1] = DJ_COMPENSATING_HOLIDAY;
		}

		return $res;
	}
	
	/**
	 * 春分の日を取得
	 * 1851〜2150 の間の予測
	 *
	 * @param {int} year 西暦
	 * @return {int} タイムスタンプ
	 */
	public function getVrenalEquinoxDay(int $year): int
	{
		if ($year < 1851 || $year > 2150) {
			return 0;
		}
		
		if ($year <= 1899) {
			$adjust = 19.8277;
		} else if ($year <= 1979) {
			$adjust = 20.8357;
		} else if ($year <= 2099) {
			$adjust = 20.8431;
		} else if ($year <= 2150) {
			$adjust = 21.851;
		}
		$day = floor($adjust + (0.242194 * ($year - 1980)) - floor(($year - 1980) / 4));
		
		return mktime(0, 0, 0, DJ_VERNAL_EQUINOX_DAY_MONTH, (int)$day, $year);
	}
}
?>