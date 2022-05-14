<?php
/**
 * DESCRIPCION: Fichero que genera datos aleatorios acordes al tipo de dato que se le indica
 */
namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{

    /**
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            
            'text' => $this->faker->sentence(),
            'user_id' => $this->faker->numberBetween(1,9), //Del 1 al 9 dentro de los usuarios creados
            'post_id' => $this->faker->numberBetween(1, 29), //Del 1 al 29 dentro de los post creados
            'comment_replied_id' => $this->faker->numberBetween(1) //Respuesta al primer comentario

        ];
    }
}
