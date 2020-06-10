<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\fstTestTraits;

class CRUDFileVault extends TestCase
{

    use fstTestTraits;


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/backend/files/index');

        $response->assertStatus(200);
    }


    public function testGetTrait()
    {
        $response = $this->getClientRecord();
        $response = true;

        $this->assertSame(false, $response);
    }
}
