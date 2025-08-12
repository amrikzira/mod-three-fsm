<?php

namespace Tests\Feature;

use Tests\TestCase;

class Modulo3ApiTest extends TestCase
{
    /** @test */
    public function it_returns_correct_result_for_divisible_number()
    {
        // "110" binary = 6
        // S0 -(1)-> S1 -(1)-> S0 -(0)-> S0
        $response = $this->postJson('/api/modulo3', ['bits' => '110']);

        $response->assertStatus(200)
                 ->assertJson([
                     'final_state' => 'S0',
                     'remainder' => 0,
                     'divisible' => true,
                 ]);
    }

    /** @test */
    public function it_returns_correct_result_for_non_divisible_number()
    {
        // "1011" binary = 11
        // S0 -(1)-> S1 -(0)-> S2 -(1)-> S2 -(1)-> S2
        $response = $this->postJson('/api/modulo3', ['bits' => '1011']);

        $response->assertStatus(200)
                 ->assertJson([
                     'final_state' => 'S2',
                     'remainder' => 2,
                     'divisible' => false,
                 ]);
    }

    /** @test */
    public function it_rejects_invalid_bits_string()
    {
        $response = $this->postJson('/api/modulo3', ['bits' => '10a1']);

        $response->assertStatus(422)
                 ->assertJsonStructure(['error']);
    }

    /** @test */
    public function it_accepts_bits_as_array()
    {
        // [1, 0, 1] → S0 -(1)-> S1 -(0)-> S2 -(1)-> S2
        $response = $this->postJson('/api/modulo3', ['bits' => [1, 0, 1]]);

        $response->assertStatus(200)
                 ->assertJson([
                     'final_state' => 'S2',
                     'remainder' => 2,
                     'divisible' => false,
                 ]);
    }
}
