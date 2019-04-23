<?php
/**
 * １１月の祝日一覧を取得
 */
declare(strict_types=1);
namespace Alesteq\DateJa\Holiday;
require_once __DIR__ . '/HolidayList.php';
require_once __DIR__ . '/../DateUtil.php';
use Alesteq\DateJa\DateUtil;
class NovemberHoliday extends DateUtil implements HolidayList
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
		$res[3] = DJ_CULTURE_DAY;
		//振替休日
		$res = $this->getCompensatory(mktime(0, 0, 0, 11, 3, $year), $res);

		if ($year == 1990) {
			$res[12] = DJ_REGNAL_DAY;
		}

		$res[23] = DJ_LABOR_THANKSGIVING_DAY;
		//振替休日
		$res = $this->getCompensatory(mktime(0, 0, 0, 11, 23, $year), $res);

		return $res;
	}
}
?>