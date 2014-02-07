<?php

$extension = $argv[1];

if (!extension_loaded($extension)) {
    print "'$extension' is not a local extension. Aborting\n";
    die();
}

$ini = "";

$ext = new ReflectionExtension($extension);
$constants = '';
foreach($ext->getConstants() as $constant => $value) {
    $constants .= "constants[] = ".$constant."\n";
}
if (empty($constants)) {
    $ini .= "constants[] = \n\n";
} else {
    $ini .= "$constants\n";
}

$functions = '';
foreach($ext->getFunctions() as $function) {
    $functions .= "functions[] = ".$function->name."\n";
}
if (empty($functions)) {
    $ini .= "functions[] = \n\n";
} else {
    $ini .= "$functions\n";
}

$classes = '';
$interfaces = '';
foreach($ext->getClasses() as $class) {
    if ($class->isInterface()) {
        $interfaces .= "interfaces[] = ".$class->name."\n";
    } else {
        $classes .= "classes[] = ".$class->name."\n";
    }
}
if (empty($classes)) {
    $ini .= "classes[] = \n\n";
} else {
    $ini .= "$classes\n";
}

if (empty($interfaces)) {
    $ini .= "interfaces[] = \n\n";
} else {
    $ini .= "$interfaces\n";
}

file_put_contents('data/'.$extension.'.ini', $ini);

// Adding the class itself
$code = <<<'PHP'
<?php

namespace Analyzer\Extensions;

use Analyzer;

class Ext<SKELETON> extends Analyzer\Common\Extension {

    public function analyze() {
        $this->source = '<SKELETON>.ini';

        parent::analyze();
    }
}

?
PHP;

$code .= '>';
$code = str_replace('<SKELETON>', $extension, $code);
file_put_contents('library/Analyzer/Extensions/Ext'.$extension.'.php', $code);

// adding the class in the Appinfo
$php = file_get_contents('library/Report/Appinfo.php');
if (strpos($php, "'ext/$extension'") === false) {
    $php = str_replace("//                          'ext/skeleton'   => 'Extensions/Extskeleton',\n",
                       "                            'ext/$extension'   => 'Extensions/Ext$extension',
//                          'ext/skeleton'   => 'Extensions/Extskeleton',\n",
                        $php);
    file_put_contents('library/Report/Appinfo.php', $php);
}
                    

// adding the class in the tests/config.ini
$ini = file_get_contents('projects/test/config.ini');
if (strpos($ini, "Extensions/Ext$extension") === false) {
    $ini .= "analyzer[] = 'Extensions/Ext$extension';\n";
    file_put_contents('projects/test/config.ini', $ini);
}

$ini = file_get_contents('projects/test/config.ini');
if (strpos($ini, "Extensions/Ext$extension") === false) {
    $ini .= "analyzer[] = 'Extensions/Ext$extension';\n";
    file_put_contents('projects/test/config.ini', $ini);
    
    print "Adding to test/config.ini\n";
}

$ini = file_get_contents('projects/default/config.ini');
if (strpos($ini, "Extensions/Ext$extension") === false) {
    $ini .= "analyzer[] = 'Extensions/Ext$extension';\n";
    file_put_contents('projects/default/config.ini', $ini);

    print "Adding to default/config.ini\n";
}

print "Done with preparing extension '$extension'\n";
?>