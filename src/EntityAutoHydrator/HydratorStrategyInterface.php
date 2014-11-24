<?php

namespace EntityAutoHydrator;

/**
 * Interface ArrayObjectMappingInterface
 *
 * @author Phil Burnett
 */
interface HydratorStrategyInterface
{
    /**
     * @param array $arrayToMap
     * @param string $canonicalClassName
     * @return mixed
     */
    public function hydrate(array $arrayToMap, $canonicalClassName);
}
