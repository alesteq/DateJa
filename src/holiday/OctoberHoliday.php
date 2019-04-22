<?php
/**
 * １０月の祝日一覧を取得
 */
declare(strict_types=1);
namespace Alesteq\DateJa\Holiday;
require_once __DIR__ . '/HolidayList.php';
require_once __DIR__ . '/../DateUtil.php';
use Alesteq\DateJa\DateUtil;
class OctoberHoliday extends DateUtil implements HolidayList
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
		if ($year >= 2000) {
			//2000年以降は第二月曜日に変更
			$second_monday = $this->getDayByWeekly($year, 10, DJ_MONDAY, 2);
			$res[$second_monday] = DJ_SPORTS_DAY;
		} else if ($year >= 1966) {
			$res[10] = DJ_SPORTS_DAY;
			//振替休日確認
			if ($this->getWeekDay(mktime(0, 0, 0, 10, 10, $year)) == DJ_SUNDAY) {
				$res[11] = DJ_COMPENSATING_HOLIDAY;
			}
		}

		if ($year == 2019) {
			// 即位礼正殿の儀
			$res[22] = DJ_REGNAL_DAY;
		}

		return $res;
	}
}
?>