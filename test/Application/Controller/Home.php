<?php
/**
 * Created by PhpStorm.
 * User: lia
 * Date: 16/10/15
 * Time: 02:40
 */

namespace Application\Controller;

use Application\Form\Ressources;

class Home
{
    public function home() {
        echo 'Hello World';
    }

    public function form() {

        $az = new Ressources('toto');
        $e = '';

    }
}