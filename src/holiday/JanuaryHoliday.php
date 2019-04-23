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
		$res = $this->getHappyMonday($year, 1);
		
		$res[1] = DJ_NEW_YEAR_S_DAY;
		//振替休日
		$res = $this->getCompensatory(mktime(0, 0, 0, 1, 1, $year), $res);
		
		if ($year < 2000) {
			$res[15] = DJ_COMING_OF_AGE_DAY;
			//振替休日
			$res = $this->getCompensatory(mktime(0, 0, 0, 1, 15, $year), $res);
		}

		return $res;
	}
}
?>