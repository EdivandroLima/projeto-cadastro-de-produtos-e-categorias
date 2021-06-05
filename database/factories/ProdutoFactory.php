<?php

namespace Database\Factories;

use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdutoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Produto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->unique()->realText(15),
            'estoque' => $this->faker->numberBetween(1, 30),
            'preco' => $this->faker->numberBetween(1000, 5000),
            'categoria_id' => $this->faker->numberBetween(2, 15),
            'user_id' => 1,
        ];
    }
}
