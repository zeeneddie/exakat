<?php
/*
 * Copyright 2012-2017 Damien Seguy – Exakat Ltd <contact(at)exakat.io>
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

namespace Exakat\Analyzer\Performances;

use Exakat\Analyzer\Analyzer;

class LogicalToInArray extends Analyzer {
    public function analyze() {
        $this->atomIs('Logical')
             ->tokenIs(array('T_LOGICAL_OR', 'T_BOOLEAN_OR'))

             ->outIs('LEFT')
             ->atomIs('Comparison')
             ->codeIs(array('==', '==='))
             ->outIs(array('LEFT', 'RIGHT'))
             ->atomIs(array('Variable'))
             ->savePropertyAs('code', 'name')
             ->inIs(array('LEFT', 'RIGHT'))
             ->outIs(array('LEFT', 'RIGHT'))
             ->atomIs(self::$LITERALS)
             ->back('first')
             
             ->outIs('RIGHT')
             ->atomIs('Comparison')
             ->codeIs(array('==', '==='))
             ->outIs(array('LEFT', 'RIGHT'))
             ->atomIs(array('Variable'))
             ->samePropertyAs('code', 'name')
             ->inIs(array('LEFT', 'RIGHT'))
             ->outIs(array('LEFT', 'RIGHT'))
             ->atomIs(self::$LITERALS)
             
             ->back('first');
        $this->prepareQuery();
    }
}

?>