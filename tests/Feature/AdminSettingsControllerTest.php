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

    public function test_account_settings_validation_does_not_flash_password_fields_back_to_session(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this
            ->actingAs($admin)
            ->from(route('settings', ['tab' => 'account']))
            ->post(route('settings.account.update'), [
                'settings_tab' => 'account',
                'name' => '',
                'email' => 'admin@example.com',
                'current_password' => 'secret-lama',
                'new_password' => 'secret-baru-123',
                'new_password_confirmation' => 'secret-baru-123',
            ]);

        $response
            ->assertRedirect(route('settings', ['tab' => 'account']))
            ->assertSessionHas('settings-error')
            ->assertSessionHasErrors(['name']);

        $oldInput = session()->getOldInput();

        $this->assertArrayNotHasKey('current_password', $oldInput);
        $this->assertArrayNotHasKey('new_password', $oldInput);
        $this->assertArrayNotHasKey('new_password_confirmation', $oldInput);
        $this->assertSame('account', $oldInput['settings_tab'] ?? null);
    }
}
