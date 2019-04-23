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
		//振替休日
		$res = $this->getCompensatory(mktime(0, 0, 0, 12, 23, $year), $res);

		return $res;
	}
}
?>