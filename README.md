# tchwork/closure-caster

This package provides a function named `closure_cast_to()` that allows
turning a closure into an object implementing a single-method interface.

Imagine you have an interface like this:

```php
interface TranslatorInterface
{
    public function translate(string $message, $parameters = []): string;
}
```

And that the `strtr()` function is a correct implementation for the identity translator.
You can get an instance of `TranslatorInterface` delegating to `strtr()` like this:

```php
$identityTranslator = closure_cast_to(strtr(...), TranslatorInterface::class);
```

This package is meant as a proof-of-concept implementation of
[this RFC](https://wiki.php.net/rfc/allow_casting_closures_into_single-method_interface_implementations)
which proposes to add a new `castTo` method to the native `Closure`
class so that the previous example could be written like this:

```php
$identityTranslator = strtr(...)->castTo(TranslatorInterface::class);
```
