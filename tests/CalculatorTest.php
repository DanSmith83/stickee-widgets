<?php

use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    public function setUp()
    {
        $this->calculator = new \Widgets\Calculator([250, 500, 1000, 2000, 5000]);
    }
    
    public function testInitialisation()
    {
        $calculator = new \Widgets\Calculator([250, 1000, 500, 2000, 5000, 5000, 1000, 250, 1000, 'Foo', 'Bar']);

        $this->assertEquals([5000, 2000, 1000, 500, 250], $calculator->getOptions());
    }


    public function testCalculation1()
    {

        $this->assertEquals([
            250  => 1,
        ], $this->calculator->calculateRequirements(1));
    }

    public function testCalculation250()
    {
        $this->assertEquals([
            250  => 1,
        ], $this->calculator->calculateRequirements(250));
    }

    public function testCalculation251()
    {
        $this->assertEquals([
            500  => 1,
        ], $this->calculator->calculateRequirements(251));
    }

    public function testCalculation499()
    {
        $this->assertEquals([
            500  => 1,
        ], $this->calculator->calculateRequirements(499));
    }

    public function testCalculation501()
    {
        $this->assertEquals([
            500  => 1,
            250  => 1,
        ], $this->calculator->calculateRequirements(501));
    }

    public function testCalculation751()
    {
        $this->assertEquals([
            500  => 2,
        ], $this->calculator->calculateRequirements(751));
    }

    public function testCalculation999()
    {
        $this->assertEquals([
            500  => 2,
        ], $this->calculator->calculateRequirements(999));
    }


    public function testCalculation12001()
    {
        $this->assertEquals([
            5000 => 2,
            2000 => 1,
            250  => 1,
        ], $this->calculator->calculateRequirements(12001));
    }
}
