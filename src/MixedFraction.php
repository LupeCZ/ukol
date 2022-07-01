<?php

namespace LupeCz\Calculator;

class MixedFraction implements FractionInterface{

	protected int $wholeNumber;

	protected int $numerator;

	protected int $denominator;

	public function __construct(int $wholeNumber, int $numerator, int $denominator) {
		$this->wholeNumber = $wholeNumber;
		$this->numerator = $numerator;
		$this->denominator = $denominator;
	}

	public function getWholeNumber(): int {
		return $this->wholeNumber;
	}

	public function getNumerator(): int {
		return $this->numerator;
	}

	public function getDenominator(): int {
		return $this->denominator;
	}

	public function getResult() : string {
		$num = $this->getNumerator();
		$den = $this->getDenominator();
		$whole = $this->getWholeNumber();

		if ($whole === 0) {
			return $num . "/" . $den;
		}

		if ($num === 0){
			return $whole;
		}

		return $whole . " " . $num . "/" . $den;
	}

	public function toSimpleFraction(): Fraction {
		$numerator = (abs($this->wholeNumber) * $this->denominator) + $this->numerator;

		if ($this->wholeNumber < 0) {
			$numerator *= -1;
		}

		return new Fraction($numerator, $this->denominator);
	}

	public function toMixedFraction(): MixedFraction {
		return new self($this->wholeNumber, $this->numerator, $this->denominator);
	}
}
