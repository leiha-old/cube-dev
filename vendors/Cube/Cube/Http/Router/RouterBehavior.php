<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 14/10/15
 * Time: 21:26
 */

namespace Cube\Http\Router;

use Cube\Dna\Gene\GeneBehavior;

interface RouterBehavior
    extends GeneBehavior
{
    /**
     * @param string $pattern
     * @param string $controllerName
     * @param string $methodName
     */
    public function get($pattern, $controllerName, $methodName);

    /**
     * @param string $pattern
     * @param string $controllerName
     * @param string $methodName
     */
    public function post($pattern, $controllerName, $methodName);

    /**
     * @param string $pattern
     * @param string $controllerName
     * @param string $methodName
     */
    public function put($pattern, $controllerName, $methodName);

    /**
     * @param string $pattern
     * @param string $controllerName
     * @param string $methodName
     */
    public function delete($pattern, $controllerName, $methodName);
}