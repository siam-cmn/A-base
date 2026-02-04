<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Organization>
 */
class OrganizationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $prefix = ['デジタル', 'サイバー', 'クラウド', 'スマート', 'ネクスト', 'コア', 'ブルー'];
        $suffix = ['システムズ', 'ソリューションズ', 'テクノロジーズ', 'ラボ', 'ワークス', 'ギルド'];

        $companyName = Arr::random($prefix).Arr::random($suffix).'株式会社';

        return [
            'name' => $companyName,
            'slug' => fake()->unique()->slug(),
        ];
    }
}
