<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\TaskHistory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TaskHistory>
 */
class TaskHistoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TaskHistory::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $actions = [
            TaskHistory::ACTION_CREATED,
            TaskHistory::ACTION_UPDATED,
            TaskHistory::ACTION_STATUS_CHANGED,
            TaskHistory::ACTION_NOTE_ADDED,
        ];

        $action = $this->faker->randomElement($actions);

        return [
            'task_id' => Task::factory(),
            'action' => $action,
            'old_value' => $this->generateOldValue($action),
            'new_value' => $this->generateNewValue($action),
            'changed_by' => User::factory(),
        ];
    }

    /**
     * Generate old value based on action type
     */
    private function generateOldValue(string $action): ?array
    {
        return match ($action) {
            TaskHistory::ACTION_CREATED => null,
            TaskHistory::ACTION_UPDATED => [
                'title' => $this->faker->sentence(3),
                'description' => $this->faker->paragraph(2),
            ],
            TaskHistory::ACTION_STATUS_CHANGED => [
                'status' => $this->faker->randomElement(['new', 'in_progress', 'pending']),
            ],
            TaskHistory::ACTION_NOTE_ADDED => null,
            default => null,
        };
    }

    /**
     * Generate new value based on action type
     */
    private function generateNewValue(string $action): ?array
    {
        return match ($action) {
            TaskHistory::ACTION_CREATED => [
                'title' => $this->faker->sentence(4),
                'description' => $this->faker->paragraph(3),
                'status' => 'new',
            ],
            TaskHistory::ACTION_UPDATED => [
                'title' => $this->faker->sentence(4),
                'description' => $this->faker->paragraph(3),
            ],
            TaskHistory::ACTION_STATUS_CHANGED => [
                'status' => $this->faker->randomElement(['in_progress', 'completed', 'pending']),
            ],
            TaskHistory::ACTION_NOTE_ADDED => [
                'note' => $this->faker->paragraph(2),
            ],
            default => null,
        };
    }

    /**
     * Indicate that the history is for task creation.
     */
    public function created(): static
    {
        return $this->state(fn (array $attributes) => [
            'action' => TaskHistory::ACTION_CREATED,
            'old_value' => null,
            'new_value' => [
                'title' => $this->faker->sentence(4),
                'description' => $this->faker->paragraph(3),
                'status' => 'new',
            ],
        ]);
    }

    /**
     * Indicate that the history is for task update.
     */
    public function updated(): static
    {
        return $this->state(fn (array $attributes) => [
            'action' => TaskHistory::ACTION_UPDATED,
            'old_value' => [
                'title' => $this->faker->sentence(3),
                'description' => $this->faker->paragraph(2),
            ],
            'new_value' => [
                'title' => $this->faker->sentence(4),
                'description' => $this->faker->paragraph(3),
            ],
        ]);
    }

    /**
     * Indicate that the history is for status change.
     */
    public function statusChanged(): static
    {
        $oldStatus = $this->faker->randomElement(['new', 'in_progress', 'pending']);
        $newStatus = $this->faker->randomElement(['in_progress', 'completed', 'pending']);

        return $this->state(fn (array $attributes) => [
            'action' => TaskHistory::ACTION_STATUS_CHANGED,
            'old_value' => ['status' => $oldStatus],
            'new_value' => ['status' => $newStatus],
        ]);
    }

    /**
     * Indicate that the history is for note addition.
     */
    public function noteAdded(): static
    {
        return $this->state(fn (array $attributes) => [
            'action' => TaskHistory::ACTION_NOTE_ADDED,
            'old_value' => null,
            'new_value' => [
                'note' => $this->faker->paragraph(2),
            ],
        ]);
    }
}
