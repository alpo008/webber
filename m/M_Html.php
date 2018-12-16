<?php

namespace m;


class M_Html
{
    public static function makeTag ($tdata)
    {
        $attributes = '';
        if (isset($tdata['attributes'])){
            foreach ($tdata['attributes'] as $attName => $attValue){
                $attributes .= $attName . '= "' . $attValue . '" ';
            }
        }
        $str = '<' . $tdata['tagname'] . ' ' . $attributes . '>';
        if (isset($tdata['inner_html'])){
            $str .= $tdata['inner_html'];
        }
        $str .= '</' . $tdata['tagname'] . '>';
        return $str;
    }
}