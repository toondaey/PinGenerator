<?php 

namespace Tests\Feature;

use Tests\TestCase;
use Toonday\NumberGenerator\NumberGenerator;

class FeatureTests extends TestCase {

    /**
     * Test that numbers generated will not include a zero when the "noZero" method is called.
     * 
     * @test
     * @return void
     */
    function generatorWillNotIncludeZero() {

        $generator = new NumberGenerator;

        $actual = $generator->copy()->noZero()->generate();

        $this->assertRegExp("/\A(?![^0]*+0)/", $actual);

        return $generator;
    }

    /**
     * Test if numbers generated with default initializers are 6.
     * 
     * @test
     * @depends generatorWillNotIncludeZero
     * @param  \NumberGenerator\NumberGenerator $generator
     * @return void
     */
    function generateRandomCharacters (NumberGenerator $generator) {

        $numbers = $generator->generate();

        $actual = strlen($numbers);

        $this->assertEquals(6, $actual);
    }

    /**
     * Test that characters generated will not be repeated when specifically stated.
     * 
     * @test
     * @depends generatorWillNotIncludeZero
     * @param  \NumberGenerator\NumberGenerator $generator
     * @return void
     */
    function generateNoRepeatingCharacters(NumberGenerator $generator) {

        $generator = $generator->noRepeat();

        $actual = "1234513";

        $this->assertRegExp("/\A(\d)(?!\g{1})/", $actual);
    }
}
