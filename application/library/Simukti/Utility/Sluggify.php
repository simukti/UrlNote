<?php
/**
 * Description of Sluggify
 *
 * @author Sarjono Mukti Aji <me@simukti.net>
 */
namespace Simukti\Utility;

class Sluggify
{
    /**
     * @param   string $string String to sluggify
     * @param   string $separator sluggify separator
     * @return  string Sluggified string
     */
    public static function create($string, $separator = '-')
    {
        $string = iconv('utf-8', 'ascii//translit', $string);
        $string = strtolower($string);
        $string = preg_replace('#[^a-z0-9\-]#', $separator, $string);
        $string = preg_replace('#-{2,}#', $separator, $string);
        $string = trim($string, $separator);
        
        return $string;
    }
}
