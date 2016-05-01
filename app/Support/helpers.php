<?php 

use Illuminate\Support\Str;

if(!function_exists('excerpt'))
{
	/**
	 * excerpt extract of a text
	 * 
	 * @param  string  $text  the text
	 * @param  integer $limit default 20
	 * @param  string  $end   what you add in the end
	 * @return string 
	 */
	function excerpt($text,$limit = 20, $end='...')
	{
		return Str::words($text,$limit,$end);
	}
}