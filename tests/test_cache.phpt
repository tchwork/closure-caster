--FILE--
<?php

require dirname(__DIR__).'/vendor/autoload.php';

interface SingleMethodInterface
{
    public function foo(): string;
}

$function  = fn (): string => 'foo';

$object1 = closure_cast_to($function, SingleMethodInterface::class);
$object2 = closure_cast_to($function, SingleMethodInterface::class);

var_dump($object1::class === $object2::class);
?>
--EXPECT--
bool(true)
