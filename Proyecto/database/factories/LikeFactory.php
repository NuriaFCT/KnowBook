<?php
/**
 * DESCRIPCION: Fichero que genera datos aleatorios acordes al tipo de dato que se le indica
 */
namespace Database\Factories;

use App\Models\Like;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Like>
 */
class LikeFactory extends Factory
{


     /**
     * @var string
     */
    protected $model = Like::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            
            'user_id' => $this->faker->numberBetween(1,9), //1 al 9 dentro de los usuarios creados
            'post_id' => $this->faker->numberBetween(1, 29) //1 al 29 dentro de los post creados

        ];
    }
}
