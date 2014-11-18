<?php

namespace EntityAutoHydrator\HydratorStrategy;

use EntityAutoHydrator\HydratorStrategyInterface;

/**
 * Class SetterHydrator
 *
 * @author Phil Burnett <phil.burnett@valtech.co.uk>
 */
class SetterHydrator implements HydratorStrategyInterface
{
    /**
     * @param array $arrayToMap
     * @param string $canonicalClassName
     * @return mixed
     */
    public function hydrate(array $arrayToMap, $canonicalClassName)
    {

    }
}
