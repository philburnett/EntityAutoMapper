<?php

namespace UnitTest\EntityAutoHydrator;

/**
 * Class MapperTestClass
 *
 * @author Phil Burnett
 */
class AnotherTestClass
{
    private $string;

    /**
     * @var array
     */
    private $array;

    public function __construct(
        $string
    ) {
        $this->string = $string;
    }

    /**
     * @return array
     */
    public function getArray()
    {
        return $this->array;
    }

    /**
     * @return mixed
     */
    public function getString()
    {
        return $this->string;
    }
}
