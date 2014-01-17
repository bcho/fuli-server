<?php

require_once 'bootstrap.php';

class RoutesTest extends Slim_Framework_TestCase
{
    /**
     * @dataProvider routeProvider
     */
    public function testRoutesIdCondition($route, $response)
    {
        $this->get($route);
        $this->assertEquals($response, $this->response->status());
    }

    public function routeProvider()
    {
        return array(
            array('/user/1', 200),
            array('/user/1a', 404),
            array('/category/1a', 404)
        );
    }
}
