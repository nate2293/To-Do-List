<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that an authenticated user can create a task.
     */
    public function test_user_can_create_a_task(): void
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        $response = $this
            ->actingAs($user)
            ->post(route('tasks.store'), [
                'title' => 'Test Task',
                'description' => 'This is a test task.',
                'completed' => false,
            ]);

        // Assert
        $response->assertRedirect(route('tasks.index'));

        $this->assertDatabaseHas('tasks', [
            'title' => 'Test Task',
            'description' => 'This is a test task.',
            'user_id' => $user->id,
        ]);
    }

    /**
     * Test that a user can update their task.
     */
    public function test_user_can_update_a_task(): void
    {
        // Arrange
        $user = User::factory()->create();

        $task = Task::factory()->create([
            'user_id' => $user->id,
        ]);

        // Act
        $response = $this
            ->actingAs($user)
            ->put(route('tasks.update', $task), [
                'title' => 'Updated Task',
                'description' => 'This task has been updated.',
                'completed' => false,
            ]);

        // Assert
        $response->assertRedirect(route('tasks.index'));

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'Updated Task',
            'description' => 'This task has been updated.',
        ]);
    }

    /**
     * Test that a user can delete their task.
     */
    public function test_user_can_delete_a_task(): void
    {
        // Arrange
        $user = User::factory()->create();

        $task = Task::factory()->create([
            'user_id' => $user->id,
        ]);

        // Act
        $response = $this
            ->actingAs($user)
            ->delete(route('tasks.destroy', $task));

        // Assert
        $response->assertRedirect(route('tasks.index'));

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
        ]);
    }

    /**
     * Test that a user only sees their own tasks.
     */
    public function test_user_only_sees_their_own_tasks(): void
    {
        // Arrange
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        Task::factory()->create([
            'title' => 'My Task',
            'user_id' => $user->id,
        ]);

        Task::factory()->create([
            'title' => 'Another Users Task',
            'user_id' => $otherUser->id,
        ]);

        // Act
        $response = $this
            ->actingAs($user)
            ->get(route('tasks.index'));

        // Assert
        $response->assertStatus(200);
        $response->assertSee('My Task');
        $response->assertDontSee('Another Users Task');
    }
}
