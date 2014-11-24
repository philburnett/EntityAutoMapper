<?php

namespace UnitTest\EntityAutoHydrator;

/**
 * Class MapperTestClass
 *
 * @author Phil Burnett
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

    /**
     * @var AnotherTestClass
     */
    private $optionalClass;

    public function __construct(
        $string,
        array $array,
        AnotherTestClass $anotherClass,
        AnotherTestClass $optionalClass = null
    ) {
        $this->string        = $string;
        $this->array         = $array;
        $this->anotherClass  = $anotherClass;
        $this->optionalClass = $optionalClass;
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
