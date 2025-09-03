<?php

declare(strict_types=1);

class Car extends Vehicle
{
    protected int $numberOfWheels = 4;

    protected int $maxNumberOfPersons = 5;

    protected int $numberOfDoors = 5;

    public function getNumberOfDoors(): int
    {
        return $this->numberOfDoors;
    }

    public function __toString(): string
    {
        $string = parent::__toString();

        $string .= " It has {$this->getNumberOfDoors()} doors.";

        return $string;
    }

    /**
     * @throws Exception
     */
    public function setNumberOfDoors(int $numberOfDoors): self
    {
        if (0 >= $numberOfDoors) {
            throw new Exception('Number of doors must be greater than zero.');
        }

        $this->numberOfDoors = $numberOfDoors;

        return $this;
    }


    static public function createCarFromManufacturer(string $manufacturer): static
    {
        $car = new static();
        $car->setManufacturer($manufacturer);

        return $car;
    }


}