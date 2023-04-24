--FILE--
<?php

require dirname(__DIR__).'/vendor/autoload.php';

interface SingleMethodInterface
{
    public function foo(): string;
}

$object = closure_cast_to(fn (): string => 'foo', SingleMethodInterface::class);

echo $object->foo()
?>
--EXPECT--
foo
