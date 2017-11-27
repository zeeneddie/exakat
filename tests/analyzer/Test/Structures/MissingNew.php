<?php

namespace Test;

include_once(dirname(dirname(dirname(dirname(__DIR__)))).'/library/Autoload.php');
spl_autoload_register('Autoload::autoload_test');
spl_autoload_register('Autoload::autoload_phpunit');
spl_autoload_register('Autoload::autoload_library');

class Structures_MissingNew extends Analyzer {
    /* 1 methods */

    public function testStructures_MissingNew01()  { $this->generic_test('Structures/MissingNew.01'); }
}
?>