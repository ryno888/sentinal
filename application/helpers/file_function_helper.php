<?php

/*
 * Class 
 * @filename lib 
 * @encoding UTF-8
 * @author Liquid Edge Solutions  * 
 * @copyright Copyright Liquid Edge Solutions. All rights reserved. * 
 * @programmer Ryno van Zyl * 
 * @date 14 Feb 2017 * 
 */

/**
 * Description of lib
 *
 * @author Ryno
 */
class file_function_helper {
    //--------------------------------------------------------------------------
    public static function mkdir($dir) {
		if (!is_dir($dir)) {
            mkdir($dir, 0777, true);  
        }
	}
    //--------------------------------------------------------------------------------
    /**
     * Completely removes a directory and all its contents
     * @param type $dir
     */
    public static function delete_directory($dir) { 
        foreach(glob("{$dir}/*") as $file){
            if(is_dir($file)) { 
                self::delete_directory($file);
            } else {
                unlink($file);
            }
        }
        if(is_dir($dir)){
            @rmdir($dir);
        }
     }
    //--------------------------------------------------------------------------
}