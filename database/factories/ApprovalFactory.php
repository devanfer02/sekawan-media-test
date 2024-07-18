<?php

namespace Database\Factories;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Approval>
 */
class ApprovalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = collect(['Pending', 'Approved', 'Rejected']);

        $approvers = User::whereHas('role', function($q) {
            $q->where('role_name', '=', 'Approver');
        })->get();

        $reservations = Reservation::all();

        return [
            'reservation_id' => $reservations->random()->reservation_id,
            'approver_id' => $approvers->random()->user_id,
            'status' => $status->random(),
            'comments' => fake()->sentence(),
        ];
    }
}
