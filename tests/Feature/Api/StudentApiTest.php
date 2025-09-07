<?php

use App\Models\Student;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

it('can list students via API', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    // Create a student
    $student = Student::factory()->create();

    $response = $this->getJson('/api/v1/students');

    $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'first_name',
                    'last_name',
                    'date_of_birth',
                    'gender',
                    'address',
                    'phone_number',
                    'enrollment_date',
                    'user_id',
                    'created_at',
                    'updated_at'
                ]
            ],
            'meta' => [
                'current_page',
                'last_page',
                'per_page',
                'total'
            ]
        ]);
});

it('can create a student via API', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    $studentUser = User::factory()->create();
    
    $studentData = [
        'user_id' => $studentUser->id,
        'first_name' => 'John',
        'last_name' => 'Doe',
        'date_of_birth' => '2000-01-01',
        'gender' => 'male',
        'address' => '123 Test Street',
        'phone_number' => '+1234567890',
        'enrollment_date' => '2023-09-01',
    ];

    $response = $this->postJson('/api/v1/students', $studentData);

    $response->assertStatus(201)
        ->assertJsonStructure([
            'message',
            'data' => [
                'id',
                'first_name',
                'last_name',
                'date_of_birth',
                'gender',
                'address',
                'phone_number',
                'enrollment_date',
                'user_id',
                'created_at',
                'updated_at'
            ]
        ]);

    $this->assertDatabaseHas('students', [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'user_id' => $studentUser->id,
    ]);
});

it('can show a specific student via API', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    $student = Student::factory()->create();

    $response = $this->getJson("/api/v1/students/{$student->id}");

    $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                'id',
                'first_name',
                'last_name',
                'date_of_birth',
                'gender',
                'address',
                'phone_number',
                'enrollment_date',
                'user_id',
                'created_at',
                'updated_at'
            ]
        ]);
});

it('requires authentication for student API endpoints', function () {
    $response = $this->getJson('/api/v1/students');
    $response->assertStatus(401);

    $response = $this->postJson('/api/v1/students', []);
    $response->assertStatus(401);
});