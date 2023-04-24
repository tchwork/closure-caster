--FILE--
<?php

require dirname(__DIR__).'/vendor/autoload.php';

interface SingleMethodInterface
{
    public function foo(&$a): void;
}

$object = closure_cast_to(function (&$c, $d = 123): void { $c = $d; }, SingleMethodInterface::class);

$object->foo($a);
echo $a;
?>
--EXPECT--
123
