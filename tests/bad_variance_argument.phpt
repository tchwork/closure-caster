--FILE--
<?php

require dirname(__DIR__).'/vendor/autoload.php';

interface SingleMethodInterface
{
    public function foo($abc): string;
}

$object = closure_cast_to(fn (string $abc): string => 'foo', SingleMethodInterface::class);

echo $object->foo()
?>
--EXPECTF--
Fatal error: Declaration of SingleMethodInterface@anonymous::foo(string $abc): string must be compatible with SingleMethodInterface::foo($abc): string in %s
