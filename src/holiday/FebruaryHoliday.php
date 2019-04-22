<?php
/**
 * ２月の祝日一覧を取得
 */
declare(strict_types=1);
namespace Alesteq\DateJa\Holiday;
require_once __DIR__ . '/../DateUtil.php';
require_once __DIR__ . '/HolidayList.php';
use Alesteq\DateJa\DateUtil;
class FebruaryHoliday extends DateUtil implements HolidayList
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
		$res[11] = DJ_NATIONAL_FOUNDATION_DAY;
		//振替休日確認
		if ($this->getWeekDay(mktime(0, 0, 0, 2, 11, $year)) == DJ_SUNDAY) {
			$res[12] = DJ_COMPENSATING_HOLIDAY;
		}
		if ($year == 1989) {
			$res[24] = DJ_THE_SHOWA_EMPEROR_DIED;
		}
		if ($year >= 2020) {
			$res[23] = DJ_THE_EMPEROR_S_BIRTHDAY;
			//振替休日確認
			if ($this->getWeekDay(mktime(0, 0, 0, 2, 23, $year)) == DJ_SUNDAY) {
				$res[24] = DJ_COMPENSATING_HOLIDAY;
			}
		}

		return $res;
	}
}
?>