<?php

use Symfony\Component\VarExporter\ProxyHelper;

/**
 * @template T
 * @param class-string<T> $class
 * @return T
 */
function closure_cast_to(Closure $closure, string $interface): object
{
    static $cache = [];

    $r = new ReflectionFunction($closure);
    $key = $r->getStartLine() . $interface . $r->getFileName() . $r->getEndLine();

    if (isset($cache[$key])) {
        return new $cache[$key]($closure);
    }

    if (!interface_exists($interface) && !class_exists($interface)) {
        throw new Error(sprintf('Interface "%s" not found', $interface));
    }

    $method = (new ReflectionClass($interface))->getMethods()[0]?->name ?? '__invoke';

    $signature = ProxyHelper::exportSignature($r, true, $arguments);
    $signature = substr_replace($signature, $method, 9 + (int) $r->returnsReference(), 0);
    $return = str_ends_with($signature, '): never') || str_ends_with($signature, '): void') ? '' : 'return ';

    $object = eval(<<<PHP
        return new class (\$closure) implements {$interface} {
            public function __construct(private readonly Closure \$closure) {
            }

            public {$signature} {
                {$return}\$this->closure->__invoke({$arguments});
            }
        };
        PHP);

    $cache[$key] = $object::class;

    return $object;
}
