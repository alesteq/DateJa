<?php
/**
 * 祝日の一覧を取得するインターフェース
 */
declare(strict_types=1);
namespace Alesteq\DateJa\Holiday;
interface HolidayList
{
	/**
	 * 祝日判定
	 *
	 * @access private
	 * @param {int} year 西暦
	 * @return {array}
	 */
	public function getHoliday(int $year): array;
}
?>