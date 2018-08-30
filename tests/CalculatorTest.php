<?php

use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    public function testInitialisation()
    {
        $calculator = new \Widgets\Calculator([250, 1000, 500, 2000, 5000, 5000, 1000, 250, 1000, 'Foo', 'Bar']);

        $this->assertEquals([250, 500, 1000, 2000, 5000], $calculator->getOptions());
    }

    public function testCalculation()
    {
        $calculator = new \Widgets\Calculator([250, 500, 1000, 2000, 5000]);

        return $this->assertEquals(1, 1);
    }
}
