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

    public function getFoldersTree()
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

        $iterator = new FilesystemIterator("/home/texas");
        foreach($iterator as $entry) {
/*            if ($entry->getType() == 'dir') {
                $fileList[] = [
                    'type' => $entry->getType(),
                    'name' => strtoupper($entry->getFilename())
                ];
            } else {
                $fileList[] = [
                    'type' => $entry->getType(),
                    'name' => strtoupper($entry->getFilename())
                ];
            }*/
            if ($entry->getType() == 'dir') {
                $fileList[] = strtoupper($entry->getFilename());
            } else {
                $fileList[] = $entry->getFilename();
            }
	    }
        return $fileList;
    }
}