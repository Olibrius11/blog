<?php
namespace Blog\Test;

class TestController
{
    public function received()
    {
        return "received";
    }

    public function favouriteFood($food)
    {
        return $food;
    }

    public function favouriteFoods($food, $color, $quantity)
    {
        return "You love $quantity piece(s) of $color $food";
    }
}
