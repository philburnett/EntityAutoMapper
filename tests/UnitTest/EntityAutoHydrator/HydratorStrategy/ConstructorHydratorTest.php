<?php

namespace UnitTest\HydratorStrategy\HydratorStrategy;

use EntityAutoHydrator\HydratorStrategy\ConstructorHydrator;
use PHPUnit_Framework_TestCase;
use UnitTest\EntityAutoHydrator\ATestClass;

/**
 * Class ConstructorHydratorTest
 *
 * @package UnitTest\HydratorStrategy\HydratorStrategy
 */
class ConstructorHydratorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var array
     */
    protected $testArray = [
        'string' => 'foo',
        'array'  => [
            'stringOne' => 'bar',
            'stringTwo' => 'baz',
        ],
        'anotherClass' => [
            'string' => 'badgers',
        ]
    ];

    public function testMapArrayToClass()
    {
        $cms        = new ConstructorHydrator();
        /** @var ATestClass $testObject */
        $testObject = $cms->hydrate($this->testArray, 'UnitTest\EntityAutoHydrator\ATestClass');
        $testArray  = $testObject->getArray();

        $this->assertInstanceOf('UnitTest\EntityAutoHydrator\ATestClass', $testObject);
        $this->assertEquals('foo', $testObject->getString());
        $this->assertArrayHasKey('stringOne', $testArray);
        $this->assertArrayHasKey('stringTwo', $testArray);
        $this->assertEquals('bar', $testArray['stringOne']);
        $this->assertEquals('baz', $testArray['stringTwo']);
        $this->assertInstanceOf('UnitTest\EntityAutoHydrator\AnotherTestClass', $testObject->getAnotherClass());
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage $canonicalClassName (UnitTest\EntityAutoHydrator\BTestClass) is not a valid class name
     */
    public function testThrowExceptionInvalidClassName()
    {
        $cms        = new ConstructorHydrator();
        $cms->hydrate($this->testArray, 'UnitTest\EntityAutoHydrator\BTestClass');
    }
}
