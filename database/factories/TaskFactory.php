<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $statuses = [
            Task::STATUS_NEW,
            Task::STATUS_IN_PROGRESS,
            Task::STATUS_COMPLETED,
            Task::STATUS_PENDING,
        ];

        return [
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(3),
            'assigned_to' => User::factory(),
            'status' => $this->faker->randomElement($statuses),
            'due_date' => $this->faker->optional(0.7)->dateTimeBetween('now', '+30 days'),
            'created_by' => User::factory(),
        ];
    }

    /**
     * Indicate that the task is new.
     */
    public function newTask(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Task::STATUS_NEW,
        ]);
    }

    /**
     * Indicate that the task is in progress.
     */
    public function inProgress(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Task::STATUS_IN_PROGRESS,
        ]);
    }

    /**
     * Indicate that the task is completed.
     */
    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Task::STATUS_COMPLETED,
        ]);
    }

    /**
     * Indicate that the task is pending.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Task::STATUS_PENDING,
        ]);
    }

    /**
     * Indicate that the task is overdue.
     */
    public function overdue(): static
    {
        return $this->state(fn (array $attributes) => [
            'due_date' => $this->faker->dateTimeBetween('-30 days', '-1 day'),
            'status' => $this->faker->randomElement([
                Task::STATUS_NEW,
                Task::STATUS_IN_PROGRESS,
                Task::STATUS_PENDING,
            ]),
        ]);
    }

    /**
     * Indicate that the task is due soon.
     */
    public function dueSoon(): static
    {
        return $this->state(fn (array $attributes) => [
            'due_date' => $this->faker->dateTimeBetween('now', '+7 days'),
            'status' => $this->faker->randomElement([
                Task::STATUS_NEW,
                Task::STATUS_IN_PROGRESS,
                Task::STATUS_PENDING,
            ]),
        ]);
    }

    /**
     * Indicate that the task has no due date.
     */
    public function noDueDate(): static
    {
        return $this->state(fn (array $attributes) => [
            'due_date' => null,
        ]);
    }
}
