<?php


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

    private function getFigures($uid)
    {
        $t = "SELECT radius, color, posx, posy FROM circles WHERE user_id = '%s'";
        $query = sprintf($t, $uid);
        $result = $this->mpdo->Select($query);
        return $result;
    }

    public function getMap($uid)
    {
        $map = $this->getFigures($uid);
        $dataStrings = array();
        foreach ($map as $item){
            $circle = new M_Circle($item['radius'], $item['color'],$item['posx'],$item['posy']);
            $dataStrings[] = $circle->generateCircle('circle');
        }
        return $dataStrings;
    }
    
    public function randomParams () 
    {
        $radius = rand(RADIUS_MIN, RADIUS_MAX);
        $color = dechex(rand (0, COLOR_MAX));
        $color = '#' . sprintf("%06s", $color);
        $posx = rand ($radius, (BG_SIDE - $radius));
        $posy = rand ($radius, (BG_SIDE - $radius));
        $circle = new M_Circle($radius, $color,$posx,$posy);
        $dataString = $circle->generateCircle('circle');
        return $dataString;
    }
}