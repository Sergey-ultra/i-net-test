<?php

declare(strict_types=1);

class SomeObject {
    protected string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getObjectName(): string
    {
        return $this->name;
    }
}

class SomeObjectWithHandlers extends SomeObject
{
    public function getHandlerName():string
    {
       return 'handle_'. $this->getObjectName();
    }
}

class SomeObjectsHandler {
    public function __construct() { }

    public function handleObjects(array $objects): array {
        $handlers = [];
        foreach ($objects as $object) {
            $handlers[] = $object->getHandlerName();
        }

        return $handlers;
    }
}

$objects = [
    new SomeObjectWithHandlers('object_1'),
    new SomeObjectWithHandlers('object_2')
];

$soh = new SomeObjectsHandler();
$soh->handleObjects($objects);
