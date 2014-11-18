<?php

namespace EntityAutoHydrator\HydratorStrategy;

use EntityAutoHydrator\Exception\MissingArgumentException;
use EntityAutoHydrator\HydratorStrategyInterface;
use InvalidArgumentException;
use ReflectionClass;
use ReflectionParameter;

/**
 * Class ConstructorInjectionStrategy
 *
 * @author Phil Burnett <phil.burnett@valtech.co.uk>
 */
class ConstructorHydrator implements HydratorStrategyInterface
{
    /**
     * @param array $arrayToMap
     * @param $className
     * @return object
     */
    public function hydrate(array $arrayToMap, $className)
    {
        if (!class_exists($className)) {
            throw new InvalidArgumentException(
                '$className (' . $className . ') is not a valid class name'
            );
        }

        $reflectionClass = new ReflectionClass($className);

        $constructorArguments = $reflectionClass->getConstructor()->getParameters();
        $hydratedArguments = [];

        foreach ($constructorArguments as $constructorArgument) {

            $argName  = $constructorArgument->getName();
            $hydratedArguments[$argName] = $this->getArgument($constructorArgument, $arrayToMap);
        }

        $mappedObject = $reflectionClass->newInstanceArgs($hydratedArguments);
        return $mappedObject;
    }

    /**
     * @param ReflectionParameter $constructorArgument
     * @param $arrayToMap
     * @return object
     *
     * @throws MissingArgumentException
     */
    private function getArgument(ReflectionParameter $constructorArgument, $arrayToMap)
    {
        $constructorClass = $constructorArgument->getClass();

        $value = $this->findArrayValue($constructorArgument, $arrayToMap);

        if (!is_null($constructorClass)) {
            $value = $this->hydrate(
                $arrayToMap,
                $constructorClass->getName()
            );
        }
        return $value;
    }

    /**
     * @param ReflectionParameter $constructorArgument
     * @param array $arrayToSearch
     * @throws MissingArgumentException
     */
    private function findArrayValue(ReflectionParameter $constructorArgument, array $arrayToSearch)
    {
        $valueName = $constructorArgument->getName();

        if (array_key_exists($valueName, $arrayToSearch)) {
            return $arrayToSearch[$valueName];
        }

        if ($constructorArgument->isOptional()) {
            return $constructorArgument->getDefaultValue();
        }

        throw new MissingArgumentException(
            'Could not locate suitable array key for constructor argument $(' . $valueName . ')'
        );
    }
}
