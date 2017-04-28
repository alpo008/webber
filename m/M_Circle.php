<?php

class M_Circle extends M_Figure
{
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

    public function generateCircle(){
        $tag = $this->generateTag('circle');
        return $tag;
    }
}