<?php

namespace MichaelaKarkosova\Calculator\Tests\Cases;

use MichaelaKarkosova\Calculator\FractionInterface;
use MichaelaKarkosova\Calculator\Math;
use MichaelaKarkosova\Calculator\NumberFactory;
use MichaelaKarkosova\Calculator\Operation;
use Tester\Assert;
use Tester\TestCase;
use MichaelaKarkosova\Calculator\Number;
use MichaelaKarkosova\Calculator\Fraction;
use MichaelaKarkosova\Calculator\MixedFraction;

require __DIR__ . "/../bootstrap.php";

final class OperationTest extends TestCase {

    private Operation $operation;
    private Math $math;
    private NumberFactory $numberFactory;

    private FractionInterface $result1;
    private FractionInterface  $result2;
    private FractionInterface  $result3;
    private FractionInterface  $result4;
    private FractionInterface  $result5;
    private FractionInterface  $result6;
    private FractionInterface  $result7;
    private FractionInterface  $result8;
    private FractionInterface  $result9;
    private FractionInterface  $result10;

    protected function setUp(): void {
        parent::setUp();

        $this->operation = new Operation();
        $this->numberFactory = new NumberFactory();
        $this->math = new Math($this->operation, $this->numberFactory);
    }

    public function testOperationAdd() : void {

        $this->result1 = $this->math->subtract("5/10", "5 20/3");
        Assert::same("-67/6", $this->result1->getResult());
        $this->result1 = $this->math->add("5/10", "5 10/20");
        $this->result2 = $this->math->add("15/2", "10 6/2");
        $this->result3 = $this->math->add("-50/-30", "-20/-5");;
        $this->result4 = $this->math->add("-4 20/4", "10 6/2");
        $this->result5 = $this->math->add("-15/2", "6 12/2");
        $this->result6 = $this->math->add(5, "-6 12/2");
        $this->result7 = $this->math->add("-15/2", -50);
        $this->result8 = $this->math->add(5, -50);
        $this->result9 = $this->math->add(-15, -45);
        $this->result10 = $this->math->add(-59, -95);

        Assert::same("6/1", $this->result1->getResult());
        Assert::same("41/2", $this->result2->getResult());
        Assert::same("17/3", $this->result3->getResult());
        Assert::same("4/1", $this->result4->getResult());
        Assert::same("9/2", $this->result5->getResult());
        Assert::same("-7/1", $this->result6->getResult());
        Assert::same("-115/2", $this->result7->getResult());
        Assert::same("-45/1", $this->result8->getResult());
        Assert::same("-60/1", $this->result9->getResult());
        Assert::same("-154/1", $this->result10->getResult());
    }

    public function testOperationSubtract() : void {
        $this->result1 = $this->math->subtract("5/10", "5 10/20");
        $this->result2 = $this->math->subtract("15/2", "10 6/2");
        $this->result3 = $this->math->subtract("-50/-30", "-20/-5");;
        $this->result4 = $this->math->subtract("-4 20/4", "10 6/2");
        $this->result5 = $this->math->subtract("-15/2", "6 12/2");
        $this->result6 = $this->math->subtract(5, "-6 12/2");
        $this->result7 = $this->math->subtract("-15/2", -50);
        $this->result8 = $this->math->subtract(5, -50);
        $this->result9 = $this->math->subtract(-15, -45);
        $this->result10 = $this->math->subtract(59, 95);

        Assert::same("-5/1", $this->result1->getResult());
        Assert::same("-11/2", $this->result2->getResult());
        Assert::same("-7/3", $this->result3->getResult());
        Assert::same("-22/1", $this->result4->getResult());
        Assert::same("-39/2", $this->result5->getResult());
        Assert::same("17/1", $this->result6->getResult());
        Assert::same("85/2", $this->result7->getResult());
        Assert::same("55/1", $this->result8->getResult());
        Assert::same("30/1", $this->result9->getResult());
        Assert::same("-36/1", $this->result10->getResult());
    }

    public function testOperationMultiply() : void {
        $this->result1 = $this->math->multiply("5/10", "5 10/20");
        $this->result2 = $this->math->multiply("15/2", "10 6/2");
        $this->result3 = $this->math->multiply("-50/-30", "-20/-5");;
        $this->result4 = $this->math->multiply("-4 20/4", "10 6/2");
        $this->result5 = $this->math->multiply("-15/2", "6 12/2");
        $this->result6 = $this->math->multiply(5, "-6 12/2");
        $this->result7 = $this->math->multiply("-15/2", -50);
        $this->result8 = $this->math->multiply(5, -50);
        $this->result9 = $this->math->multiply(-15, -45);
        $this->result10 = $this->math->multiply(59, 95);

        Assert::same("11/4", $this->result1->getResult());
        Assert::same("195/2", $this->result2->getResult());
        Assert::same("20/3", $this->result3->getResult());
        Assert::same("-117/1", $this->result4->getResult());
        Assert::same("-90/1", $this->result5->getResult());
        Assert::same("-60/1", $this->result6->getResult());
        Assert::same("375/1", $this->result7->getResult());
        Assert::same("-250/1", $this->result8->getResult());
        Assert::same("675/1", $this->result9->getResult());
        Assert::same("5605/1", $this->result10->getResult());
    }

    public function testOperationDivide() : void {
        $this->result1 = $this->math->divide("5/10", "5 10/20");
        $this->result2 = $this->math->divide("15/2", "10 6/2");
        $this->result3 = $this->math->divide("-50/-30", "-20/-5");;
        $this->result4 = $this->math->divide("-4 20/4", "10 6/2");
        $this->result5 = $this->math->divide("-15/2", "6 12/2");
        $this->result6 = $this->math->divide(5, "-6 12/2");
        $this->result7 = $this->math->divide("-15/2", -50);
        $this->result8 = $this->math->divide(5, -50);
        $this->result9 = $this->math->divide(-15, -45);
        $this->result10 = $this->math->divide(59, 95);

        Assert::same("1/11", $this->result1->getResult());
        Assert::same("15/26", $this->result2->getResult());
        Assert::same("5/12", $this->result3->getResult());
        Assert::same("-9/13", $this->result4->getResult());
        Assert::same("-5/8", $this->result5->getResult());
        Assert::same("-5/12", $this->result6->getResult());
        Assert::same("3/20", $this->result7->getResult());
        Assert::same("-1/10", $this->result8->getResult());
        Assert::same("1/3", $this->result9->getResult());
        Assert::same("59/95", $this->result10->getResult());
    }
}
(new OperationTest())->run();