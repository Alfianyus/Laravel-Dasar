<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    public function testGet()

    {
        $this->get('/pzn')
             ->assertStatus(200)
             ->assertSeeText('Programmer zaman Now');
    }

    public function testRedirect()
    {
        $this->get('/youtube')
             ->assertRedirect('/pzn');
    }

    public function testFallback()
    {
        $this->get('/tidakada')
             ->assertSeeText('404 by  programmer yuska');

    }

    public function testRouteParameter()
    {
        $this->get('/Products/1')
              ->assertSeeText('Product 1');

        $this->get('/Products/2')
             ->assertSeeText('Product 2'); 
             
        $this->get('/Products/1/Items/XXX')
             ->assertSeeText('Product 1,Item XXX');

        $this->get('/Products/2/Items/YYY')
             ->assertSeeText('Products 2, Item YYY');     

    }

    public function testRouteRegex()
    {
        $this->get('/categories/100')
             ->assertSeeText('Category 100');

        $this->get('/categories/Yuska')
            ->assertSeeText('404 by yuska');     
    }

    public function testRouteParameterOptional()
    {
        $this->get('/users/yuska')
             ->assertSeeText('User yuska');

        $this->get('/user')
             ->assertSeeText(' User 404');
           
    }

     public function testRouteConflict()
     {
        $this->get('/conflict/budi')
             ->assertSeeText('conflict budi');

        $this->get('/conflict/yuska')
             ->assertSeeText('conflict yuska Alfian');     
     }


}
