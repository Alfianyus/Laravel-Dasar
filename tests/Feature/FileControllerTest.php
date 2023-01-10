<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;

use Symfony\Component\HttpFoundation\File\UploadedFile as FileUploadedFile;
use Tests\TestCase;

class FileControllerTest extends TestCase
{
    public function testUpload()
    {
        $picture= UploadedFile::fake()->image('yuska.png');

        $this->post('/file/uploaded',[
            'picture' => $picture
        ])->assertSeeText("OK yuska.png");
    }

    
}
