<?php
/**
 * ８月の祝日一覧を取得
 */
declare(strict_types=1);
namespace Alesteq\DateJa\Holiday;
require_once __DIR__ . '/HolidayList.php';
require_once __DIR__ . '/../DateUtil.php';
use Alesteq\DateJa\DateUtil;
class AugustHoliday extends DateUtil implements HolidayList
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
		if ($year >= 2016) {
			$res[11] = DJ_MOUNTAIN_DAY;
			//振替休日
			$res = $this->getCompensatory(mktime(0, 0, 0, 8, 11, $year), $res);
		}

		return $res;
	}
}
?>