<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SpokeLengthListControllerTest extends TestCase
{
    use RefreshDatabase;

    private $loginUser;

    public function setUp(): void
    {
        parent::setUP();
        $this->loginUser = User::factory()->create();
    }

    public function testGuestIndex()
    {
        $response = $this->get(route('wheel.index'));
        $response->assertRedirect(route('login'));
    }

    public function testAuthIndex()
    {
        $response = $this->actingAs($this->loginUser)->get(route('wheel.index'));
        $response->assertStatus(200)->assertViewIs('wheel.index');
    }
}
