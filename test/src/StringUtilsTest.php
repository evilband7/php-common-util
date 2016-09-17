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
        $this->assertTrue(StringUtils::endsWith('testtest', 'test'));
        $this->assertTrue(StringUtils::endsWith('testtest', 'testtest'));
        $this->assertFalse(StringUtils::endsWith('testtest', 'testtesttesttest'));
    }

}