<?php

namespace Database\Factories;

use App\Models\Audio;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TopicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'    => $this->faker->sentence(),
            'time'     => $this->faker->time('i:s'),
            'user_id'  => User::all()->random()->id,
            'audio_id' => Audio::all()->random()->id,
        ];
    }
}
