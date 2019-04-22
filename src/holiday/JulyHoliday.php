<?php
/**
 * ７月の祝日一覧を取得
 */
declare(strict_types=1);
namespace Alesteq\DateJa\Holiday;
require_once __DIR__ . '/HolidayList.php';
require_once __DIR__ . '/../DateUtil.php';
use Alesteq\DateJa\DateUtil;
class JulyHoliday extends DateUtil implements HolidayList
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
		$res = array();
		if ($year >= 2003) {
			$third_monday = $this->getDayByWeekly($year, 7, DJ_MONDAY, 3);
			$res[$third_monday] = DJ_MARINE_DAY;
		} else if ($year >= 1996) {
			$res[20] = DJ_MARINE_DAY;
			//振替休日確認
			if ($this->getWeekDay(mktime(0, 0, 0, 7, 20, $year)) == DJ_SUNDAY) {
				$res[21] = DJ_COMPENSATING_HOLIDAY;
			}
		}

		return $res;
	}
}
?>