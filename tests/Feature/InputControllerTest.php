<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    public function testInput()
    {
        $this->get('/input/hello?name=alfian')
        ->assertSeeText('Hello alfian');

        $this->post('/input/hello',[
            'name'=>'alfian'
        ])->assertSeeText('Hello alfian');
    }

    public function testNested()
    {
        $this->post('/input/hello/first',[
            'name' => [
                'first'=>'alfian',
                'last'=>'yuska'
            ]
        ])->assertSeeText('Hello alfian');
    }

    public function testInputAll()
    {
        $this->post('/input/hello/input',[
            'name'=>[
                'first'=>'alfian',
                'last'=>'yuska'
        
        ]
        
        ])->assertSeeText("name")->assertSeeText("first")
        ->assertSeeText("last")->assertSeeText("alfian")
        ->assertSeeText("yuska");
    }

    public function testInputArray()
    {
        $this->post('/input/hello/array',[
            'products'=>[
                [
                    "name"=>"apple mac book pro",
                    "price"=>30000000
                ],
                [
                    "name"=>"samsung galaxy  s10",
                    "price"=>15000000
                ]
            ]
        ])->assertSeeText("apple mac book pro")
        ->assertSeeText("samsung galaxy s10");
    }

    public function testInputType()
    {
        $this->post('/input/type',[
            'name'=>'Budi',
            'married'=>'true',
            'birth_date'=>'1990-10-10'
        ])->assertSeeText("Budi")->assertSeeText("true")->assertSeeText("1990-10-10");
    }

    public function testFilteronly()
    {
        $this->post('/input/filter/only',[
            "name"=>[
                "first"=>"alfian",
                "middle"=>"alf",
                "last"=>"yuska"
            ]
        ])->assertSeeText("alfian")->assertSeeText("yuska")
        ->assertSeeText("alf");
    }

    public function testFilterExcept()
    {
        $this->post('/input/filter/except',[
            "username"=>"yuska",
            "admin"=>"true",
            "password"=>"rahasia"
        ])->assertSeeText("yuska")->assertSeeText("rahasia")
        ->assertDontSeeText("admin");
    }

    public function testFilterMerge()
    {
        $this->post('/input/filter/merge',[
            "username"=>"yuska",
            "password"=>"rahasia",
            "admin"=>"true"
        ])->assertSeeText("yuska")->assertSeeText("rahasia")
        ->assertSeeText("admin")->assertSeeText("false");
    }

    
}
