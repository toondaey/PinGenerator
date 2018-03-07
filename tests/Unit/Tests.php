<?php 

namespace Tests\Unit;

use Tests\TestCase;
use NumberGenerator\NumberGenerator;

final class UnitTests extends TestCase {

    /**
     * Check if class initializes correctly.
     * 
     * @test
     * @return \NumberGenerator\NumberGenerator
     */
    function initRange () {

        $generator = new NumberGenerator;

        $this->assertCount(10, $generator->copy()->getRange());

        return $generator;
    }

    /**
     * Check if chars is set and is equal to default.
     * 
     * @test
     * @depends initRange
     * @return void
     */
    function initChars (NumberGenerator $generator) {

        $this->assertEquals(6, $generator->copy()->getChars());
    }

    /**
     * Check if character is set to maximum when class is initiated with 
     * a range greater than 10.
     * 
     * @test
     * @return void
     */
    function checkCharsIsGreaterThanSpecified () {

        $generator = new NumberGenerator(11);

        $this->assertEquals(10, $generator->getChars());
    }

    /**
     * Check if character is set to minimum when class is initiated with 
     * a range less than or equal to 0.
     * 
     * @test
     * @return void
     */
    function checkCharsIsLessThanSpecified () {

        $generator = new NumberGenerator(0);

        $this->assertEquals(4, $generator->getChars());
    }
}
