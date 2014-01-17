<?php

require_once 'bootstrap.php';

class RoutesTest extends Slim_Framework_TestCase
{
    public function testRoutesIdCondition()
    {
        $this->get('/user/1');
        $this->assertEquals(200, $this->response->status());

        $this->get('/user/1a');
        $this->assertEquals(404, $this->response->status());
        
        $this->get('/category/1a');
        $this->assertEquals(404, $this->response->status());
    }
}
