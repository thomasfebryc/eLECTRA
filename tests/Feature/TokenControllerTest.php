<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Token;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TokenControllerTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function admin_can_add_new_token()
    {
        // Membuat admin dan pengguna untuk dikaitkan dengan token
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create();  // Pengguna yang akan menerima token

        // Data token yang akan ditambahkan
        $tokenData = [
            'token' => 'ABC123XYZ',  // Token listrik yang akan dibuat
            'user_id' => $user->id,  // Pengguna yang akan menerima token
        ];

        // Melakukan login sebagai admin dan menambahkan token
        $response = $this->actingAs($admin)->post(route('admin.tokens.store'), $tokenData);

        // Menguji apakah token berhasil disimpan dan admin diarahkan kembali ke halaman daftar token
        $response->assertRedirect(route('admin.tokens.index'));
        $this->assertDatabaseHas('tokens', [
            'token' => $tokenData['token'],
            'user_id' => $user->id,
        ]);  // Memastikan token baru ada di database
    }

    /** @test */
    public function token_must_be_unique()
    {
        // Membuat admin dan pengguna
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create();

        // Membuat token pertama
        $token = Token::create([
            'token' => 'ABC123XYZ',
            'user_id' => $user->id,
        ]);

        // Coba membuat token yang sama, harus gagal karena token unik
        $response = $this->actingAs($admin)->post(route('admin.tokens.store'), [
            'token' => 'ABC123XYZ',  // Token yang sama dengan yang sudah ada
            'user_id' => $user->id,
        ]);

        $response->assertSessionHasErrors('token');  // Menguji jika validasi error pada token
    }
}
