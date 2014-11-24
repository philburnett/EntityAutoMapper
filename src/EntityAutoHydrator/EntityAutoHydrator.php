<?php

namespace ArrayMapper;

/**
 * Class ArrayMapper
 *
 * @author Phil Burnett
 */
class EntityAutoHydrator
{
    /**
     * @var ArrayToObjectHydratorInterface
     */
    private $mappingStrategy;

    public function __construct(
        ArrayToObjectHydratorInterface $mappingStrategy
    ) {
        $this->mappingStrategy = $mappingStrategy;
    }

    public function map()
    {

    }
}
