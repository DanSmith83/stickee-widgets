<?php

use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    public function testInitialisation()
    {
        $calculator = new \Widgets\Calculator([5, 2, 10, 1, 5, 10, 2, 2, 1]);

        $this->assertEquals([1, 2, 5, 10], $calculator->getOptions());
    }
}
