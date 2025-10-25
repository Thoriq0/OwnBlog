<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Content>
 */
class ContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = ['tech-notes', 'projects', 'tutorials', 'stories', 'writing'];
        $statuses = ['draft', 'published'];
        $tags = ['Laravel', 'PHP', 'JavaScript', 'Vue', 'React', 'Tailwind', 'Next.js'];

        $title = fake()->sentence(6);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'category' => fake()->randomElement($categories),
            'tags' => implode(', ', fake()->randomElements($tags, rand(1, 3))),
            'status' => fake()->randomElement($statuses),
            'author' => "Thoriq",
            'contents' => fake()->paragraphs(rand(3, 8), true),
            'views' => fake()->randomNumber(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
