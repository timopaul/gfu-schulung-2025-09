<?php

declare(strict_types=1);

namespace App\DTOs;

abstract class AbstractDTO
{
    public function toArray(): array
    {
        $array = [];

        foreach (get_class_methods($this) as $method) {
            if (str_starts_with($method, 'get')) {
                $property = lcfirst(substr($method, 3));
                $array[$property] = $this->$method();
            }
        }

        return $array;
    }

    public function asOld(): self
    {
        $_SESSION['old'] = $this->toArray();

        return $this;
    }

}