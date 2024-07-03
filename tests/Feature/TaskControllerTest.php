<?php

use Tests\TestCase;
use App\Models\Task;
use App\Models\Animal;
use App\Models\User;


use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TaskControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testStoreTask()
    {
        // Create a user (you can use factory or create as needed)
        //$user = factory(\App\Models\User::class)->create();

        // Create an animal for the user (you can use factory or create as needed)
       // $animal = factory(Animal::class)->create(['user_id' => $user->id]);

        // Define the data to be used for task creation
        $data = [
            'title' => 'Task 1',
            'start_date' => '2023-11-07',
            'start_hour' => '10:00',
            'start_minute' => '00',
            'end_date' => '2023-11-07',
            'end_hour' => '11:00',
            'end_minute' => '00',
            'status' => 'incomplete',
            'priority' => 'high',
            'description' => 'This is task 1',
            'associated_to' => 'Some Associated Data',
            'color' => '#FF0000',
            'repeats' => 'daily',
            'repeat_frequency' => 1,
            'end_repeat_date' => '2023-11-14',
        ];

        // Simulate a POST request to store the task
       // $response = $this->actingAs($user)->post(route('tasks.store', ['animal_id' => $animal->id]), $data);

        // Assert that the task was created successfully
       // $response->assertStatus(302); // Assuming you are returning a redirect response
       // $response->assertSessionHas('success', 'task created successfully.');

        // Assert the task creation in the database
        //$this->assertDatabaseHas('tasks', [
           // 'title' => 'Task 1',
           // 'start_date' => '2023-11-07',
           // 'start_hour' => '10:00',
           // 'status' => 'incomplete',
           // 'description' => 'This is task 1',
            // Add more expected values here
       // ]);

        // Optionally, you can add more specific assertions based on your implementation
    }
}
