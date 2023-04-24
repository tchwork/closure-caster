--FILE--
<?php

require dirname(__DIR__).'/vendor/autoload.php';

interface SingleMethodInterface
{
    public function foo(): string;
}

$object = closure_cast_to(fn () => 'foo', SingleMethodInterface::class);

echo $object->foo()
?>
--EXPECTF--
Fatal error: Declaration of SingleMethodInterface@anonymous::foo() must be compatible with SingleMethodInterface::foo(): string in %s
