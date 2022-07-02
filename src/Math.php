<?php

namespace MichaelaKarkosova\Calculator;

class Math {
    private Operation $operation;
    private NumberFactoryClass $numberFactory;

    public function __construct(Operation $operation) {
        $this->operation = $operation;
        $this->numberFactory = new NumberFactoryClass();
    }

    public function add($numberA, $numberB): FractionInterface {

        return $this->operation->add(
            $this->numberFactory->create($numberA),
            $this->numberFactory->create($numberB),
        );
    }
    public function subtract($numberA, $numberB): FractionInterface {

        return $this->operation->subtract(
            $this->numberFactory->create($numberA),
            $this->numberFactory->create($numberB),
        );
    }

    public function multiply($numberA, $numberB): FractionInterface {

        return $this->operation->multiply(
            $this->numberFactory->create($numberA),
            $this->numberFactory->create($numberB),
        );
    }

    public function divide($numberA, $numberB): FractionInterface {

        return $this->operation->divide(
            $this->numberFactory->create($numberA),
            $this->numberFactory->create($numberB),
        );
    }
}