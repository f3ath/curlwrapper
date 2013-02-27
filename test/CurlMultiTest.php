<?php
require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'CurlMulti.php');

/**
 * CurlMultiTest
 *
 * @package CurlWrapper
 * @version $id$
 * @copyright Alexey Karapetov
 * @author Alexey Karapetov <karapetov@gmail.com>
 * @license http://opensource.org/licenses/mit-license.php The MIT License (MIT)
 */
class F3_CurlMultiTest
    extends PHPUnit_Framework_TestCase
{
    public function testCtorDtor()
    {
        $m = new F3_CurlMulti();
        unset($m);
    }

    public function testAddRemove()
    {
        $m = new F3_CurlMulti();
        $c = new F3_Curl();
        $this->assertEquals(CURLM_OK, $m->add($c));
        $this->assertEquals(CURLM_OK, $m->remove($c));
        $this->assertEquals(CURLM_BAD_EASY_HANDLE, $m->remove($c));
    }

    public function testInfoRead()
    {
        $m = new F3_CurlMulti();
        $this->assertFalse($m->infoRead($msgs));
        $this->assertNull($msgs);
    }

    public function testSelect()
    {
		$m = new F3_CurlMulti();
		// On failure, this function will return -1 on a select failure or timeout (from the underlying select system call).
        $this->assertEquals(-1, $m->select(0.01));
    }

    public function testGetContent()
    {
        $m = new F3_CurlMulti();
        $c = new F3_Curl();
        $m->add($c);
        $this->assertEquals('', $m->getContent($c));
    }

    public function testExec()
    {
        $m = new F3_CurlMulti();
        $c = new F3_Curl();
        $m->add($c);
        $this->assertEquals(CURLM_OK, $m->exec($running));
        $this->assertEquals(0, $running);
    }
}
