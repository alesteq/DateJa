<?php
namespace Tests\Alesteq\DateJa;
require_once __DIR__ . '/../../../vendor/autoload.php';
use Alesteq\DateJa\DateJa;

class DateJaTest extends \PHPUnit\Framework\TestCase
{
	private $dj = null;
	private $timestamp = 0;
	
	public function setUp(): void
	{
		$this->dj = new DateJa();
		$this->timestamp = mktime(0, 0, 0, 05, 10, 2019);
	}
	
	/**
	 * 指定月の祝日リストを取得
	 * @test
	 */
	public function testGetHolidayList()
	{
		$this->assertArrayHasKey(3, $this->dj->getHolidayList($this->timestamp, false));
		$this->assertContainsOnly('int', $this->dj->getHolidayList($this->timestamp, false));
		$this->assertInternalType('array', $this->dj->getHolidayList(1, false));
		
		// 国民の休日
		$this->assertContains(11, $this->dj->getHolidayList($this->timestamp));
	}
	
	/**
	 * １月の祝日判定
	 * @test
	 * @private
	 */
	public function testGetJanuaryHoliday()
	{
		$reflection = new \ReflectionClass($this->dj);
		$method = $reflection->getMethod('getJanuaryHoliday');
		$method->setAccessible(true);

		$this->assertContainsOnly('int', $method->invoke($this->dj, 2019, true));
		$this->assertArrayHasKey(2, $method->invoke($this->dj, 2006, true));
		$this->assertArrayHasKey(16, $method->invoke($this->dj, 1995, true));
	}
	
	/**
	 * ２月の祝日判定
	 * @test
	 * @private
	 */
	public function testGetFebruaryHoliday()
	{
		$reflection = new \ReflectionClass($this->dj);
		$method = $reflection->getMethod('getFebruaryHoliday');
		$method->setAccessible(true);

		$this->assertContainsOnly('int', $method->invoke($this->dj, 2019, true));
		$this->assertArrayHasKey(24, $method->invoke($this->dj, 1989, true));
		$this->assertArrayHasKey(23, $method->invoke($this->dj, 2020, true));
		$this->assertArrayHasKey(11, $method->invoke($this->dj, 2001, true));
	}
	
	/**
	 * ３月の祝日判定
	 * @test
	 * @private
	 */
	public function testGetMarchHoliday()
	{
		$reflection = new \ReflectionClass($this->dj);
		$method = $reflection->getMethod('getMarchHoliday');
		$method->setAccessible(true);

		$this->assertContainsOnly('int', $method->invoke($this->dj, 2019, true));
		$this->assertContains(13, $method->invoke($this->dj, 1999, true));
	}
	
	/**
	 * ４月の祝日判定
	 * @test
	 * @private
	 */
	public function testGetAprilHoliday()
	{
		$reflection = new \ReflectionClass($this->dj);
		$method = $reflection->getMethod('getAprilHoliday');
		$method->setAccessible(true);

		$this->assertContainsOnly('int', $method->invoke($this->dj, 2019, true));
		$this->assertArrayHasKey(29, $method->invoke($this->dj, 1989, true));
		$this->assertArrayHasKey(29, $method->invoke($this->dj, 1988, true));
		$this->assertArrayHasKey(10, $method->invoke($this->dj, 1959, true));
		$this->assertArrayHasKey(30, $method->invoke($this->dj, 2001, true));
	}

	/**
	 * ５月の祝日判定
	 * @test
	 * @private
	 */
	public function testGetMayHoliday()
	{
		$reflection = new \ReflectionClass($this->dj);
		$method = $reflection->getMethod('getMayHoliday');
		$method->setAccessible(true);

		$this->assertContainsOnly('int', $method->invoke($this->dj, 2019, true));
		$this->assertArrayHasKey(6, $method->invoke($this->dj, 2009, true));
		$this->assertArrayHasKey(4, $method->invoke($this->dj, 1998, true));
	}

	/**
	 * ６月の祝日判定
	 * @test
	 * @private
	 */
	public function testGetJuneHoliday()
	{
		$reflection = new \ReflectionClass($this->dj);
		$method = $reflection->getMethod('getJuneHoliday');
		$method->setAccessible(true);

		$this->assertContainsOnly('int', $method->invoke($this->dj, 2019, true));
		$this->assertArrayHasKey(9, $method->invoke($this->dj, 1993, true));
	}

	/**
	 * ７月の祝日判定
	 * @test
	 * @private
	 */
	public function testGetJulyHoliday()
	{
		$reflection = new \ReflectionClass($this->dj);
		$method = $reflection->getMethod('getJulyHoliday');
		$method->setAccessible(true);

		$this->assertContainsOnly('int', $method->invoke($this->dj, 2019, true));
		$this->assertContains(15, $method->invoke($this->dj, 2019, true));
		$this->assertArrayHasKey(21, $method->invoke($this->dj, 1997, true));
	}

