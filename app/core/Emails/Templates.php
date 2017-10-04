<?php namespace App\Emails;

/**
 * Templates
 *
 */
class Templates
{

    public static $dir     = 'emails';
    public static $wrapper = 'base/e_1';


    /**
    * build
    *
    *
    */
    public static function build($template, $options)
    {
        return view(self::$dir.'/'.self::$wrapper,[
            'message'=>view(self::$dir.'/'.$template, $options)
        ]);
    }


    //--------------------------------------------------------------------

}
