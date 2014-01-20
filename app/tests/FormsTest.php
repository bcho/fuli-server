<?php

require_once __DIR__ . '/../../vendor/autoload.php';


class CreateLinkFormTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider validatorsProvider
     */
    public function testValidators($data, $isPassed)
    {
        $form = new CreateLinkForm();
        $form->populate($data);

        if ($isPassed) {
            $this->assertTrue($form->validate());
        } else {
            $this->assertTrue($form->validate() !== true);
        }
    }

    public function validatorsProvider()
    {
        return array(
            array(array(
                'url' => '',
                'title' => 'haha',
                'category_id' => 1
            ), false),

            array(array(
                'url' => 'hello',
                'title' => 'haha',
                'category_id' => 1
            ), true),

            array(array(
                'url' => 'hello',
                'title' => '',
                'category_id' => 1
            ), false),

            array(array(
                'url' => 'hello',
                'title' => 'haha',
                'category_id' => 1
            ), true),

            array(array(
                'url' => 'hello',
                'title' => 'haha',
                'category_id' => '1'
            ), true),

            array(array(
                'url' => 'hello',
                'title' => 'haha',
                'category_id' => 'abc'
            ), false),
            
            array(array(
                'url' => 'hello',
                'title' => 'haha',
                'category_id' => ''
            ), false),

            array(array(
                'url' => 'hello',
                'title' => 'haha',
                'category_id' => 1,
                'description' => 'haha'
            ), true)
        );
    }
}
