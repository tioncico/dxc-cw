<?php

namespace EasySwoole\HttpAnnotation\Tests;


use EasySwoole\HttpAnnotation\Exception\Annotation\ParamValidateError;
use EasySwoole\HttpAnnotation\Tests\TestController\Param;
use PHPUnit\Framework\TestCase;

class ParamTest extends TestCase
{
    use ControllerBase;

    protected $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = new Param();
    }

    public function testClassAuthError()
    {
        $response = $this->fakeResponse();
        $this->expectException(ParamValidateError::class);
        $this->expectExceptionMessage("validate fail for column groupAuth");
        $this->controller->__hook('index', $this->fakeRequest(), $response);
        $this->fail("test class auth error fail");
    }

    public function testOnRequestAuthError()
    {
        $response = $this->fakeResponse();
        $this->expectException(ParamValidateError::class);
        $this->expectExceptionMessage("validate fail for column onRequestAuth");
        $this->controller->__hook('index', $this->fakeRequest('/',
            ['groupAuth' => 1, 'groupParam' => 1]
        ), $response);
        $this->fail("test onRequest auth error fail");
    }

    public function testOnRequestParamError()
    {
        $response = $this->fakeResponse();
        $this->expectException(ParamValidateError::class);
        $this->expectExceptionMessage("validate fail for column onRequestParam");
        $this->controller->__hook('index', $this->fakeRequest('/',
            ['groupAuth' => 1, 'groupParam' => 1, 'onRequestAuth' => 1]
        ), $response);
        $this->fail("test onRequest param error fail");
    }

    public function testIndexAuthError()
    {
        $response = $this->fakeResponse();
        $this->expectException(ParamValidateError::class);
        $this->expectExceptionMessage("validate fail for column auth");
        $this->controller->__hook('index', $this->fakeRequest('/',
            ['groupAuth' => 1, 'groupParam' => 1, 'onRequestAuth' => 1, 'onRequestParam' => 1]
        ), $response);
        $this->fail("test index auth error fail");
    }

    public function testIndexParamError()
    {
        $response = $this->fakeResponse();
        $this->expectException(ParamValidateError::class);
        $this->expectExceptionMessage("validate fail for column param");
        $this->controller->__hook('index', $this->fakeRequest('/',
            ['groupAuth' => 1, 'groupParam' => 1, 'onRequestAuth' => 1, 'onRequestParam' => 1, 'auth' => 1]
        ), $response);
        $this->fail("test index param error fail");
    }

    public function testSuccess()
    {
        $response = $this->fakeResponse();
        $this->controller->__hook('index', $this->fakeRequest('/',
            ['groupAuth' => 1, 'groupParam' => 1, 'onRequestAuth' => 1, 'onRequestParam' => 1, 'auth' => 1, 'param' => 1]
        ), $response);
        $this->assertEquals(
            json_encode([
                'groupAuth' => 1,
                'groupParam' => 1,
                'onRequestAuth' => 1,
                'onRequestParam' => 1,
                'auth' => 1,
                'param' => 1,
                'groupParamA' => 'groupParamA',
                'groupParamB' => 'groupParamB'
            ]),
            $response->getBody()->__toString());
    }

    public function testLessThanWithColumn()
    {
        $response = $this->fakeResponse();
        $this->controller->__hook('lessThanWithColumn', $this->fakeRequest('/',
            ['groupAuth' => 1, 'groupParam' => 1, 'onRequestAuth' => 1, 'onRequestParam' => 1, 'auth' => 1, 'param' => 1, 'foo' => 1, 'bar' => 2]
        ), $response);
        $this->assertTrue(true);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("foo必须小于'bar'的值");
        $this->controller->__hook('lessThanWithColumn', $this->fakeRequest('/',
            ['groupAuth' => 1, 'groupParam' => 1, 'onRequestAuth' => 1, 'onRequestParam' => 1, 'auth' => 1, 'param' => 1, 'foo' => 3, 'bar' => 2]
        ), $response);

        $this->fail('test lessThanWithColumn fail');
    }

    public function testGreaterThanWithColumn()
    {
        $response = $this->fakeResponse();
        $this->controller->__hook('greaterThanWithColumn', $this->fakeRequest('/',
            ['groupAuth' => 1, 'groupParam' => 1, 'onRequestAuth' => 1, 'onRequestParam' => 1, 'auth' => 1, 'param' => 1, 'foo' => 3, 'bar' => 2]
        ), $response);
        $this->assertTrue(true);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("foo必须大于'bar'的值");
        $this->controller->__hook('greaterThanWithColumn', $this->fakeRequest('/',
            ['groupAuth' => 1, 'groupParam' => 1, 'onRequestAuth' => 1, 'onRequestParam' => 1, 'auth' => 1, 'param' => 1, 'foo' => 1, 'bar' => 2]
        ), $response);

        $this->fail('test lessThanWithColumn fail');
    }
}
