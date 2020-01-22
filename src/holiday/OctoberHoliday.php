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
		// 2020年は東京オリンピックのため休日を８月へ移動
        if ($year !== 2020) {
            $res = $this->getHappyMonday($year, 10);
		}
		
		// 即位礼正殿の儀
		if ($year == 2019) {
			$res[22] = DJ_REGNAL_DAY;
		}
		
		if ($year >= 1966 && $year < 2000) {
			$res[10] = DJ_SPORTS_DAY;
			//振替休日
			$res = $this->getCompensatory(mktime(0, 0, 0, 10, 10, $year), $res);
		}

		return $res;
	}
}
?>