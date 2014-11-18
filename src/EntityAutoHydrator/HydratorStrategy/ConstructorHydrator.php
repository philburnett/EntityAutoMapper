<?php

namespace EntityAutoHydrator\HydratorStrategy;

use EntityAutoHydrator\HydratorStrategyInterface;
use InvalidArgumentException;
use ReflectionClass;

/**
 * Class ConstructorInjectionStrategy
 *
 * @author Phil Burnett <phil.burnett@valtech.co.uk>
 */
class ConstructorHydrator implements HydratorStrategyInterface
{
    /**
     * @param array $arrayToMap
     * @param $canonicalClassName
     * @return object
     */
    public function hydrate(array $arrayToMap, $canonicalClassName)
    {
        if (!class_exists($canonicalClassName)) {
            throw new InvalidArgumentException(
                '$canonicalClassName (' . $canonicalClassName . ') is not a valid class name'
            );
        }

        $reflectionClass = new ReflectionClass($canonicalClassName);

        $constructorArguments = $reflectionClass->getConstructor()->getParameters();
        $hydratedArguments = [];

        foreach ($constructorArguments as $constructorArgument) {
            $constructorName  = $constructorArgument->getName();
            $constructorClass = $constructorArgument->getClass();

            $hydratedArguments[$constructorName] = $arrayToMap[$constructorName];

            if (!is_null($constructorClass)) {
                $hydratedArguments[$constructorName]
                    = $this->hydrate(
                        $arrayToMap[$constructorName],
                        $constructorClass->getName()
                    );
            }
        }

        $mappedObject = $reflectionClass->newInstanceArgs($hydratedArguments);
        return $mappedObject;
    }
}
