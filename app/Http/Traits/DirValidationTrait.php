<?php

namespace App\Http\Traits;

use \App\User;
use \App\Models\BusinessCase;
use \App\Models\Folder;
use \App\Models\File;

trait DirValidationTrait
{
    public static function validate($folder, $path)
    {
        $pathArray = null;
        $pathFull = '/' . $folder->id . '/';

        if ($path != '') {
            $pathArray = explode('/', $path);
            $pathArray = array_filter($pathArray, 'strlen');
            $foldersArray = array();
            $countTo = 1;
            $lastIndex = File::where('id', end($pathArray))->first();
            if (!$lastIndex) return false;

            if ($lastIndex->type == 'folder') {
                $countTo = count($pathArray);
            } else {
                $countTo = count($pathArray) - 1;
            }
            //  Loop through IDs, validate hierarchy
            for ($i = 0; $i < $countTo; $i++) {
                $dir = '';
                if ($i != 0) {
                    for ($j = 0; $j < $i; $j++) {
                        $dir .= '/' . $foldersArray[$j]->id;
                    }
                } else {
                    $dir = '/';
                }

                $options = [
                    ['id', $pathArray[$i]],
                    ['folder_id', $folder->id],
                    ['dir', $dir],
                    ['type', 'folder']
                ];

                if (!\Gate::check('Операции-с-архивом'))
                    $options[] = ['isArchived', '0'];

                $file = File::where($options)->first();

                if (!$file) return false;

                $pathFull .= $file->id . '/';
                $foldersArray[] = $file;
            }

            if ($lastIndex->type == 'file') {
                $dir = '';
                if ($i != 0) {
                    for ($j = 0; $j < $i; $j++) {
                        $dir .= '/' . $foldersArray[$j]->id;
                    }
                } else {
                    $dir = '/';
                }

                $options = [
                    ['id', end($pathArray)],
                    ['folder_id', $folder->id],
                    ['dir', $dir]
                ];

                if (!\Gate::check('Операции-с-архивом'))
                    $options[] = ['isArchived', '0'];

                $file = File::where($options)->first();
                if (!$file) return false;

                $pathFull .= $file->filename;
            }
        }

        return $pathFull;
    }
}
