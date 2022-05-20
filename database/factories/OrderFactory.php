<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $status = 'Active';
        $text = $this->faker->realText(60, 2);
        $comments = ['',$text];
        $comment = $comments[rand(0,1)];
        if($comment){
            $status = 'Resolved';
        }

        return [
            'user_id'=>rand(3,15),
            'manager_id'=>rand(1,2),
            'status'=> $status,
            'message'=>$this->faker->realText(200, 2),
            'comment'=>$comment,
        ];
    }
}
