# chaining concept

```php
class Text
{
    static function upper()
    {
        return new Text();
    }
    static function lower()
    {
        return new Text();
    }
    static function proper()
    {
        return new Text();
    }
    static function toString()
    {
        return new Text();
    }
    static function toArray()
    {
        return new Text();
    }
}


class Validate
{
    static function check($string)
    {
        // do some stuff of code

        return new Text();
    }
}


$x = Validate::check('maged');

$x = $x->upper();

$x = $x->toArray();

$x = Validate::check('maged')->upper()->toArray();

```
