<?php

namespace Tests\Feature;

use App\Data\Foo;
use App\Data\Person;
use App\Data\Bar;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;
use function PHPUnit\Framework\assertNotSame;

class ServiceContainerTest extends TestCase
{
    public function testDependency()
    {
        //ini tidak pakai service container laravel,
        // $foo=new Foo();

        $foo1 = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);

        self::assertEquals('Foo', $foo1->foo());
        self::assertEquals('Foo', $foo2->foo());
        assertNotSame($foo1, $foo2);
    }

    public function testBind()
    {
        //$person = $this->app->make(Person::class);
        //self::assertNotNull($person);

        $this->app->bind(Person::class, function ($app) {
            return new Person("Alfian", "Yuska");
        });

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals('Alfian', $person1->firstName);
        self::assertEquals('Alfian', $person2->firstName);
        self::assertNotSame($person1, $person2);
    }

    public function testSingleton()
    {
        $this->app->singleton(Person::class, function ($app) {
            return new Person('Alfian', 'Yuska');
        });

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals('Alfian', $person1->firstName);
        self::assertEquals('Alfian', $person2->firstName);
        self::assertSame($person1, $person2);
    }

    public function testInstance()
    {
        $person = new Person('Alfian', 'Yuska');
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals('Alfian', $person->firstName);
        self::assertEquals('Alfian', $person->firstName);
        self::assertSame($person1, $person2);
    }

    public function testDependencyInjection()
    {

        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });

        $this->app->singleton(Bar::class, function($app){
            $foo=$app->make(Foo::class);
            return new Bar($foo);
        });

        $foo = $this->app->make(Foo::class);
        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        self::assertSame($foo, $bar1->foo);

        self::assertSame($bar1,$bar2);
    }

    public function testInterfaceToClass()
    
    {
        $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);
        $helloServices=$this->app->make(HelloService::class);

        self::assertEquals('Hallo Alfian', $helloServices->hello('Alfian'));
    }
}
