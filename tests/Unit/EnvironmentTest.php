<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;

class EnvironmentTest extends TestCase
{
    public function tesGetEnv()

    {
        $youtube = env('YOUTUBE');

        self::assertEquals('Programmer  Now', $youtube);
    }
}
