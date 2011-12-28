<?php

class MyTools
{
	/**
	 * Generate a random string, sha1'ed
	 *
	 * @param integer $seed_length
	 * @return string
	 */
	public static function generateRandomKey($seed_length = 10)
	{
		$raw_string = '';

		for ($i = 0; $i < $seed_length; $i++)
		{
			$ascii_code = rand(32, 254);

			$raw_string .= chr($ascii_code);
		}

		return sha1($raw_string);
	}
	/**
	 * create thumbnail using sfThumbnail plugin
	 *
	 * @param string $src
	 * @param string $dst
	 * @param integer $maxWidth
	 * @param integer $maxHeight
	 * @param integer $scale
	 * @param integer $inflate
	 * @param Array $transparency
	 * @param integer $quality
	 * @return mixed thumbnail
	 */

	  public static function resample($src, $dst = false, $maxWidth=80, $maxHeight=80, $scale = true, $inflate = true, $transparency = array('red'=>255, 'green'=>255, 'blue'=>255), $quality=75)
  {
  			$thumbnail = new sfThumbnail($maxWidth, $maxHeight);
			$thumbnail->loadFile($src);
			 if ($dst)
        	{
		  		//if dst is a filename (string) then write the resampled image to that file. if it's TRUE (boolean) write the thumb to the same file. if it's FALSE (boolean) return the resource
          		if (is_bool($dst)) $dst = $src;
          		
				$thumbnail->save($dst);
        	}
			else 
			{
			  	return $thumbnail;
			}
			
  }

}
