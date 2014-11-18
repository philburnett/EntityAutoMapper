<?php

namespace UnitTest\ArrayMapper;

/**
 * Class MapperTestClass
 *
 * @author Phil Burnett <phil.burnett@valtech.co.uk>
 */
class ATestClass
{
    /**
     * @var string
     */
    private $string;

    /**
     * @var array
     */
    private $array;

    /**
     * @var AnotherTestClass
     */
    private $anotherClass;

    public function __construct(
        $string,
        array $array,
        AnotherTestClass $anotherClass
    ) {
        $this->string       = $string;
        $this->array        = $array;
        $this->anotherClass = $anotherClass;
    }

    /**
     * @return array
     */
    public function getArray()
    {
        return $this->array;
    }

    /**
     * @return string
     */
    public function getString()
    {
        return $this->string;
    }

    /**
     * @return AnotherTestClass
     */
    public function getAnotherClass()
    {
        return $this->anotherClass;
    }
}
