<?php
/*
 * Copyright 2012-2015 Damien Seguy – Exakat Ltd <contact(at)exakat.io>
 * This file is part of Exakat.
 *
 * Exakat is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Exakat is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with Exakat.  If not, see <http://www.gnu.org/licenses/>.
 *
 * The latest code can be found at <http://exakat.io/>.
 *
*/


namespace Analyzer\Functions;

use Analyzer;

class DeepDefinitions extends Analyzer\Analyzer {
    public function dependsOn() {
        return array('Functions/Closures');
    }
    
    public function analyze() {
        $this->atomIs('Function')
             ->analyzerIsNot('Functions/Closures')
             ->goToFunction()
             ->back('first');
        $this->prepareQuery();

        $this->atomIs('Class')
             ->goToFunction()
             ->back('first');
        $this->prepareQuery();

        $this->atomIs('Interface')
             ->goToFunction()
             ->back('first');
        $this->prepareQuery();

        $this->atomIs('Trait')
             ->goToFunction()
             ->back('first');
        $this->prepareQuery();

        $this->atomIs('Const')
             ->goToFunction()
             ->back('first');
        $this->prepareQuery();

        // define ? Constants are OK.
    }
}

?>
