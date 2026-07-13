<?php

namespace Tests\Feature;

use Tests\TestCase;

class AdminPagesTest extends TestCase
{
    public function test_guest_can_view_public_user_page(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Platform Digital UAB');
    }

    public function test_guest_can_view_public_sections(): void
    {
        $response = $this->get('/pengurus');

        $response->assertStatus(200);
        $response->assertSee('Pengurus');
    }

    public function test_admin_dashboard_requires_login(): void
    {
        $response = $this->get('/admin/dashboard');

        $response->assertRedirect('/admin/login');
    }

    public function test_admin_can_login_with_hardcoded_credentials(): void
    {
        $response = $this->post('/admin/login', [
            'username' => 'uabadmins',
            'password' => 'Homeband1Kekuatan',
        ]);

        $response->assertRedirect('/admin/dashboard');
        $this->assertTrue(session('is_admin'));
    }

    public function test_admin_can_manage_multiple_pengurus_entries_per_section(): void
    {
        $pageResponse = $this->withSession(['is_admin' => true])->get('/admin/pengurus/ketum');

        $pageResponse->assertStatus(200);
        $pageResponse->assertSee('Kelola Ketum');

        $response = $this->withSession(['is_admin' => true])->post('/admin/pengurus/ketum', [
            'entries' => [
                ['name' => 'Dr. Budi Santoso', 'position' => 'Ketua Umum', 'photo_url' => 'https://example.com/1.jpg'],
                ['name' => 'Prof. Siti Aisyah', 'position' => 'Wakil Ketua Umum', 'photo_url' => 'https://example.com/2.jpg'],
            ],
        ]);

        $response->assertRedirect('/admin/pengurus/ketum');

        $data = json_decode(file_get_contents(storage_path('app/pengurus.json')), true);

        $this->assertCount(2, $data['ketum']);
        $this->assertSame('Dr. Budi Santoso', $data['ketum'][0]['name']);
        $this->assertSame('Prof. Siti Aisyah', $data['ketum'][1]['name']);

        $publicResponse = $this->get('/pengurus/ketum');
        $publicResponse->assertStatus(200);
        $publicResponse->assertSee('Dr. Budi Santoso');
        $publicResponse->assertSee('Prof. Siti Aisyah');
    }
}
