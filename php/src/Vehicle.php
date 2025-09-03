<?php

declare(strict_types=1);

abstract class Vehicle {

    protected int $numberOfWheels;

    protected int $maxNumberOfPersons;

    protected string|null $manufacturer = null;


    public function __toString(): string
    {
        $className = get_class($this);

        if (null !== $this->getManufacturer()) {
            $className .= " of type {$this->getManufacturer()}";
        }

        return "This {$className} has {$this->getNumberOfWheels()} wheels and can carry a maximum of {$this->getMaxNumberOfPersons()} persons.";
    }

    /**
     * @throws Exception
     */
    public function setNumberOfWheels(int $wheels): self
    {
        if (0 >= $wheels) {
            throw new Exception('Number of wheels must be greater than zero.');
        }

        $this->numberOfWheels = $wheels;

        return $this;
    }

    public function getNumberOfWheels(): int
    {
        return $this->numberOfWheels;
    }

    public function getMaxNumberOfPersons(): int
    {
        return $this->maxNumberOfPersons;
    }

    /**
     * @throws Exception
     */
    public function setMaxNumberOfPersons(int $maxNumberOfPersons): self
    {
        if (0 > $maxNumberOfPersons) {
            throw new Exception('Max number of persons must be zero or greater.');
        }

        $this->maxNumberOfPersons = $maxNumberOfPersons;

        return $this;
    }

    public function getManufacturer(): string|null
    {
        return $this->manufacturer;
    }

    public function setManufacturer(string $manufacturer): self
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }




}