<?php

namespace EntityAutoHydrator\HydratorStrategy;

use EntityAutoHydrator\HydratorStrategyInterface;

/**
 * Class SetterHydrator
 *
 * @author Phil Burnett
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
        // @todo
        $setterMap = $this->getSetters($arrayToMap);
    }


    private function getSetters(array $arrayToMap)
    {

    }
}
