<?php namespace App\Library;

class View
{
    public static $output = true;

    /**
    * sendBottom()
    *
    *
    */
    public static function add($text = '')
    {
        if (self::$output == false) return false;

        self::flushBuffer();

        if (!is_cli())
        {
            print "<div>".$text."</div>";
            print('<script>window.scrollTo(0,document.body.scrollHeight);</script>');
        }
        else
        {
            print $text.PHP_EOL;
        }

        self::flushBuffer();
    }


    /**
    * start()
    *
    *
    */
    public static function start()
    {
        ob_start();

        if (!is_cli())
        {
            print '<style>body{font-family:"Lucida Console", Monaco, monospace;font-size:12px</style>';
            print '<script>function toBottom(){window.scrollTo(0,document.body.scrollHeight);}</script>';
            print '<div style="color:#00A8FF;font-size:11px;">starting...</div>';
            print "<div style='font-weight:bold;color:#9B9B9B;padding-bottom:10px'>----------------------------------------------------------------------------</div>";
        }
        else
        {
            print PHP_EOL.'starting...'.PHP_EOL;
        }

        self::flushBuffer();
    }


    /**
    * end()
    *
    *
    */
    public static function end($time = 0)
    {
        self::flushBuffer();

        if (!is_cli())
        {
            print "<div style='font-weight:bold;color:#9B9B9B;padding-top:10px'>----------------------------------------------------------------------------</div>";
            print "<div style='font-size:11px;color:#9B9B9B;'># execution ended (".$time." minutes)</div>";
        }
        else
        {
            print "----------------------------------------------------------------------------".PHP_EOL;
            print "# execution ended (".$time." minutes)".PHP_EOL;
        }

        self::flushBuffer();
    }


    /**
    * flushBuffer()
    *
    *
    */
    protected static function flushBuffer()
    {
        if (ob_get_contents())
        {
            if (ob_get_contents()) ob_end_flush();
            if (ob_get_contents()) ob_flush();

            flush();

            if (ob_get_contents()) ob_clean();

            ob_start();
        }
    }


    /**
    * flush()
    *
    *
    */
    protected static function flush()
    {
        print str_pad('',intval(ini_get('output_buffering')))."\n";
        flush();
        if (ob_get_contents()) ob_clean();
    }

}
