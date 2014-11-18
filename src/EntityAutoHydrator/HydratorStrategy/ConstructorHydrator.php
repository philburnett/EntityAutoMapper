<?php

namespace ArrayMapper\Hydrator;

use ArrayMapper\ArrayToObjectHydratorInterface;
use InvalidArgumentException;
use ReflectionClass;

/**
 * Class ConstructorInjectionStrategy
 *
 * @author Phil Burnett <phil.burnett@valtech.co.uk>
 */
class ConstructorHydratorStrategy implements ArrayToObjectHydratorInterface
{
    /**
     * @param array $arrayToMap
     * @param string $canonicalClassName
     * @return mixed
     */
    public function mapArrayToClass(array $arrayToMap, $canonicalClassName)
    {
        if (!class_exists($canonicalClassName)) {
            throw new InvalidArgumentException(
                '$canonicalClassName (' . $canonicalClassName . ') is not a valid class name'
            );
        }

        $reflectionClass = new ReflectionClass($canonicalClassName);

        $constructorArguments = $reflectionClass->getConstructor()->getParameters();
        $hydratedConstructorArguments = [];

        foreach ($constructorArguments as $constructorArgument) {
            $constructorName = $constructorArgument->getName();
            $constructorClass = $constructorArgument->getClass();

            $hydratedConstructorArguments[$constructorName] = $arrayToMap[$constructorName];

            if (!is_null($constructorClass)) {
                $hydratedConstructorArguments[$constructorName]
                    = $this->mapArrayToClass(
                    $arrayToMap[$constructorName],
                    $constructorClass->getName()
                );

            }
        }

        $mappedObject = $reflectionClass->newInstanceArgs($hydratedConstructorArguments);
        return $mappedObject;
    }
}

