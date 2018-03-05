<?php 

namespace Tests;

use NumberGenerator\NumberGenerator;

class FeatureTests extends TestCase {

    /**
     * Test if numbers generated with default initializers are 6.
     * 
     * @test
     * @param  \NumberGenerator\NumberGenerator $generator
     * @return void
     */
    function generateRandomCharacters () {

        $generator = new NumberGenerator;

        $numbers = $generator->copy()->generate();

        $actual = strlen($numbers);

        $this->assertEquals(6, $actual);

        return $generator;
    }

    /**
     * Test that numbers generated will not include a zero when the "noZero" method is called.
     * 
     * @test
     * @depends generateRandomCharacters
     * @param  \NumberGenerator\NumberGenerator $generator
     * @return void
     */
    function generatorWillNotIncludeZero(NumberGenerator $generator) {

        $generator = $generator->copy();

        $generate = $generator->noZero();
throw new \Exception(json_encode($generator->generate()));
        $actual = $generator->generate();

        $this->assertRegExp("/\A(?![^0]*+[0])/", $actual, $actual);
    }
}
