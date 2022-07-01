<?php
namespace Fraction;

use InvalidArgumentException;

interface NumberInterface {
    public function toSimpleFraction() : Fraction;
}

interface FractionInterface extends NumberInterface {
    public function getNumerator(): int;
    public function getResult() : string;
    public function getDenominator(): int;
    public function toSimpleFraction() : Fraction;
    public function toMixedFraction() : MixedFraction;
}



final class Fraction implements FractionInterface {

    private int $numerator;
    private int $denominator;

    public function __construct(int $numerator, int $denominator) {
        if ($denominator == 0) {
            throw new InvalidArgumentException('Dividing by zero!');
        }
        $this->denominator = $denominator;
        $this->numerator = $numerator;
    }
    public function getResult() : string{
        return $this->getNumerator() . '/' . $this->getDenominator();
    }
   public function toMixedFraction(): MixedFraction {
       $diff = (int) floor($this->numerator / $this->denominator);
       $this->numerator -= ($diff * $this->denominator);
       return new MixedFraction($diff, $this->numerator, $this->denominator);
   }
    public function toSimpleFraction(): Fraction
    {
        return new self($this->numerator, $this->denominator);
    }

    /**
     * @return int
     */
    public function getNumerator(): int
    {
        return $this->numerator;
    }

    /**
     * @return int
     */
    public function getDenominator(): int
    {
        return $this->denominator;
    }

    public function reduce() : Fraction{
        $numerator = $this->numerator;
        $denominator = $this->denominator;
        $gdc = gmp_gcd($numerator, $denominator);
        $denominator /= gmp_strval($gdc);
        $numerator /= gmp_strval($gdc);
        $this->numerator = $numerator;
        $this->denominator = $denominator;
        return new Fraction($numerator, $denominator);
    }

}
class MixedFraction implements FractionInterface{

    protected int $wholeNumber;
    protected int $numerator1;
    protected int $numerator2;
    protected int $denominator2;
    public function getNumerator(): int {
        return $this->numerator;
    }
    protected function getWholeNumber(): int {
        return $this->wholeNumber;
    }

    public function getResult() : string
    {
        $num = $this->getNumerator();
        $den = $this->getDenominator();
        $whole = $this->getWholeNumber();

        if ($whole <= 0) {
            return $num . "/" . $den;
        }
        else if ($num <= 0){
            return $whole;
        }
        return $whole . " " . $num . "/" . $den;
    }
    public function getDenominator(): int {
        return $this->denominator;
    }

    public function __construct(int $wholeNumber, int $numerator, int $denominator) {
        $this->denominator = $denominator;
        $this->numerator = $numerator;
        $this->wholeNumber = $wholeNumber;
    }


    public function toSimpleFraction(): Fraction {
        $fraction1Numerator = $this->wholeNumber;
        $fraction2Numerator = $this->numerator;
        $fraction1Denominator = 1;
        $fraction2Denominator = $this->denominator;
        //Least common multiple
        $lcm = gmp_lcm($fraction1Denominator, $fraction2Denominator);
        $fraction1NumeratorNew = $fraction1Numerator * $fraction2Denominator;
        $fraction2NumeratorNew = $fraction2Numerator * $fraction1Denominator;
        $fractionResultNumerator =   $fraction1NumeratorNew+  $fraction2NumeratorNew;
        return new Fraction($fractionResultNumerator, gmp_strval($lcm));
        //  return new Fraction()
    }

    public function toMixedFraction(): MixedFraction {
       return new self($this->wholeNumber, $this->numerator, $this->denominator);
    }
}

interface OperationsInterface{
    public function add(NumberInterface $fraction, NumberInterface $fraction2) : FractionInterface;
    public function multiply(NumberInterface $fraction, NumberInterface $fraction2) : FractionInterface;
    public function divide(NumberInterface $fraction, NumberInterface $fraction2) : FractionInterface;
    public function substract(NumberInterface $fraction, NumberInterface $fraction2) : FractionInterface;
}
final class Operation implements OperationsInterface {

