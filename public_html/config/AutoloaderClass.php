<?php
function filesToRegister($path)
{
    $pathToScan = $_SERVER['DOCUMENT_ROOT'] . $path;
    $dirNames = [];
    $fullPathFilesName = [];
    $filesToTest = scandir($pathToScan);
    $filteredFilesTotest = array_diff($filesToTest, ['.', '..']);
    foreach($filteredFilesTotest as $filesTT){
        if(is_dir($pathToScan . DIRECTORY_SEPARATOR . $filesTT)){
            $dirNames[] = $filesTT;
        }
    }
    $fileNames = array_diff($filteredFilesTotest, $dirNames);
    foreach ($fileNames as $fileName){
        $fullPathFilesName[] = $pathToScan . DIRECTORY_SEPARATOR .$fileName;
    }
    return $fullPathFilesName;
}
    
function splSystemRegister()
{
    spl_autoload_register(
        function(){
            $arrayDitToScan = ["test", "model", "helper", "base"];
            foreach($arrayDitToScan as $dir){
                $files = filesToRegister(DIRECTORY_SEPARATOR . $dir);
                foreach ($files as $file){
                    include_once $file;
                }
            }
        }   
    );
}
    
