<?php
namespace Tests\Alesteq\DateJa;
require_once __DIR__ . '/../../../vendor/autoload.php';
use Alesteq\DateJa\DateJa;
use Alesteq\DateJa\DateUtil;
use Alesteq\DateJa\Holiday\JanuaryHoliday;
use Alesteq\DateJa\Holiday\FebruaryHoliday;
use Alesteq\DateJa\Holiday\MarchHoliday;
use Alesteq\DateJa\Holiday\AprilHoliday;
use Alesteq\DateJa\Holiday\MayHoliday;
use Alesteq\DateJa\Holiday\JuneHoliday;
use Alesteq\DateJa\Holiday\JulyHoliday;
use Alesteq\DateJa\Holiday\AugustHoliday;
use Alesteq\DateJa\Holiday\SeptemberHoliday;
use Alesteq\DateJa\Holiday\OctoberHoliday;
use Alesteq\DateJa\Holiday\NovemberHoliday;
use Alesteq\DateJa\Holiday\DecemberHoliday;


class DateJaTest extends \PHPUnit\Framework\TestCase
{
	private $dj = null;
	private $util = null;
	private $january = null;
	private $february = null;
	private $march = null;
	private $april = null;
	private $may = null;
	private $june = null;
	private $july = null;
	private $august = null;
	private $september = null;
	private $october = null;
	private $november = null;
	private $december = null;
	private $timestamp = 0;
	
	public function setUp(): void
	{
		$this->dj = new DateJa();
		$this->util = new DateUtil();
		$this->january = new JanuaryHoliday();
		$this->february = new FebruaryHoliday();
		$this->march = new MarchHoliday();
		$this->april = new AprilHoliday();
		$this->may = new MayHoliday();
		$this->june = new JuneHoliday();
		$this->july = new JulyHoliday();
		$this->august = new AugustHoliday();
		$this->september = new SeptemberHoliday();
		$this->october = new OctoberHoliday();
		$this->november = new NovemberHoliday();
		$this->december = new DecemberHoliday();
		$this->timestamp = mktime(0, 0, 0, 5, 10, 2019);
	}
	
	/**
	 * 指定月の祝日リストを取得
	 * @test
	 */
	public function testGetHolidayList()
	{
		$this->assertArrayHasKey(3, $this->dj->getHolidayList($this->timestamp, false));
		$this->assertContainsOnly('int', $this->dj->getHolidayList($this->timestamp, false));
		
		// 国民の休日
		$this->assertContains(11, $this->dj->getHolidayList(mktime(0, 0, 0, 4, 1, 2019)));
	}
	
	/**
	 * １月の祝日判定
	 * @test
	 * @private
	 */
	public function testGetHoliday()
	{
		$this->assertContainsOnly('int', $this->january->getHoliday(2019));
		$this->assertArrayHasKey(2, $this->january->getHoliday(2006));
		$this->assertArrayHasKey(16, $this->january->getHoliday(1995));
	}
	
	/**
	 * ２月の祝日判定
	 * @test
	 * @private
	 */
	public function testGetFebruaryHoliday()
	{
		$this->assertContainsOnly('int', $this->february->getHoliday(2019));
		$this->assertArrayHasKey(24, $this->february->getHoliday(1989));
		$this->assertArrayHasKey(23, $this->february->getHoliday(2020));
		$this->assertArrayHasKey(11, $this->february->getHoliday(2001));
	}
	
	/**
	 * ３月の祝日判定
	 * @test
	 * @private
	 */
	public function testGetMarchHoliday()
	{
		$this->assertContainsOnly('int', $this->march->getHoliday(2019));
		$this->assertContains(13, $this->march->getHoliday(1999));
	}
	
	/**
	 * ４月の祝日判定
	 * @test
	 * @private
	 */
	public function testGetAprilHoliday()
	{
		$this->assertContainsOnly('int', $this->april->getHoliday(2019));
		$this->assertArrayHasKey(29, $this->april->getHoliday(1989));
		$this->assertArrayHasKey(29, $this->april->getHoliday(1988));
		$this->assertArrayHasKey(10, $this->april->getHoliday(1959));
		$this->assertArrayHasKey(30, $this->april->getHoliday(2001));
	}

	/**
	 * ５月の祝日判定
	 * @test
	 * @private
	 */
	public function testGetMayHoliday()
	{
		$this->assertContainsOnly('int', $this->may->getHoliday(2019));
		$this->assertArrayHasKey(6, $this->may->getHoliday(2009));
		$this->assertArrayHasKey(4, $this->may->getHoliday(1998));
		$this->assertContains(11, $this->may->getHoliday(1999));
	}