	/**
	 * ８月の祝日判定
	 * @test
	 * @private
	 */
	public function testGetAugustHoliday()
	{
		$reflection = new \ReflectionClass($this->dj);
		$method = $reflection->getMethod('getAugustHoliday');
		$method->setAccessible(true);

		$this->assertContainsOnly('int', $method->invoke($this->dj, 2019, true));
	}

	/**
	 * ９月の祝日判定
	 * @test
	 * @private
	 */
	public function testGetSeptemberHoliday()
	{
		$reflection = new \ReflectionClass($this->dj);
		$method = $reflection->getMethod('getSeptemberHoliday');
		$method->setAccessible(true);

		$this->assertContainsOnly('int', $method->invoke($this->dj, 2019, true));
		$this->assertArrayHasKey(16, $method->invoke($this->dj, 1996, true));
		$this->assertContains(13, $method->invoke($this->dj, 2001, true));
	}

	/**
	 * １０月の祝日判定
	 * @test
	 * @private
	 */
	public function testGetOctoberHoliday()
	{
		$reflection = new \ReflectionClass($this->dj);
		$method = $reflection->getMethod('getOctoberHoliday');
		$method->setAccessible(true);

		$this->assertContainsOnly('int', $method->invoke($this->dj, 2019, true));
		$this->assertArrayHasKey(11, $method->invoke($this->dj, 1999, true));
	}

	/**
	 * １１月の祝日判定
	 * @test
	 * @private
	 */
	public function testGetNovemberHoliday()
	{
		$reflection = new \ReflectionClass($this->dj);
		$method = $reflection->getMethod('getNovemberHoliday');
		$method->setAccessible(true);

		$this->assertContainsOnly('int', $method->invoke($this->dj, 2019, true));
		$this->assertArrayHasKey(12, $method->invoke($this->dj, 1990, true));
		$this->assertArrayHasKey(24, $method->invoke($this->dj, 1997, true));
	}

	/**
	 * １２月の祝日判定
	 * @test
	 * @private
	 */
	public function testGetDecemberHoliday()
	{
		$reflection = new \ReflectionClass($this->dj);
		$method = $reflection->getMethod('getDecemberHoliday');
		$method->setAccessible(true);

		$this->assertContainsOnly('int', $method->invoke($this->dj, 2019, true));
	}
	
	/**
	 * 国民の休日を取得
	 * 前日と翌日が祝日の場合に休日とする
	 * @test
	 */
	public function testGetNationalHoliday()
	{
		$this->assertContains(11, $this->dj->getNationalHoliday($this->timestamp));
	}
	
	/**
	 * 祝日判定
	 * @test
	 */
	public function testIsHoliday()
	{
		$this->assertTrue($this->dj->isHoliday(2019, 5, 1));
	}
	
	/**
	 * 干支キーを返す
	 * @test
	 */
	public function tesGetOrientalZodiac()
	{
		$this->assertEquals(0, $this->dj->getOrientalZodiac($this->timestamp));
	}

	/**
	 * 年号キーを返す
	 * @test
	 */
	public function testGetEraName()
	{
		$this->assertEquals(0, $this->dj->getEraName(mktime(0, 0, 0, 1 , 24, 1868)));
		$this->assertEquals(1, $this->dj->getEraName(mktime(0, 0, 0, 1 , 25, 1868)));
		$this->assertEquals(2, $this->dj->getEraName(mktime(0, 0, 0, 7 , 30, 1912)));
		$this->assertEquals(3, $this->dj->getEraName(mktime(0, 0, 0, 1 , 7, 1989)));
		$this->assertEquals(4, $this->dj->getEraName(mktime(0, 0, 0, 4, 30, 2019)));
		$this->assertEquals(5, $this->dj->getEraName($this->timestamp));
	}

	/**
	 * 和暦を返す
	 * @test
	 */
	public function testGetEraYear()
	{
		$this->assertEquals(1, $this->dj->getEraYear($this->timestamp));
	}

	/**
	 * 日本語フォーマットされた休日名を返す
	 * @test
	 */
	public function testViewHoliday()
	{
		$this->assertEquals('元旦', $this->dj->viewHoliday(1));
	}

	/**
	 * 日本語フォーマットされた曜日名を返す
	 * @test
	 */
	public function testViewWeekday()
	{
		$this->assertEquals('水', $this->dj->viewWeekday(3));
	}


	/**
	 * 日本語フォーマットされた旧暦月名を返す
	 * @test
	 */
	public function testViewMonth()
	{
		$this->assertEquals('皐月', $this->dj->viewMonth(5));
	}


	/**
	 * 日本語フォーマットされた六曜名を返す
	 * @test
	 */
	public function testViewSixWeekday()
	{
		$this->assertEquals('先勝', $this->dj->viewSixWeekday(2));
	}

	/**
	 * 日本語フォーマットされた干支を返す
	 * @test
	 */
	public function testViewOrientalZodiac()
	{
		$this->assertEquals('亥', $this->dj->viewOrientalZodiac(0));
	}

	/**
	 * 日本語フォーマットされた年号を返す
	 * @test
	 */
	public function testViewEraName()
	{
		$this->assertEquals('平成', $this->dj->viewEraName(4));
	}
	
