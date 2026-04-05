<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_admin_dashboard(): void
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->get('/admin/dashboard');

        $response->assertStatus(200);
    }

    public function test_apprenant_cannot_access_admin_dashboard(): void
    {
        $apprenant = User::factory()->apprenant()->create();

        $response = $this->actingAs($apprenant)->get('/admin/dashboard');

        $response->assertStatus(403);
    }

    public function test_apprenant_can_access_apprenant_dashboard(): void
    {
        $apprenant = User::factory()->apprenant()->create();

        $response = $this->actingAs($apprenant)->get('/apprenant/dashboard');

        $response->assertStatus(200);
    }

    public function test_admin_cannot_access_apprenant_dashboard(): void
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->get('/apprenant/dashboard');

        $response->assertStatus(403);
    }

    public function test_guest_is_redirected_to_login(): void
    {
        $response = $this->get('/admin/dashboard');
        $response->assertRedirect('/login');
    }

    public function test_dashboard_redirects_admin_correctly(): void
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->get('/dashboard');

        $response->assertRedirect(route('admin.dashboard'));
    }

    public function test_dashboard_redirects_apprenant_correctly(): void
    {
        $apprenant = User::factory()->apprenant()->create();

        $response = $this->actingAs($apprenant)->get('/dashboard');

        $response->assertRedirect(route('apprenant.dashboard'));
    }
}