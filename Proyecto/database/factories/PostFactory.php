<?php
/**
 * DESCRIPCION: Fichero que genera datos aleatorios acordes al tipo de dato que se le indica
 */

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{


    /**
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(), //parrafo
            'buy_on' => $this->faker->sentence(),
            'date_publication'=> $this->faker->date(), //fecha
            'image' => $this->faker->sentence(),
            'user_id' => $this->faker->numberBetween(1,9), //1 al 9 dentro del numero de usuarios creados
            'likes' => '0',
            'comentarios' => '0'
        ];
    }
}
