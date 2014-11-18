<?php

namespace UnitTest\Hydrator\Hydrator;

use ArrayMapper\Hydrator\ConstructorHydrator;
use PHPUnit_Framework_TestCase;
use UnitTest\ArrayMapper\ATestClass;

/**
 * Class ConstructorHydratorTest
 *
 * @package UnitTest\Hydrator\Hydrator
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
        $testObject = $cms->mapArrayToClass($this->testArray, 'UnitTest\ArrayMapper\ATestClass');
        $testArray  = $testObject->getArray();

        $this->assertInstanceOf('UnitTest\ArrayMapper\ATestClass', $testObject);
        $this->assertEquals('foo', $testObject->getString());
        $this->assertArrayHasKey('stringOne', $testArray);
        $this->assertArrayHasKey('stringTwo', $testArray);
        $this->assertEquals('bar', $testArray['stringOne']);
        $this->assertEquals('baz', $testArray['stringTwo']);
        $this->assertInstanceOf('UnitTest\ArrayMapper\AnotherTestClass', $testObject->getAnotherClass());
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage $canonicalClassName (UnitTest\ArrayMapper\BTestClass) is not a valid class name
     */
    public function testThrowExceptionInvalidClassName()
    {
        $cms        = new ConstructorHydrator();
        $cms->mapArrayToClass($this->testArray, 'UnitTest\ArrayMapper\BTestClass');
    }
}
