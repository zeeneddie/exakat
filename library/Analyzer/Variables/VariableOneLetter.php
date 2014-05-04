<?php

namespace Analyzer\Variables;

use Analyzer;

class VariableOneLetter extends Analyzer\Analyzer {
    public function dependsOn() {
        return array('Analyzer\\Variables\\Variablenames');
    }
    
    public function analyze() {
        $this->atomIs("Variable")
             ->analyzerIs('Analyzer\\Variables\\Variablenames')
             ->fullcodeLength(" == 2 ");
    }
}

?>