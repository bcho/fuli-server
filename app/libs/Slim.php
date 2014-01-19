<?php

class Slim extends \Slim\Slim
{
    /**
     * @var array
     */
    protected $namedCallables = array();

    /**
     * @var array Builtin converters.
     */
    protected $converters = array(
        'str' => '\w+',
        'int' => '\d+'
    );

    /**
     * @var string Converter match pattern.
     */
    protected $converterPattern = '/\/(str|int)\:(\w+)/';

    /**
     * Register a callable.
     *
     * ARGUMENTS:
     *
     * First:       string  The router's name (REQUIRED)
     * In-Between:  mixed   Anything that retuns TRUE for `is_callable` (OPTIONAL)
     * Last:        mixed   Anything that returns TRUE for `is_callable` (REQUIRED)
     *
     * @param array (see above)
     * @return \Slim
     */
    public function registerCallable()
    {
        $args = func_get_args();
        $name = $args[0];
        $this->namedCallables[$name] = $args;

        return $this;
    }

    /**
     * Map a named callable to route.
     *
     * EXAMPLE:
     *
     *      $app->registerCallable('get_book', function ($id) use ($app) {
     *          // your code here
     *      });
     *
     *      $app->mapCallable('get_book', '/book/int:id', 'GET');
     *
     * @param string route name
     * @param string route pattern
     * @param string|array route methods
     * @return \Slim\Route
     * @throws \RuntimeException
     */
    public function mapCallable($name, $pattern, $methods)
    {
        if (!isset($this->namedCallables[$name])) {
            throw new \RuntimeException("Callable for $name not found!");
        }
        $rules = $this->namedCallables[$name];

        // find out all converters
        $conditions = array();
        $matches = array();
        if (preg_match_all($this->converterPattern, $pattern, $matches)) {
            for ($i = 0;$i < count($matches[1]);$i++) {
                $c = $matches[1][$i];
                $p = $matches[2][$i];
                $pat = "/$c\:$p/";
                $pattern = preg_replace($pat, ":$p", $pattern);
                $conditions[$p] = $this->converters[$c];
            }
        }
        $rules[0] = $pattern;

        return $this->mapRoute($rules)
            ->via($methods)
            ->conditions($conditions)
            ->name($name);
    }
}
