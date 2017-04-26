<?php

/**
 * Created by PhpStorm.
 * User: alpo
 * Date: 26.04.17
 * Time: 18:54
 */
class M_Circle extends M_Figure
{
    protected $bdrs;
    public function __construct($rad, $col, $pX, $pY)
    {
        $w = $h = 2 * $rad;
        $bd = 'none';
        $pX -= $rad;
        $pY -= $rad;

        parent::__construct($w, $h, $bd, $col, $pX, $pY);
        $this->position = 'absolute';
        $this->bdrs = '50%';
    }

    public function generateCircle($class){
        $tag = $this->generateTag($class);
        $style = "
        border-radius: $this->bdrs;
        top: $this->posY;
        left: $this->posX;
        ";


        $tag['style'] .= $style;

        return $tag;
    }
}