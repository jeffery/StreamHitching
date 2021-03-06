<?php
/**
 * This file is part of the StreamHitching package.
 * (c) 2010 Christian Schaefer <caefer@ical.ly>>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package    StreamHitching
 * @author     Christian Schaefer <caefer@ical.ly>
 * @version    SVN: $Id: $
 */

/**
 * Stream wrapper for read only access of a local file.
 *
 * @package    StreamHitching
 * @subpackage wrapper
 * @author     Christian Schaefer <caefer@ical.ly>
 */
class Stream_Wrapper_ReadOnlyFile_Local_Test extends PHPUnit_Framework_TestCase
{
  public function testStream_close()
  {
    $this->wrapper->stream_close();
  }

  public function testStream_eof()
  {
    $this->assertFalse($this->wrapper->stream_eof());
  }

  public function testStream_flush()
  {
    $this->assertFalse($this->wrapper->stream_flush());
  }

  public function testStream_open()
  {
    $this->assertTrue($this->wrapper->stream_open(__FILE__, 'r'));
  }

  public function testStream_openForWritingShouldFail()
  {
    $this->assertFalse($this->wrapper->stream_open(__FILE__, 'w'));
  }

  public function testStream_read()
  {
    $this->wrapper->stream_open(__FILE__, 'r');
    $this->assertContains('Stream_Wrapper_ReadOnlyFile_Local_Test', $this->wrapper->stream_read(8192));
  }

  public function testStream_seek()
  {
    $this->wrapper->stream_open(__FILE__, 'r');
    $this->assertTrue($this->wrapper->stream_seek(3, SEEK_SET));
    $this->assertEquals(3, $this->wrapper->stream_tell());
    $this->assertTrue($this->wrapper->stream_seek(2, SEEK_CUR));
    $this->assertEquals(5, $this->wrapper->stream_tell());
  }

  public function testStream_stat()
  {
    $this->wrapper->stream_open(__FILE__, 'r');
    $this->assertType(PHPUnit_Framework_Constraint_IsType::TYPE_ARRAY, $this->wrapper->stream_stat());
  }

  public function testStream_tell()
  {
    $this->wrapper->stream_open(__FILE__, 'r');
    $this->wrapper->stream_seek(3, SEEK_SET);
    $this->assertEquals(3, $this->wrapper->stream_tell());
  }

  public function testUrl_stat()
  {
    $this->assertType(PHPUnit_Framework_Constraint_IsType::TYPE_ARRAY, $this->wrapper->url_stat(__FILE__));
  }

  protected function setUp()
  {
    $this->wrapper = new Stream_Wrapper_ReadOnlyFile_Local();
  }
}


