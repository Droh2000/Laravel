<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Aqui creamos la definicion para nuestro modelo de datos
        // Ademas aqui podemos usar el componente de faker() para generar estos datos aleatorios
        $name = $this->faker->name();// Lo creamos en una varaible aparte por el SLUG ya que queremos que coincidan
        return [
            'title' => $name,
            'slug' => str($name)->slug(),
            'content' => $this->faker->paragraph(20),
            'description' => $this->faker->paragraph(4),
            'category_id' => $this->faker->randomElement([1,2,3]),
            'posted' => $this->faker->randomElement(['yes','no']),
            'image' => $this->faker->imageUrl(),
        ];
    }
}
