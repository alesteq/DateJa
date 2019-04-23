<?php
/**
 * ４月の祝日一覧を取得
 */
declare(strict_types=1);
namespace Alesteq\DateJa\Holiday;
require_once __DIR__ . '/HolidayList.php';
require_once __DIR__ . '/../DateUtil.php';
use Alesteq\DateJa\DateUtil;
class AprilHoliday extends DateUtil implements HolidayList
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
		if ($year >= 2007) {
			$res[29] = DJ_DAY_OF_SHOWA;
		} else if ($year >= 1989) {
			$res[29] = DJ_GREENERY_DAY;
		} else {
			$res[29] = DJ_THE_EMPEROR_S_BIRTHDAY;
			if ($year == 1959) {
				$res[10] = DJ_CROWN_PRINCE_HIROHITO_WEDDING;
			}
		}
		//振替休日
		$res = $this->getCompensatory(mktime(0, 0, 0, 4, 29, $year), $res);

		return $res;
	}
}
?>