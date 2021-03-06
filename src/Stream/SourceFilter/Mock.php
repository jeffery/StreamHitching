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
 * Mock Stream_Source_Filter implementation
 *
 * @package    StreamHitching
 * @subpackage filter
 * @author     Christian Schaefer <caefer@ical.ly>
 */
class Stream_SourceFilter_Mock extends Stream_SourceFilter_Abstract
  implements Stream_SourceFilter_Interface
{
  /**
   * Accessor to the current objects options array.
   * @see Stream_SourceFilter_Interface
   *
   * @param  string $url Real url to be encoded
   * @return string      Stream URL (custom://...)
   */
  public function encode($url)
  {
    $this->options['orig_protocol'] = 'file';
    if(preg_match('#^([^:]*)://#', $url, $matches))
    {
      $this->options['orig_protocol'] = $matches[1];
      return str_replace($this->options['orig_protocol'].'://', $this->options['protocol'].'://', $url);
    }
    return $this->options['protocol'].'://'.$url;
  }

  /**
   * Accessor to the current objects options array.
   * @see Stream_SourceFilter_Interface
   *
   * @param  string $url Stream URL (custom://...) to be decoded
   * @return string      Real url
   */
  public function decode($url)
  {
    if (isset($this->options['orig_protocol']) === false) {
      $this->options['orig_protocol'] = '';
    }

    return str_replace($this->options['protocol'].'://', $this->options['orig_protocol'].'://', $url);
  }
}
