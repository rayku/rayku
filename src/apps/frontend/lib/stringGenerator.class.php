<?php
class stringGenerator
{
	public static function generate($length = 8)
	{
		$source = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$word = '';
		
		$length = max(0, $length);
		
		for ($i = 0; $i < $length; $i++)
		{
			$index = rand(0, strlen($source) - 1);
			$char = $source{$index};
			$word .= $char;
		}
		
		return $word;
	}
}
