<?php namespace App\Library;

class View
{
    public static $output = true;
    public static $timeStart;
    public static $timeEnd;

    /**
    * sendBottom()
    *
    *
    */
    public static function add($text = '')
    {
        if (self::$output == false) return false;

        if (!is_cli())
        {
            print "<div>".$text."</div>";
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
        if (ob_get_level() == 0) ob_start();

        if (!is_cli()) 
        {
            echo '<style>body{font-family:"Lucida Console", Monaco, monospace;font-size:12px;color: #1ace22;color: #5fbb64;}a,a:hover,a:active,a:focus{color: #fff;}</style>';
            echo '<script>function toBottom(){window.scrollTo(0,document.body.scrollHeight);}var scrollInterval = setInterval(function(){window.scrollTo(0,document.body.scrollHeight);},20);</script>';

            echo '<div style="color:#00A8FF;font-size:11px;"># script started at '.date('Y-m-d H:i:s',self::$timeStart).'</div>';
            echo "<div style='font-weight:bold;color:#9B9B9B;padding-bottom:10px'>------------------------------------------------------</div>";
        }
        else
        {
            echo PHP_EOL.'script started:'.PHP_EOL;
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
            echo "<div style='font-weight:bold;color:#9B9B9B;padding-top:10px'>------------------------------------------------------</div>";
            echo "<div style='font-size:11px;color:#9B9B9B;color:#00A8FF;'># execution ended ".date('Y-m-d H:i:s',self::$timeEnd)." - (".$time." seconds)</div>";
            echo('<script>window.scrollTo(0,document.body.scrollHeight); clearInterval(scrollInterval);</script>');
        }
        else
        {
            echo "------------------------------------------------------".PHP_EOL;
            echo "# execution ended (".$time." seconds)".PHP_EOL;
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

            self::flush();

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
        if (!is_cli()) print str_pad('',intval(ini_get('output_buffering')))."\n";
        flush();
        if (ob_get_contents()) ob_clean();
    }

}
