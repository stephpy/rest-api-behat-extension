<?php

namespace Rezzza\RestApiBehatExtension\Json;

use Behat\Behat\Context\Argument\ArgumentResolver;

class JsonInspectorResolver implements ArgumentResolver
{
    private $jsonInspector;

    public function __construct(JsonInspector $jsonInspector)
    {
        $this->jsonInspector = $jsonInspector;
    }

    public function resolveArguments(\ReflectionClass $classReflection, array $arguments)
    {
        $constructor = $classReflection->getConstructor();
        if ($constructor === null) {
            return $arguments;
        }

        $parameters = $constructor->getParameters();
        foreach ($parameters as $parameter) {
            if (null !== $parameter->getClass() && $parameter->getClass()->name === 'Rezzza\RestApiBehatExtension\Json\JsonInspector') {
                $arguments[$parameter->name] = $this->jsonInspector;
            }
        }

        return $arguments;
    }
}
