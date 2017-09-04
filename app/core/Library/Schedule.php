<?php namespace App\Library;

/**
 * Schedule Class
 *
 *
 */
class Schedule
{
    static $fcpath        = FCPATH.'index.php';
    static $logpath       = WRITEPATH.'logs/tasks';


    /*
    * register()
    *
    * Register a job in the Schedule
    *
    */
    public static function register(string $name, array $options)
    {
        $current = self::get();

        $name = strtolower($name);

        $time = '';
        if (isset($options['interval'],$options['interval_type']))
        {
            $time = self::simpleCronTime($options['interval'],$options['interval_type']);
        }

        $current[$name] = [
            "command"    => 'php {{PATH}} '.(isset($options['controller']) ? $options['controller'] : 'automated/default'),
            "schedule"   => (isset($options['schedule']) ? $options['schedule'] : $time),
            "output"     => (isset($options['output']) ? '{{PATH}}/'.$name.'.log' : ''),
            "status"     => (isset($options['status']) ? $options['status'] : 'enabled'),
            "runtime"    => (isset($options['max_runtime']) ? $options['max_runtime'] : 3600),
            "created_at" => date("Y-m-d H:i:s"),
            "updated_at" => "",
            "last_start" => "",
            "last_end"   => ""
        ];


        self::set($current);
    }


    //--------------------------------------------------------------------


    /**
    * getSettings()
    *
    * Get the current schedule
    *
    */
    public static function get($name = '')
    {
        $schedules = self::database()->customFilter('data',function($item) {
            return (($item['status']=='enabled') ? $item : false);
        });

        foreach($schedules as $k=>$s)
        {
            $schedules[$k]['command'] = str_replace('{{PATH}}',self::$fcpath,$schedules[$k]['command']);

            if (isset($schedules[$k]['output']))
            {
                $schedules[$k]['output']  = str_replace('{{PATH}}',self::$logpath,$schedules[$k]['output']);
            }
        }

        if ($name!='')
        {
            return $schedules[$name];
        }
        else
        {
            return $schedules;
        }

    }


    //--------------------------------------------------------------------


    /*
    * update()
    *
    * update a job in the Schedule
    *
    */
    public static function update(string $name, array $options)
    {
        $task = self::database();
        if (isset($task->$name))
        {
            if (!empty($options))
            {
                foreach($options as $option=>$value)
                {
                    $task->$name[$option] = $value;
                }

                $task->save();
            }
        }
    }


    //--------------------------------------------------------------------


    /**
    * setSchedule()
    *
    * Set the current schedule
    *
    * @param array $data
    *
    */
    protected static function set($data)
    {
        return self::database()->set($data)->save();
    }


    //--------------------------------------------------------------------


    /**
    * simpleCronTime()
    *
    * @param int $interval
    * @param string $interval_type
    *
    * @return string $time
    */
    public static function simpleCronTime($interval, $interval_type)
    {
        switch(strtoupper($interval_type))
        {
            case 'M' :
                $time = ($interval == 1) ? "* * * * *" : "*/".$interval." * * * *";
            break;

            case 'H' :
                $time = ($interval == 1) ? "0 * * * *" : "* */".$interval." * * *";
            break;

            case 'D' :
                $time = ($interval == 1) ? "15 3 * * *" : "15 3 */".$interval." * *";
            break;

            case 'W' :
                $time = "5 1 * * 0";
            break;

            default:
                $time = "* * * * *";

        }

        return $time;
    }


    //--------------------------------------------------------------------


    /**
    * database
    *
    *
    * @return \Filebase\Database
    */
    public static function database()
    {
        return \Config\Services::settings()->get('schedule');
    }



}
