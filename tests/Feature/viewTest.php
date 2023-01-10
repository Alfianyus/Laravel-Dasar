<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class viewTest extends TestCase
{
    public function viewTest()
    {
        $this->get('/hello')
            ->assertSeeText('Hello Yuska');

        $this->get('/hello-again')
            ->assertSeeText('Hello Yuska');
    }

    public function testNested()
    {
        $this->get('/hello-world')
            ->assertSeeText('World Yuska');
    }

    public function testTemplate()
    {
        $this->view('hello', ['name' => 'Yuska'])
            ->assertSeeText('Hello Yuska');

        $this->view('hello.world', ['name' => 'Yuska'])
            ->assertSeeText('World Yuska');
    }
}
