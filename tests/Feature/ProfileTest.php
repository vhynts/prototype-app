<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Support\Facades\Hash;
use Modules\User\Models\User;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    public function test_guest_is_redirected_to_login(): void
    {
        $response = $this->get('/profile');
        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_view_profile_page(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/profile');

        $response->assertStatus(200);
        $response->assertSee($user->name);
        $response->assertSee($user->email);
        $response->assertSee('Ubah Password');
    }

    public function test_user_can_update_password_with_valid_current_password(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('old-password-123'),
        ]);

        $response = $this->actingAs($user)->put('/profile/password', [
            'current_password' => 'old-password-123',
            'password' => 'new-secure-password-456',
            'password_confirmation' => 'new-secure-password-456',
        ]);

        $response->assertRedirect('/profile');
        $response->assertSessionHas('success');
        $this->assertTrue(Hash::check('new-secure-password-456', $user->fresh()->password));
    }

    public function test_user_cannot_update_password_with_invalid_current_password(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('correct-password'),
        ]);

        $response = $this->actingAs($user)->put('/profile/password', [
            'current_password' => 'wrong-password',
            'password' => 'new-password-123',
            'password_confirmation' => 'new-password-123',
        ]);

        $response->assertSessionHasErrors('current_password');
        $this->assertTrue(Hash::check('correct-password', $user->fresh()->password));
    }
}
