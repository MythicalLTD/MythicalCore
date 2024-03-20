<?php

namespace Router;
/**
 * The main router class
 *
 * @package Router
 */
class Router
{
    /** @var string Base url */
    private $base_path;

    /** @var string Current relative url */
    private $path;

    /** @var Route[] Currently registered routes */
    public $routes = array();

    /**
     * Constructor
     *
     * @param string $base_path the index url
     * 
     */
    public function __construct($base_path = '')
    {
        $this->base_path = $base_path;
        $path = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        $path = substr($path, strlen($base_path));
        $this->path = $path;
    }

    /**
     * Add a route
     *
     * @param string $expr
     * @param callable $callback
     * @param array|string $methods
     * 
     * @return void
     */
    public function all(string $expr, callable $callback, array|string $methods = null) : void
    {
        $this->routes[] = new Route($expr, $callback, $methods);
    }

    /**
     * Alias for all
     *
     * @param string $expr
     * @param callable $callback
     * @param null|array $methods
     * 
     * @return void
     */
    public function add(string $expr, callable $callback,  null|array $methods = null) : void
    {
        $this->all($expr, $callback, $methods);
    }

    /**
     * Add a route for GET requests
     *
     * @param string $expr
     * @param callable $callback
     * 
     * @return void 
     */
    public function get(string $expr, callble $callback) : void
    {
        $this->routes[] = new Route($expr, $callback, 'GET');
    }

    /**
     * Add a route for POST requests
     *
     * @param string $expr
     * @param callable $callback
     * 
     * @return void
     */
    public function post(string $expr, callable $callback) : void
    {
        $this->routes[] = new Route($expr, $callback, 'POST');
    }

    /**
     * Add a route for HEAD requests
     *
     * @param string $expr
     * @param callable $callback
     * 
     * @return void
     */
    public function head(string $expr, callable $callback) : void
    {
        $this->routes[] = new Route($expr, $callback, 'HEAD');
    }

    /**
     * Add a route for PUT requests
     *
     * @param string $expr
     * @param callable $callback
     * 
     * @return void
     */
    public function put(string $expr, callable $callback) : void
    {
        $this->routes[] = new Route($expr, $callback, 'PUT');
    }

    /**
     * Add a route for DELETE requests
     *
     * @param string $expr
     * @param callable $callback
     * 
     * @return void
     */
    public function delete(string $expr, callable $callback) : void
    {
        $this->routes[] = new Route($expr, $callback, 'DELETE');
    }

    /**
     * Test all routes until any of them matches
     *
     * @throws RouteNotFoundException if the route doesn't match with any of the registered routes
     */
    public function route()
    {
        foreach ($this->routes as $route) {
            if ($route->matches($this->path)) {
                return $route->exec();
            }
        }

        throw new RouteNotFoundException("No routes matching {$this->path}");
    }

    /**
     * Get the current url or the url to a path
     *
     * @param string|null $path The path 
     * 
     * @return string The url!
     */
    public function url(string $path = null) : string
    {
        if ($path === null) {
            $path = $this->path;
        }

        return $this->base_path . $path;
    }

    /**
     * Redirect from one url to another
     *
     * @param string $from_path From path
     * @param string $to_path To path
     * @param int $code THe http redirect code!
     * 
     * @return void
     */
    public function redirectfrom($from_path, $to_path, $code = 302) : void
    {
        $this->all($from_path, function () use ($to_path, $code) {
            http_response_code($code);
            header("Location: {$to_path}");
        });
    }
    /**
     * Redirect to another url
     * 
     * @param string $to_path The path
     * @param int $code The http redirect code!
     * 
     * @return void
     */
    public function redirectto(string $to_path, int $code = 302) : void 
    {

    }
}
?>