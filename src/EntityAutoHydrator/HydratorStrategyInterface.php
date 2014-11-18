<?php

namespace EntityAutoHydrator;

/**
 * Interface ArrayObjectMappingInterface
 *
 * @author Phil Burnett <phil.burnett@valtech.co.uk>
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