    public function add($fraction, $fraction2) : FractionInterface{
        $fraction = $fraction->toSimpleFraction();
        $fraction2 = $fraction2->toSimpleFraction();
        $fraction1Numerator = $fraction->getNumerator();
        $fraction2Numerator = $fraction2->getNumerator();
        $fraction1Denominator = $fraction->getDenominator();
        $fraction2Denominator = $fraction2->getDenominator();
        //Least common multiple
        $lcm = strval(gmp_lcm($fraction1Denominator, $fraction2Denominator));
        $fraction1NumeratorNew = $fraction1Numerator * ($lcm/$fraction1Denominator);
        $fraction2NumeratorNew = $fraction2Numerator * ($lcm/$fraction2Denominator);
        $fractionResultNumerator =   $fraction1NumeratorNew+  $fraction2NumeratorNew;
        $fraction = new Fraction($fractionResultNumerator, gmp_strval($lcm));
        $fraction->reduce();
        return $fraction;
    }
    public function substract($fraction, $fraction2) : FractionInterface{
        $fraction = $fraction->toSimpleFraction();
        $fraction2 = $fraction2->toSimpleFraction();
        $fraction1Numerator = $fraction->getNumerator();
        $fraction2Numerator = $fraction2->getNumerator();
        $fraction1Denominator = $fraction->getDenominator();
        $fraction2Denominator = $fraction2->getDenominator();
        //Least common multiple
        $lcm = strval(gmp_lcm($fraction1Denominator, $fraction2Denominator));
        $fraction1NumeratorNew = $fraction1Numerator * ($lcm/$fraction1Denominator);
        $fraction2NumeratorNew = $fraction2Numerator * ($lcm/$fraction2Denominator);
        $fractionResultNumerator =   $fraction1NumeratorNew - $fraction2NumeratorNew;
        $fraction = new Fraction($fractionResultNumerator, gmp_strval($lcm));
        $fraction->reduce();
        return $fraction;
    }
   public function multiply($fraction, $fraction2) :  FractionInterface{
       $fraction = $fraction->toSimpleFraction();
       $fraction2 = $fraction2->toSimpleFraction();
       $fraction1Numerator = $fraction->getNumerator();
       $fraction2Numerator = $fraction2->getNumerator();
       $fraction1Denominator = $fraction->getDenominator();
       $fraction2Denominator = $fraction2->getDenominator();
       $fractionNumeratorResult = $fraction1Numerator * $fraction2Numerator;
       $fractionDenominatorResult =$fraction1Denominator * $fraction2Denominator;
       $gdc = gmp_strval(gmp_gcd($fractionDenominatorResult, $fractionNumeratorResult));
       $fractionDenominatorResult =  $fractionDenominatorResult /$gdc;
       $fractionNumeratorResult =  $fractionNumeratorResult /$gdc;
       $fraction = new Fraction( $fractionNumeratorResult,  $fractionDenominatorResult);
       $fraction->reduce();
       return $fraction;
   }
    public function divide($fraction, $fraction2) :  FractionInterface{
        $fraction = $fraction->toSimpleFraction();
        $fraction2 = $fraction2->toSimpleFraction();
        $fraction1Numerator = $fraction->getNumerator();
        $fraction2Numerator = $fraction2->getNumerator();
        $fraction1Denominator = $fraction->getDenominator();
        $fraction2Denominator = $fraction2->getDenominator();
        $fractionNumeratorResultTemp =  $fraction1Numerator*1;
        $fractionDenominatorResultTemp = $fraction1Denominator*$fraction2Numerator;
        $fractionNumeratorResult =  $fractionNumeratorResultTemp*1;
        $fractionDenominatorResult = $fractionDenominatorResultTemp*$fraction2Denominator;
        $fractionResult = new Fraction( $fractionNumeratorResult, $fractionDenominatorResult);
        $fractionResult->reduce();
        return $fractionResult;
    }

    public function getResult() {
       return new self();
    }
}

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
