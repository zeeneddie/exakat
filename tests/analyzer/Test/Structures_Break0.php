<?php

namespace Test;

include_once(dirname(dirname(dirname(__DIR__))).'/library/Autoload.php');
spl_autoload_register('Autoload::autoload_test');
spl_autoload_register('Autoload::autoload_phpunit');

class Structures_Break0 extends Analyzer {
    /* 1 methods */

    public function testStructures_Break001()  { $this->generic_test('Structures_Break0.01'); }
}
?>