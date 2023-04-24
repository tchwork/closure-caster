--FILE--
<?php

require dirname(__DIR__).'/vendor/autoload.php';

interface ManyMethodsInterface
{
    public function foo();
    public function bar();
}

closure_cast_to(fn () => 'foo', ManyMethodsInterface::class);

?>
--EXPECTF--
Fatal error: Class ManyMethodsInterface@anonymous contains 1 abstract method and must therefore be declared abstract or implement the remaining methods (ManyMethodsInterface::bar) in %s
