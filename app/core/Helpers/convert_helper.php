<?php


if (!function_exists('format_bytes'))
{
	/**
	 * Format Bytes into units
	 *
	 * @return string
	 * @link https://stackoverflow.com/questions/2510434/format-bytes-to-kilobytes-megabytes-gigabytes
	 */
	function format_bytes($size, $precision = 2)
	{
		$base = log($size, 1024);
	    $suffixes = array('', 'KB', 'MB', 'GB', 'TB');

	    return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
	}

}
