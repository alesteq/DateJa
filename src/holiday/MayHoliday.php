<?php
/**
 * ５月の祝日一覧を取得
 */
declare(strict_types=1);
namespace Alesteq\DateJa\Holiday;
require_once __DIR__ . '/HolidayList.php';
require_once __DIR__ . '/../DateUtil.php';
use Alesteq\DateJa\DateUtil;
class MayHoliday extends DateUtil implements HolidayList
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
		$res[3] = DJ_CONSTITUTION_DAY;
		if ($year >= 2007) {
			$res[4] = DJ_GREENERY_DAY;
			// 振替休日
			$res = $this->getCompensatory(mktime(0, 0, 0, 5, 3, $year), $res, 3);
			$res = $this->getCompensatory(mktime(0, 0, 0, 5, 4, $year), $res, 2);
		} else if ($year >= 1986) {
			// 振替休日
			$res = $this->getCompensatory(mktime(0, 0, 0, 5, 3, $year), $res);
		}
		
		$res[5] = DJ_CHILDREN_S_DAY;
		// 振替休日
		$res = $this->getCompensatory(mktime(0, 0, 0, 5, 5, $year), $res);
		
		// 天皇即位
		if ($year == 2019) $res[1] = DJ_EMPEROR_ENTHRONEMENT_DAY;

		return $res;
	}
}
?>