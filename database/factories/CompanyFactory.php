<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_name_ar' => $this->faker->company(),
            'company_name_en' => $this->faker->company(),
            'cr_number' => $this->faker->unique()->numerify('##########'),
            'establishment_number' => $this->faker->numerify('########'),
            'license_number' => $this->faker->numerify('########'),
            'tax_number' => $this->faker->numerify('##########'),
            'company_type' => $this->faker->randomElement(['LLC', 'Corporation', 'Partnership']),
            'isic_code' => $this->faker->numerify('####'),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->companyEmail(),
            'website' => $this->faker->optional()->url(),
            'region' => $this->faker->city(),
            'city' => $this->faker->city(),
            'district' => $this->faker->streetName(),
            'street' => $this->faker->streetAddress(),
            'building_number' => $this->faker->buildingNumber(),
            'postal_code' => $this->faker->postcode(),
            'additional_location' => $this->faker->optional()->address(),
            'owner_name' => $this->faker->name(),
            'owner_id_number' => $this->faker->numerify('##########'),
            'owner_nationality' => $this->faker->country(),
            'legal_status' => $this->faker->randomElement(['Active', 'Inactive', 'Suspended']),
            'establishment_date' => $this->faker->dateTimeBetween('-10 years', 'now'),
            'capital_amount' => $this->faker->randomFloat(2, 10000, 1000000),
            'status' => 'active',
        ];
    }
}
