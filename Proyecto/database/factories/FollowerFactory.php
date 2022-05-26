<?php
/**
 * DESCRIPCION: Fichero que genera datos aleatorios acordes al tipo de dato que se le indica
 */
namespace Database\Factories;

use App\Models\Follower;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Follower>
 */
class FollowerFactory extends Factory
{

    /**
     * @var string
     */
    protected $model = Follower::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            
            'user_id' => $this->faker->numberBetween(1,9), //Del 1 al 9 dentro de los usuarios creados
            'id_user_follower'=> $this->faker->numberBetween(1,4) //Algunos tendran seguidores y otros no
        ];
    }
}
