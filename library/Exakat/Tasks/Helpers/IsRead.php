<?php
/*
 * Copyright 2012-2019 Damien Seguy – Exakat SAS <contact(at)exakat.io>
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

namespace Exakat\Tasks\Helpers;

class IsRead extends Plugin {
    public $name = 'isRead';
    public $type = 'boolean';
    private $variables = array('Variable', 'Variableobject', 'Variablearray',
                               'Member', 'Staticproperty',
                               'Phpvariable', 'This',
                               'Array',);

    public function run($atom, $extras) {
        switch ($atom->atom) {
            case 'Assignation' :
                if (in_array($extras['RIGHT']->atom, $this->variables)) {
                    $extras['RIGHT']->isRead = true;
                }
                break;

            case 'Not' :
                if (in_array($extras['NOT']->atom, $this->variables)) {
                    $extras['NOT']->isRead = true;
                }
                break;

            case 'Sign' :
                if (in_array($extras['SIGN']->atom, $this->variables)) {
                    $extras['SIGN']->isRead = true;
                }
                break;

            case 'Throw' :
                if (in_array($extras['THROW']->atom, $this->variables)) {
                    $extras['THROW']->isRead = true;
                }
                break;

            case 'Return' :
                if (in_array($extras['RETURN']->atom, $this->variables)) {
                    $extras['RETURN']->isRead = true;
                }
                break;

            case 'Block' :
            case 'Parenthesis' :
                if (in_array($extras['CODE']->atom, $this->variables)) {
                    $extras['CODE']->isRead = true;
                }
                break;

            case 'Clone' :
                if (in_array($extras['CLONE']->atom, $this->variables)) {
                    $extras['CLONE']->isRead = true;
                }
                break;

            case 'Foreach' :
                if (in_array($extras['SOURCE']->atom, $this->variables)) {
                    $extras['SOURCE']->isRead = true;
                }
                break;

            case 'Ifthen' :
                if (in_array($extras['CONDITION']->atom, $this->variables)) {
                    $extras['CONDITION']->isRead = true;
                }
                break;

            case 'For' :
                if (in_array($extras['INIT']->atom, $this->variables)) {
                    $extras['INIT']->isRead = true;
                }
                if (in_array($extras['FINAL']->atom, $this->variables)) {
                    $extras['FINAL']->isRead = true;
                }
                if (in_array($extras['INCREMENT']->atom, $this->variables)) {
                    $extras['INCREMENT']->isRead = true;
                }
                break;

            case 'Switch' :
                if (in_array($extras['CONDITION']->atom, $this->variables)) {
                    $extras['CONDITION']->isRead = true;
                }
                break;

            case 'Case' :
                if (in_array($extras['CASE']->atom, $this->variables)) {
                    $extras['CASE']->isRead = true;
                }
                break;

            case 'Coalesce' :
                if (in_array($extras['LEFT']->atom, $this->variables)) {
                    $extras['LEFT']->isRead = true;
                }
                if (in_array($extras['RIGHT']->atom, $this->variables)) {
                    $extras['RIGHT']->isRead = true;
                }
                break;

            case 'Ternary' :
                if (in_array($extras['CONDITION']->atom, $this->variables)) {
                    $extras['CONDITION']->isRead = true;
                }
                if (in_array($extras['THEN']->atom, $this->variables)) {
                    $extras['THEN']->isRead = true;
                }
                if (in_array($extras['ELSE']->atom, $this->variables)) {
                    $extras['ELSE']->isRead = true;
                }
                break;

            case 'Cast' :
                if (in_array($extras['CAST']->atom, $this->variables)) {
                    $extras['CAST']->isRead = true;
                }
                break;

            case 'Keyvalue' :
                if (in_array($extras['INDEX']->atom, $this->variables)) {
                    $extras['INDEX']->isRead = true;
                }
                if (in_array($extras['VALUE']->atom, $this->variables)) {
                    $extras['VALUE']->isRead = true;
                }
                break;

            case 'Preplusplus' :
                if (in_array($extras['PREPLUSPLUS']->atom, $this->variables)) {
                    $extras['PREPLUSPLUS']->isRead = true;
                }
                break;

            case 'Postplusplus' :
                if (in_array($extras['POSTPLUSPLUS']->atom, $this->variables)) {
                    $extras['POSTPLUSPLUS']->isRead = true;
                }
                break;

            case 'Addition':
            case 'Multiplication':
            case 'Logical' :
            case 'Comparison' :
            case 'Bitshift':
            case 'Power':
                if (in_array($extras['RIGHT']->atom, $this->variables)) {
                    $extras['RIGHT']->isRead = true;
                }
                if (in_array($extras['LEFT']->atom, $this->variables)) {
                    $extras['LEFT']->isRead = true;
                }
                break;

            case 'New' :
                if (in_array($extras['NEW']->atom, $this->variables)) {
                    $extras['NEW']->isRead = true;
                }
                break;

            case 'Arrayappend':
                if (in_array($extras['APPEND']->atom, $this->variables)) {
                    $extras['APPEND']->isRead = true;
                }
                break;

            case 'Yield':
            case 'Yieldfrom':
                if (in_array($extras['YIELD']->atom, $this->variables)) {
                    $extras['YIELD']->isRead = true;
                }
                break;

            case 'Dowhile':
            case 'While':
                if (in_array($extras['CONDITION']->atom, $this->variables)) {
                    $extras['CONDITION']->isRead = true;
                }
                break;

            case 'Include':
                if (in_array($extras['ARGUMENT']->atom, $this->variables)) {
                    $extras['ARGUMENT']->isRead = true;
                }
                break;

            case 'Defineconstant':
                if (isset($extras['NAME']) &&
                    in_array($extras['NAME']->atom, $this->variables)) {
                    $extras['NAME']->isRead = true;
                }
                if (isset($extras['VALUE']) &&
                    in_array($extras['VALUE']->atom, $this->variables)) {
                    $extras['VALUE']->isRead = true;
                }
                if (isset($extras['CASE']) &&
                    in_array($extras['CASE']->atom, $this->variables)) {
                    $extras['CASE']->isRead = true;
                }
                break;

            case 'Array':
                if (in_array($extras['VARIABLE']->atom, $this->variables)) {
                    $extras['VARIABLE']->isRead = true;
                }
                if (in_array($extras['INDEX']->atom, $this->variables)) {
                    $extras['INDEX']->isRead = true;
                }
                break;

            case 'Instanceof':
                if (in_array($extras['VARIABLE']->atom, $this->variables)) {
                    $extras['VARIABLE']->isRead = true;
                }
                if (in_array($extras['CLASS']->atom, $this->variables)) {
                    $extras['CLASS']->isRead = true;
                }
                break;

            case 'Variable':
                if (isset($extras['NAME']) &&
                    in_array($extras['NAME']->atom, $this->variables)) {
                    $extras['NAME']->isRead = true;
                }
                break;

            case 'Member':
                if (in_array($extras['OBJECT']->atom, $this->variables)) {
                    $extras['OBJECT']->isRead = true;
                }
                if (in_array($extras['MEMBER']->atom, $this->variables)) {
                    $extras['MEMBER']->isRead = true;
                }
                break;

            case 'Methodcall':
                if (in_array($extras['OBJECT']->atom, $this->variables)) {
                    $extras['OBJECT']->isRead = true;
                }
                if (in_array($extras['METHOD']->atom, $this->variables)) {
                    $extras['METHOD']->isRead = true;
                }
                break;

            case 'Staticproperty':
            case 'Staticmethodcall':
            case 'Staticclass':
            case 'Staticconstant':
                if (in_array($extras['CLASS']->atom, $this->variables)) {
                    $extras['CLASS']->isRead = true;
                }
                break;

            case 'Methodcallname' :
            case 'Arrayliteral' :
            case 'Functioncall' :
            case 'Methodcall' :
            case 'Newcall' :
            case 'Echo' :
            case 'Exit' :
            case 'Eval' :
            case 'Isset' :
            case 'Empty' :
            case 'Print' :
            case 'Sequence' :
                foreach($extras as &$extra) {
                    if (in_array($extra->atom, $this->variables)) {
                        $extra->isRead = true;
                    }
                }
                break;

            case 'This' :
                $atom->isRead = true;
                break;

            case 'Closure' :
                foreach($extras as $extra) {
                    if (in_array($extra->atom, $this->variables)) {
                        $extra->isRead = true;
                    }
                }
                break;

            case 'Concatenation' :
            case 'Heredoc' :
            case 'String' :
            case 'Shell' :
                foreach($extras as &$extra) {
                    if (in_array($extra->atom, $this->variables)) {
                        $extra->isRead = true;
                    }
                }
                break;

            default :
//            print $atom->atom.PHP_EOL;
        }
    }
}

?>

