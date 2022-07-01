<?php

use LupeCZ\Calculator\Operation;
use LupeCZ\Calculator\MixedFraction;
use LupeCZ\Calculator\Fraction;

$operationController = new Operation();
$mixedFraction2 = new MixedFraction(5, 40, 6);
$fraction2 = new Fraction(16,20);
$result = $operationController->multiply($mixedFraction2, $fraction2);
echo  "<p>".$result->toMixedFraction()->getResult()."</p>"; # x a/b
$result = $operationController->substract($mixedFraction2, $fraction2);
echo  "<p>".$result->toMixedFraction()->getResult()."</p>"; # x a/b
$result = $operationController->add($mixedFraction2, $fraction2);
echo  "<p>".$result->toMixedFraction()->getResult()."</p>"; # x a/b
$result = $operationController->divide($mixedFraction2, $fraction2);
echo  "<p>".$result->toMixedFraction()->getResult()."</p>"; # x a/b
