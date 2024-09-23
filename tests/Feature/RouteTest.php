<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RouteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_access_the_home_page()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_access_the_employee_authenticate_route()
    {
        $response = $this->post('/api/employee/authenticate', [
            // Add request data here
        ]);

        $response->assertStatus(200); // Change to expected status code
    }

    // Add more tests for other routes
}
