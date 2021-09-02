<?php
/**
 * Created by PhpStorm.
 * User: Tioncico
 * Date: 2019/12/6 0006
 * Time: 15:18
 */

include "../../vendor/autoload.php";
include "../../phpunit2.php";

$a = new \EasySwoole\Spl\SplStream('abcdefg');
var_dump($a->getContents());
var_dump($a->__toString());

