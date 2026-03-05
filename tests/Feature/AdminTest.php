<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_access_admin_page_if_is_admin()
    {
        // Membuat pengguna dengan status admin
        $user = User::factory()->create(['is_admin' => 1]);

        // Masukkan pengguna tersebut ke dalam aplikasi sebagai pengguna yang sedang login
        $response = $this->actingAs($user)->get('/admin/dashboard');

        // Verifikasi bahwa halaman admin dapat diakses (status HTTP 200)
        $response->assertStatus(200);
    }

    /** @test */
    public function user_cannot_access_admin_page_if_not_admin()
    {
        // Membuat pengguna biasa (bukan admin)
        $user = User::factory()->create(['is_admin' => 0]);

        // Masukkan pengguna tersebut ke dalam aplikasi sebagai pengguna yang sedang login
        $response = $this->actingAs($user)->get('/admin/dashboard');

        // Verifikasi bahwa pengguna yang bukan admin diarahkan ke halaman lain (misalnya 403 Forbidden atau 302 Redirect)
        $response->assertStatus(403); // Jika menggunakan middleware yang mengarahkan pengguna non-admin ke halaman 403
        // Atau, jika pengalihan, bisa menggunakan assertRedirect('/home') atau sesuai dengan URL pengalihan
    }
}
