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

		// 2020年、2021年は東京オリンピックのため特例措置
		if ($year === 2021) {
			$res[22] = DJ_MARINE_DAY;
			$res[23] = DJ_SPORTS_DAY;
		} else if ($year === 2020) {
			$res[23] = DJ_MARINE_DAY;
			$res[24] = DJ_SPORTS_DAY;
		} else {
			$res = $this->getHappyMonday($year, 7);
		}

		if ($year >= 1996 && $year < 2003) {
			$res[20] = DJ_MARINE_DAY;
			//振替休日
			$res = $this->getCompensatory(mktime(0, 0, 0, 7, 20, $year), $res);
		}

		return $res;
	}
}
?>