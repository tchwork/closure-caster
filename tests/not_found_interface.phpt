--FILE--
<?php

require dirname(__DIR__).'/vendor/autoload.php';

$object = closure_cast_to(fn () => 'foo', SingleMethodClass::class);

echo $object->foo()
?>
--EXPECTF--
Fatal error: Uncaught Error: Interface "SingleMethodClass" not found in %A