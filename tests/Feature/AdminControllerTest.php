<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions; // Menggunakan DatabaseTransactions untuk menjaga data
use Tests\TestCase;

class AdminControllerTest extends TestCase
{
    use DatabaseTransactions; // Ganti RefreshDatabase dengan DatabaseTransactions

    /** @test */
    public function admin_can_promote_user_to_admin()
    {
        // Membuat admin dan pengguna biasa
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'user']);

        // Melakukan login sebagai admin
        $response = $this->actingAs($admin)->post(route('admin.users.promote', $user->id));

        // Menguji apakah pengguna dipromosikan menjadi admin
        $response->assertRedirect(route('admin.users'));  // Menguji pengalihan kembali ke daftar pengguna
        $this->assertEquals('admin', $user->fresh()->role);  // Memastikan role pengguna berubah menjadi admin
    }

    /** @test */
    public function admin_cannot_promote_already_admin_user()
    {
        // Membuat admin
        $admin = User::factory()->create(['role' => 'admin']);
        $existingAdmin = User::factory()->create(['role' => 'admin']);  // Pengguna yang sudah menjadi admin

        // Melakukan login sebagai admin
        $response = $this->actingAs($admin)->post(route('admin.users.promote', $existingAdmin->id));

        // Menguji apakah ada pesan info jika pengguna sudah admin
        $response->assertRedirect()->with('info', 'User ini sudah merupakan admin.');
    }
}
