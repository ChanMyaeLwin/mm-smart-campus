<?php

use App\Models\User;

it('has proper API routes configured', function () {
    $response = $this->getJson('/api/v1/students');
    // Should return 401 without authentication
    $response->assertStatus(401);
});

it('validates student creation with form request', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    // Test validation errors
    $response = $this->postJson('/api/v1/students', [
        'first_name' => '', // Required field missing
        'gender' => 'invalid', // Invalid enum value
        'date_of_birth' => '2030-01-01', // Future date
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['first_name', 'gender', 'date_of_birth']);
});

it('creates student with proper validation messages', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->postJson('/api/v1/students', [
        'gender' => 'invalid_value'
    ]);

    $response->assertStatus(422)
        ->assertJsonPath('errors.gender.0', 'The gender must be male, female, or other.');
});

it('student model has proper relationships', function () {
    $student = \App\Models\Student::factory()->create();
    
    expect($student->user)->toBeInstanceOf(\App\Models\User::class);
    expect($student->user->student)->toBeInstanceOf(\App\Models\Student::class);
});

it('student model has computed attributes', function () {
    $student = \App\Models\Student::factory()->create([
        'first_name' => 'John',
        'last_name' => 'Doe',
        'date_of_birth' => '2000-01-01'
    ]);
    
    expect($student->full_name)->toBe('John Doe');
    expect($student->age)->toBeGreaterThan(20);
});