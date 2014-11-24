<?php

namespace UnitTest\HydratorStrategy\HydratorStrategy;

use EntityAutoHydrator\HydratorStrategy\ConstructorHydrator;
use PHPUnit_Framework_TestCase;
use UnitTest\EntityAutoHydrator\ATestClass;
use EntityAutoHydrator\Exception\MissingArgumentException;

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
        'array'  => [
            'stringOne' => 'bar',
            'stringTwo' => 'baz',
        ],
        'anotherClass' => [
            'string' => 'badgers',
        ],
        'string' => 'foo',
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
     * @expectedExceptionMessage $className (UnitTest\EntityAutoHydrator\BTestClass) is not a valid class name
     */
    public function testThrowExceptionInvalidClassName()
    {
        $cms        = new ConstructorHydrator();
        $cms->hydrate($this->testArray, 'UnitTest\EntityAutoHydrator\BTestClass');
    }

    /**
     * @expectedException EntityAutoHydrator\Exception\MissingArgumentException
     * @expectedExceptionMessage Could not locate suitable array key for constructor argument
     */
    public function testMissingParameter()
    {
        unset($this->testArray['array']);

        $cms        = new ConstructorHydrator();
        $cms->hydrate($this->testArray, 'UnitTest\EntityAutoHydrator\ATestClass');
    }
}