	/**
	 * 春分の日を取得
	 *
	 * @param {int} year 西暦
	 * @return {int} タイムスタンプ
	 */
	public function testGetVrenalEquinoxDay()
	{
		$this->assertEquals(0, $this->dj->getVrenalEquinoxDay(1850));
		$this->assertEquals(21, $this->dj->getDay($this->dj->getVrenalEquinoxDay(1899)));
		$this->assertEquals(21, $this->dj->getDay($this->dj->getVrenalEquinoxDay(1979)));
		$this->assertEquals(20, $this->dj->getDay($this->dj->getVrenalEquinoxDay(2099)));
		$this->assertEquals(20, $this->dj->getDay($this->dj->getVrenalEquinoxDay(2149)));
		$this->assertEquals(0, $this->dj->getVrenalEquinoxDay(2151));
	}

	/**
	 * 秋分の日を取得
	 *
	 * @param {int} year 西暦
	 * @return {int} タイムスタンプ
	 */
	public function testGetAutumnEquinoxDay()
	{
		$this->assertEquals(0, $this->dj->getAutumnEquinoxDay(1850));
		$this->assertEquals(23, $this->dj->getDay($this->dj->getAutumnEquinoxDay(1899)));
		$this->assertEquals(24, $this->dj->getDay($this->dj->getAutumnEquinoxDay(1979)));
		$this->assertEquals(23, $this->dj->getDay($this->dj->getAutumnEquinoxDay(2099)));
		$this->assertEquals(23, $this->dj->getDay($this->dj->getAutumnEquinoxDay(2149)));
		$this->assertEquals(0, $this->dj->getAutumnEquinoxDay(2151));
	}
	
	/**
	 * タイムスタンプを展開して、日付の詳細配列を取得
	 *
	 * @param {int} time_stamp タイムスタンプ
	 * @return {array}
	 */
	public function testMakeDateArray()
	{
		$this->assertArrayHasKey("Year", $this->dj->makeDateArray($this->timestamp));
		$this->assertArrayHasKey("Month", $this->dj->makeDateArray($this->timestamp));
		$this->assertArrayHasKey("Day", $this->dj->makeDateArray($this->timestamp));
		$this->assertArrayHasKey("Weekday", $this->dj->makeDateArray($this->timestamp));
		$this->assertArrayHasKey("Holiday", $this->dj->makeDateArray($this->timestamp));
	}

	/**
	 * 七曜を数値化して返す
	 *
	 * @param {int} time_stamp タイムスタンプ
	 * @return {int} 0:日, 1:月, 2:火, 3:水, 4:木, 5:金, 6:土
	 */
	public function testGetWeekday()
	{
		$this->assertEquals(5, $this->dj->getWeekday($this->timestamp));
	}
	
	/**
	 * 西暦を数値化して返す
	 * @test
	 */
	public function testGetYear()
	{
		$this->assertEquals(2019, $this->dj->getYear($this->timestamp));
	}

	/**
	 * 月を数値化して返す
	 * @test
	 */
	public function testGetMonth()
	{
		$this->assertEquals(5, $this->dj->getMonth($this->timestamp));
	}
	
	/**
	 * 日を数値化して返す
	 * @test
	 */
	public function testGetDay()
	{
		$this->assertEquals(10, $this->dj->getDay($this->timestamp));
	}
	
	/**
	 * 指定月の第× ×曜日（e.g. 第３月曜日）の日付を取得
	 * @test
	 */
	public function testGetDayByWeekly()
	{
		$this->assertEquals(5, $this->dj->getDayByWeekly(2019, 5, 0));
		$this->assertEquals(6, $this->dj->getDayByWeekly(2019, 5, 1));
		$this->assertEquals(7, $this->dj->getDayByWeekly(2019, 5, 2));
		$this->assertEquals(1, $this->dj->getDayByWeekly(2019, 5, 3));
		$this->assertEquals(2, $this->dj->getDayByWeekly(2019, 5, 4));
		$this->assertEquals(3, $this->dj->getDayByWeekly(2019, 5, 5));
		$this->assertEquals(4, $this->dj->getDayByWeekly(2019, 5, 6));
	}
	
	/**
	 * 指定月のカレンダー配列を取得
	 * @test
	 */
	public function testGetCalendar()
	{
		$this->assertCount(31, $this->dj->getCalendar(2019, 5));
	}
	
	/**
	 * 指定範囲のカレンダー配列を取得す
	 *
	 * @param {int} year 年
	 * @param {int} month 月
	 * @param {int} str 開始日
	 * @param {int} lim 期間(日)
	 * @return {array}
	 */
	public function testGetSpanCalendar()
	{
		$this->assertEmpty($this->dj->getSpanCalendar(19, 5, 1, 0));
	}
	
	/**
	 * 営業日を取得
	 * @test
	 */
	public function testGetWorkingDay()
	{
		$this->assertCount(5, $this->dj->getWorkingDay($this->timestamp, 5, true, [0,6], ['2019-05-15']));
	}
}