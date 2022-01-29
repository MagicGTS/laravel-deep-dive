<?php

namespace Tests\Feature;

use App\Models\NewsSubscription;
use Tests\TestCase;

class BaseTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_empty_request_subscription()
    {
        $response = $this->post('/emailnewssubscribe');
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['message']);
    }
    public function test_to_early_retry_subscription()
    {
        NewsSubscription::factory()->count(1)->verify_request_now()->create(['email' => 'grunolfsson@example.com']);
        $response = $this->post('/emailnewssubscribe', ['email' => 'grunolfsson@example.com']);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['message']);
    }
    public function test_retry_subscription()
    {
        NewsSubscription::factory()->count(1)->verify_request_3h_ago()->create(['email' => 'destiney.gutmann@example.org']);
        $response = $this->post('/emailnewssubscribe', ['email' => 'destiney.gutmann@example.org']);
        $response->assertStatus(302);
        $response->assertSessionHas('message');
        $response->assertSessionHasNoErrors();

    }
    public function test_new_subscription()
    {
        $response = $this->post('/emailnewssubscribe', ['email' => 'xbuckridge@example.net']);
        $response->assertStatus(302);
        $response->assertSessionHas('message');
        $response->assertSessionHasNoErrors();

    }
}
