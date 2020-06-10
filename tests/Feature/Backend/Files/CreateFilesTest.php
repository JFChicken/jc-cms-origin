<?php

namespace Tests\Feature\Backend\Files;

use App\Events\Backend\Auth\Role\RoleCreated;
use App\Models\Auth\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class CreateFilesTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function an_admin_can_access_the_create_file_page()
    {
        $this->loginAsAdmin();

        $this->get('/admin/files/create')->assertStatus(200);
    }


    /** @test */
    public function at_least_one_permission_is_required()
    {
        $this->loginAsAdmin();

        $response = $this->post('/admin/files/file', ['name' => 'new file']);

        $response->assertSessionHas(['flash_danger' => __('fst.exceptions.backend.access.file.needs_permission')]);
    }

    /** @test */
    public function an_event_gets_dispatched()
    {
        $this->loginAsAdmin();
        Event::fake();

        $this->post('/admin/auth/role', ['name' => 'new role', 'permissions' => ['view backend']]);

        Event::assertDispatched(RoleCreated::class);
    }
}
