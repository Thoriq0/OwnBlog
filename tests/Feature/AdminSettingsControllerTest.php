<?php

namespace Tests\Feature;

use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminSettingsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_base_settings_can_be_updated_via_post_route(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        SiteSetting::current();

        $response = $this
            ->actingAs($admin)
            ->post(route('settings.base.update'), [
                'settings_tab' => 'base',
                'site_title' => 'OwnBlog Hangat',
                'connect_1_label' => 'GitHub',
                'connect_1_url' => 'https://github.com/example',
                'connect_2_label' => 'Email',
                'connect_2_url' => 'mailto:halo@example.com',
                'connect_3_label' => '',
                'connect_3_url' => '',
            ]);

        $response
            ->assertRedirect(route('settings', ['tab' => 'base']))
            ->assertSessionHas('settings-success');

        $this->assertDatabaseHas('site_settings', [
            'id' => 1,
            'site_title' => 'OwnBlog Hangat',
            'connect_1_label' => 'GitHub',
            'connect_1_url' => 'https://github.com/example',
            'connect_2_label' => 'Email',
            'connect_2_url' => 'mailto:halo@example.com',
            'connect_3_label' => null,
            'connect_3_url' => null,
        ]);
    }

    public function test_base_settings_validation_redirects_back_to_base_tab(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this
            ->actingAs($admin)
            ->from(route('settings', ['tab' => 'base']))
            ->post(route('settings.base.update'), [
                'settings_tab' => 'base',
                'site_title' => '',
                'connect_1_label' => 'GitHub',
                'connect_1_url' => 'bukan-url-valid',
            ]);

        $response
            ->assertRedirect(route('settings', ['tab' => 'base']))
            ->assertSessionHas('settings-error')
            ->assertSessionHasErrors(['site_title', 'connect_1_url']);
    }
}
