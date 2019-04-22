<?php
/**
 * １月の祝日一覧を取得
 */
declare(strict_types=1);
namespace Alesteq\DateJa\Holiday;
require_once __DIR__ . '/HolidayList.php';
require_once __DIR__ . '/../DateUtil.php';
use Alesteq\DateJa\DateUtil;
class JanuaryHoliday extends DateUtil implements HolidayList
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
		$res[1] = DJ_NEW_YEAR_S_DAY;
		//振替休日確認
		if ($this->getWeekDay(mktime(0, 0, 0, 1, 1, $year)) == DJ_SUNDAY) {
			$res[2] = DJ_COMPENSATING_HOLIDAY;
		}
		if ($year >= 2000) {
			//2000年以降は第二月曜日に変更
			$second_monday = $this->getDayByWeekly($year, 1, DJ_MONDAY, 2);
			$res[$second_monday] = DJ_COMING_OF_AGE_DAY;

		} else {
			$res[15] = DJ_COMING_OF_AGE_DAY;
			//振替休日確認
			if ($this->getWeekDay(mktime(0, 0, 0, 1, 15, $year)) == DJ_SUNDAY) {
				$res[16] = DJ_COMPENSATING_HOLIDAY;
			}
		}

		return $res;
	}
}
?>