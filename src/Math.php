<?php

namespace MichaelaKarkosova\Calculator;

class Math {
    private Operation $operation;
    private NumberFactory $numberFactory;

    public function __construct(Operation $operation, NumberFactory $numberFactory) {
        $this->operation = $operation;
        $this->numberFactory = $numberFactory;
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