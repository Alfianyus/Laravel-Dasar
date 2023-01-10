<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class FacadeTest extends TestCase
{
    public function testConfig()
    {
        $firstName1=config('contoh.author.first');
        $firstName2=Config::get('contoh.author.first');

        self::assertEquals($firstName1, $firstName2);

        var_dump(Config::all());
    }

    public function testFacadeMock()
    {
        Config::shouldReceive('get')
             ->with('contoh.author.first')
             ->andReturn('Yuska Keren');

             $firstName=Config::get('contoh.author.first');

             self::assertEquals('Alfian keren', $firstName);
      
    }
}
