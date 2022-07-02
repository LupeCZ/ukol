<?php

namespace MichaelaKarkosova\Calculator;

class NumberFactoryClass {

    public function create($number) : NumberInterface {
        if (is_numeric($number)) {
            return new Number($number);
        }
        $number = str_replace(" ", "/", $number);
        $convertedFraction = explode("/", $number);
        if (count($convertedFraction) > 2) {
            return new MixedFraction((int) $convertedFraction[0], (int) $convertedFraction[1], (int) $convertedFraction[2]);
        }
        return new Fraction((int) $convertedFraction[0], (int) $convertedFraction[1]);

    }
}