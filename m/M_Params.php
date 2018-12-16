<?php

namespace m;

/**
 * Модель параметров для сохранения и отображения фигур
 * @property M_PDO $mpdo
 */

class M_Params
{
    private static $instance;
    private $mpdo;

    public static function Instance()
    {
        if (self::$instance == null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    private function __construct()
    {
        $this->mpdo = M_PDO::Instance();
    }

    /**
     * @param int $uid
     * @return array
     */
    private function getFigures($uid)
    {
        $t = "SELECT radius, color, posx, posy FROM circles WHERE user_id = '%s'";
        $query = sprintf($t, $uid);
        $result = $this->mpdo->Select($query);
        return $result;
    }

    /**
     * @param int $uid
     * @return array
     */
    public function getMap($uid)
    {
        $map = $this->getFigures($uid);
        $dataStrings = array();
        foreach ($map as $item){
            $circle = new M_Circle($item['radius'], $item['color'],$item['posx'],$item['posy']);
            $dataStrings[] = $circle->generateCircle();
        }
        return $dataStrings;
    }

    /**
     * @return array
     */
    public function randomParams () 
    {
        $radius = rand(RADIUS_MIN, RADIUS_MAX);
        $color = dechex(rand (0, COLOR_MAX));
        $color = '#' . sprintf("%06s", $color);
        $posx = rand ($radius, (BG_SIDE - $radius));
        $posy = rand ($radius, (BG_SIDE - $radius));
        $params = compact ('radius', 'color', 'posx', 'posy');
        return $params;
    }

    /**
     * @param null|array $p
     * @return array
     */
    public function randomCircle($p = NULL){
        $params = ($p === NULL) ? $this->randomParams() : $p;
        $circle = new M_Circle($params['radius'], $params['color'],$params['posx'],$params['posy']);
        $dataString = $circle->generateCircle();
        return $dataString;
    }

    /**
     * @param int $uid
     * @return int
     */
    public function countTouchings ($uid){
        $elements = $this->getFigures($uid);
        $touchings = array();
        for ($i = 0; $i < count($elements); $i++){
            $element1 = $elements[$i];
            foreach ($elements as $k => $element){
                if ($k != $i){
                    $element2 = $element;
                    if ($this->checkTouching($element1, $element2)){
                        $touchings[] = $i;
                        $touchings[] = $k;
                    }
                }
            }
        }
        return count (array_unique($touchings));
    }

    /**
     * @param array $element1
     * @param array $element2
     * @return bool
     */
    private function checkTouching ($element1, $element2){
        $x1 = $element1['posx'];
        $y1 = $element1['posy'];
        $r1 = $element1['radius'];
        $x2 = $element2['posx'];
        $y2 = $element2['posy'];
        $r2 = $element2['radius'];
        $distance = sqrt (pow(($x1 - $x2), 2) + pow(($y1 - $y2), 2));
        return ($distance <= ($r1 + $r2));
    }
}