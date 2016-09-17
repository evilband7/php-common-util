<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 09/17/2016
 * Time: 6:46 PM
 */

namespace PhpCommonUtilTest\Util;


use PhpCommonUtil\Util\StringUtils;
use PhpCommonUtilTest\Util\Base\BaseTestCase;

class StringUtilsTest extends  BaseTestCase
{

    public function testEndsWith(){
        $this->assertTrue(StringUtils::endsWith('aaabbb', 'bbb'));
        $this->assertTrue(StringUtils::endsWith('aaabbb', 'aaabbb'));
        $this->assertFalse(StringUtils::endsWith('aaabbb', 'cccaaabbb'));
    }
    public function testStartsWith(){
        $this->assertTrue(StringUtils::startsWith('aaabbb', 'aaa'));
        $this->assertTrue(StringUtils::startsWith('aaabbb', 'aaabbb'));
        $this->assertFalse(StringUtils::startsWith('aaabbb', 'aaabbbccc'));
    }

}