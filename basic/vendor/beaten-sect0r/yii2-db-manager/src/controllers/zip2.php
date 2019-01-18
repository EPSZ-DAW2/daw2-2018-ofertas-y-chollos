<?php

function dirToArray($dir_path) {
    $result = array();
    $path = realpath($dir_path);
    $objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::SELF_FIRST);
    foreach($objects as $name => $object) {
        if( $object->getFilename() !== "." && $object->getFilename() !== "..") {
            $result[] = $object;
        }
    }
    return $result;
}

/* creates a compressed zip file */
function create_zip($productPath = '', $dirName = '', $overwrite = false) 
{
    $fullProductPath = $productPath.$dirName;
    $a_filesFolders = dirToArray( $fullProductPath );
    var_dump($a_filesFolders);
    //if the zip file already exists and overwrite is false, return false
    $zip = new \ZipArchive();
    $zipProductPath =  $fullProductPath.'.zip';
    if($zip->open( $zipProductPath ) && !$overwrite){
        $GLOBALS["errors"][] = "The directory {$zipProductPath} already exists and cannot be removed.";
    }

    //if files were passed in...
    if(is_array($a_filesFolders) && count($a_filesFolders)){
        $opened = $zip->open( $zipProductPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE );
        if( $opened !== true ){
            $GLOBALS["errors"][] = "Impossible to open {$zipProductPath} to edit it.";
        }

        //cycle through each file
        foreach($a_filesFolders as $object) {
            //make sure the file exists
            $fileName = $object -> getFilename();
            $pathName = $object -> getPathname();
            if(file_exists($pathName)) {
                $pos = strpos($zipProductPath , "/tmp/") + 5;
                $fileDestination = substr($pathName, $pos);
                echo $pathName.'<br/>';
                echo $fileDestination.'<br/>';
                $zip->addFile($pathName,$fileDestination);
            }
            else if(is_dir( $pathName )){
                $pos = strpos($zipProductPath , "/tmp/") + 5;
                $fileDestination = substr($pathName, $pos);
                $zip->addEmptyDir($fileDestination);
            }else{
                $GLOBALS["errors"][] = "the file ".$fileName." does not exist !";
            }
        }

        //close the zip -- done!
        $zip->close();
        //check to make sure the file exists
        return file_exists($zipProductPath);
    }else{
        return false;
    }
}