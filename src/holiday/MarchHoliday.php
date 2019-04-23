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
		$VrenalEquinoxDay = $this->getEquinoxDay(mktime(0, 0, 0, DJ_VERNAL_EQUINOX_DAY_MONTH, 1, $year));
		if ($VrenalEquinoxDay == 0) return array();

		$res[$this->getDay($VrenalEquinoxDay)] = DJ_VERNAL_EQUINOX_DAY;
		//振替休日
		$res = $this->getCompensatory($VrenalEquinoxDay, $res);

		return $res;
	}
}
?>