	/**
	 * ６月の祝日判定
	 * @test
	 * @private
	 */
	public function testGetJuneHoliday()
	{
		$this->assertContainsOnly('int', $this->june->getHoliday(2019));
		$this->assertArrayHasKey(9, $this->june->getHoliday(1993));
	}

	/**
	 * ７月の祝日判定
	 * @test
	 * @private
	 */
	public function testGetJulyHoliday()
	{
		$this->assertContainsOnly('int', $this->july->getHoliday(2019));
		$this->assertContains(15, $this->july->getHoliday(2019));
		$this->assertArrayHasKey(21, $this->july->getHoliday(1997));
	}

	/**
	 * ８月の祝日判定
	 * @test
	 * @private
	 */
	public function testGetAugustHoliday()
	{
		$this->assertContainsOnly('int', $this->august->getHoliday(2019));
	}

	/**
	 * ９月の祝日判定
	 * @test
	 * @private
	 */
	public function testGetSeptemberHoliday()
	{
		$this->assertContainsOnly('int', $this->september->getHoliday(2019));
		$this->assertArrayHasKey(16, $this->september->getHoliday(1996));
		$this->assertContains(13, $this->september->getHoliday(2001));
	}

	/**
	 * １０月の祝日判定
	 * @test
	 * @private
	 */
	public function testGetOctoberHoliday()
	{
		$this->assertContainsOnly('int', $this->october->getHoliday(2019));
		$this->assertArrayHasKey(11, $this->october->getHoliday(1999));
	}

	/**
	 * １１月の祝日判定
	 * @test
	 * @private
	 */
	public function testGetNovemberHoliday()
	{
		$this->assertContainsOnly('int', $this->november->getHoliday(2019));
		$this->assertArrayHasKey(12, $this->november->getHoliday(1990));
		$this->assertArrayHasKey(24, $this->november->getHoliday(1997));
	}

	/**
	 * １２月の祝日判定
	 * @test
	 * @private
	 */
	public function testGetDecemberHoliday()
	{
		$this->assertContainsOnly('int', $this->december->getHoliday(2018));
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
	 * 年号元年の西暦を返す
	 * @test
	 */
	public function testGetEraName()
	{
		$this->assertEquals(0, $this->dj->getEraNewYear(mktime(0, 0, 0, 1 , 24, 1868)));
		$this->assertEquals(1868, $this->dj->getEraNewYear(mktime(0, 0, 0, 1 , 25, 1868)));
		$this->assertEquals(1912, $this->dj->getEraNewYear(mktime(0, 0, 0, 7 , 30, 1912)));
		$this->assertEquals(1926, $this->dj->getEraNewYear(mktime(0, 0, 0, 1 , 7, 1989)));
		$this->assertEquals(1989, $this->dj->getEraNewYear(mktime(0, 0, 0, 4, 30, 2019)));
		$this->assertEquals(2019, $this->dj->getEraNewYear($this->timestamp));
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
		$this->assertEquals('平成', $this->dj->viewEraName(mktime(0, 0, 0, 4, 30, 2019)));
	}
	
	/**
	 * 春分の日を取得
	 *
	 * @param {int} year 西暦
	 * @return {int} タイムスタンプ
	 */
	public function testGetVrenalEquinoxDay()
	{
		$this->assertEquals(0, $this->march->getVrenalEquinoxDay(1850));
		$this->assertEquals(21, $this->dj->getDay($this->march->getVrenalEquinoxDay(1899)));
		$this->assertEquals(21, $this->dj->getDay($this->march->getVrenalEquinoxDay(1979)));
		$this->assertEquals(20, $this->dj->getDay($this->march->getVrenalEquinoxDay(2099)));
		$this->assertEquals(20, $this->dj->getDay($this->march->getVrenalEquinoxDay(2149)));
		$this->assertEquals(0, $this->march->getVrenalEquinoxDay(2151));
	}

	/**
	 * 秋分の日を取得
	 *
	 * @param {int} year 西暦
	 * @return {int} タイムスタンプ
	 */
	public function testGetAutumnEquinoxDay()
	{
		$this->assertEquals(0, $this->september->getAutumnEquinoxDay(1850));
		$this->assertEquals(23, $this->dj->getDay($this->september->getAutumnEquinoxDay(1899)));
		$this->assertEquals(24, $this->dj->getDay($this->september->getAutumnEquinoxDay(1979)));
		$this->assertEquals(23, $this->dj->getDay($this->september->getAutumnEquinoxDay(2099)));
		$this->assertEquals(23, $this->dj->getDay($this->september->getAutumnEquinoxDay(2149)));
		$this->assertEquals(0, $this->september->getAutumnEquinoxDay(2151));
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
		$this->assertCount(5, $this->dj->getWorkingDay($this->timestamp, 5, [0,6,7], ['2019-05-15']));
	}
}