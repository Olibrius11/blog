<?php

/*
 * This file is part of P5 - OPCR Blog package.
 *
 * (c) Vincent Lemire <v.lemire@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Blog\Controller;

class HomePageController
{
    public function index()
    {
        return file_get_contents("./templates/home.html");
    }
}
