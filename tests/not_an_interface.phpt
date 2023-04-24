--FILE--
<?php

require dirname(__DIR__).'/vendor/autoload.php';

class SingleMethodClass
{
    public function foo() {}
}

$object = closure_cast_to(fn () => 'foo', SingleMethodClass::class);

echo $object->foo()
?>
--EXPECTF--
Fatal error: SingleMethodClass@anonymous cannot implement SingleMethodClass - it is not an interface in %s
