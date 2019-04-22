<?php
/**
 * １２月の祝日一覧を取得
 */
declare(strict_types=1);
namespace Alesteq\DateJa\Holiday;
require_once __DIR__ . '/HolidayList.php';
require_once __DIR__ . '/../DateUtil.php';
use Alesteq\DateJa\DateUtil;
class DecemberHoliday extends DateUtil implements HolidayList
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
		if ($year >= 1989 && $year < 2019) {
			$res[23] = DJ_THE_EMPEROR_S_BIRTHDAY;
		}
		if ($this->getWeekDay(mktime(0, 0, 0, 12, 23, $year)) == DJ_SUNDAY) {
			$res[24] = DJ_COMPENSATING_HOLIDAY;
		}

		return $res;
	}
}
?>