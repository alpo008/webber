<?php

namespace m;

/**
 * Модель геометрической фигуры
 * @property string $position
 * @property string $bdrs
 * @property double $width
 * @property double $height
 * @property string $border
 * @property string $color
 * @property double $posX
 * @property double $posY
 */

class M_Figure
{
    protected $position;
    protected $width;
    protected $height;
    protected $border;
    protected $color;
    protected $posX;
    protected $posY;
    protected $bdrs;


    public function __construct($w, $h, $bd, $col, $pX = 0, $pY = 0)
    {
        $this->position = 'relative';
        $this->width = $w.'px';
        $this->height = $h.'px';
        $this->border = (!!$bd) ? $bd : 'none';
        $this->color = $col;
        $this->posX = $pX.'px';
        $this->posY = $pY.'px';
        $this->bdrs = '0%';
    }

    /**
     * @param string $class
     * @return string
     */
    public function generateTag ($class, $innerHtml=NULL)
    {
        $style = "
        position: $this->position;
        width: $this->width;
        height: $this->height;
        border: $this->border;
        background-color: $this->color;
        border-radius: $this->bdrs;
        top: $this->posY;
        left: $this->posX;
        ";
        $str = '<div class="' . $class .'" style ="' . $style . '">';
        if (!!$innerHtml){
                $str .= implode('', $innerHtml);
        }
        $str .= '</div>';
        return $str;
    }
}