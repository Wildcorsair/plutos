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
        $iterator = new FilesystemIterator($path);
        foreach($iterator as $entry) {
            $fileList[] = [
                'type' => $entry->getType(),
                'path' => $entry->getPath(),
                'name' => $entry->getFilename()
            ];
	    }
        return $fileList;
    }
}