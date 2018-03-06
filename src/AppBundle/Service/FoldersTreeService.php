<?php
/**
 * Created by PhpStorm.
 * User: texas
 * Date: 3/3/18
 * Time: 11:15 PM
 */

namespace AppBundle\Service;
use FilesystemIterator;


class FoldersTreeService
{

    public function getFoldersTree($path = '/')
    {
        $fileList = [];
/*        if ($handle = opendir('/')) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != "..") {
                    $fileList[] = $file;
                }
            }
            closedir($handle);
        }*/

        $iterator = new FilesystemIterator($path);
        foreach($iterator as $entry) {
            $fileList[] = [
                'type' => $entry->getType(),
                'path' => $entry->getPath(),
                'name' => $entry->getType() == 'dir' ? strtoupper($entry->getFilename()) : $entry->getFilename()
            ];
	    }
        return $fileList;
    }
}