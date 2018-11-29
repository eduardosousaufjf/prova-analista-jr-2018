<?php

namespace Core\Model;

use Zend\Hydrator\Reflection;

trait CoreModelTrait
{
    public function exchangeArray(array $data)
    {
        $reflection = new Reflection();
        $reflection->hydrate($data, $this);
    }

    public function getArrayCopy()
    {
        $reflection = new Reflection();
        return $reflection->extract($this);
    }
}