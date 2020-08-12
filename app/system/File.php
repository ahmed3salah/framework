<?php


namespace App\system;

use App\Exceptions\CannotCopyFile;
use App\Exceptions\CannotCutFile;
use App\Exceptions\CannotRenameFile;
use App\Exceptions\FileNotExists;

class File
{

    protected string $path;

    protected string $name;

    protected string $ext;

    protected string $mime;

    protected string $size;

    protected string $dir_name;

    protected string $base_name;

    public function __construct($file_path)
    {
        if(!file_exists($file_path)){
            throw(new FileNotExists('Cannot find the file in the path'));
        }

        $this->path = $file_path;

        $this->base_name = basename($this->path);

        $this->name = pathinfo($this->path, PATHINFO_FILENAME);

        $this->dir_name = pathinfo($this->path, PATHINFO_DIRNAME);

        $this->ext = pathinfo($this->path, PATHINFO_EXTENSION);

        $this->size = filesize($file_path);


    }

    public function move($dest_path){

        $this->CheckDirAndCreateItIfNotFound($dest_path);


        if(copy($this->path, $dest_path)){
            # delete the old file
            // TODO :: activate this after testing
            # unlink($this->path);
            # create instance for the new file
            $new_file = new File($dest_path);

            return $new_file;
        }

        throw(new CannotCutFile("Cannot cut the file {$this->path} to the {$dest_path}"));
    }

    public function copy($dest_path){

        $this->CheckDirAndCreateItIfNotFound($dest_path);

        if(!copy($this->path, $dest_path))
            throw new CannotCopyFile('Cannot copy the file to the dest dir');

        return $this;
    }

    public function rename($new_name){
        if(rename($this->path, $new_name)){

            /**
             * Update the instance information
             */
            $this->setBaseName(pathinfo($new_name, PATHINFO_BASENAME));
            $this->setName(pathinfo($new_name, PATHINFO_FILENAME));
            $this->setExt(pathinfo($new_name, PATHINFO_EXTENSION));
            $this->setDirName(pathinfo($new_name, PATHINFO_DIRNAME));
            $this->path = "{$this->getDirName()}/{$this->getBaseName()}";

            return $this;
        }

        throw new CannotRenameFile('Cannot rename the file');
    }

    public function undo(){

    }

    public static function CREATE($path, $stream = null){
        $file = new File($path);

        return $file;
    }

    protected function CheckDirAndCreateItIfNotFound($dest_path){

        $dir_path = pathinfo($dest_path, PATHINFO_DIRNAME);

        if (!file_exists($dir_path)) {
            if (!mkdir($dir_path, 0777, true) && !is_dir($dir_path)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $dir_path));
            }
        }
    }

    /**
     * @return string|string[]
     */
    public function getDirName()
    {
        return $this->dir_name;
    }

    /**
     * @param string|string[] $dir_name
     */
    public function setDirName($dir_name): void
    {
        $this->dir_name = $dir_name;
    }

    /**
     * @return string
     */
    public function getBaseName(): string
    {
        return $this->base_name;
    }

    /**
     * @param string $base_name
     */
    public function setBaseName(string $base_name): void
    {
        $this->base_name = $base_name;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getExt(): string
    {
        return $this->ext;
    }

    /**
     * @param string $ext
     */
    public function setExt(string $ext): void
    {
        $this->ext = $ext;
    }

    /**
     * @return string
     */
    public function getMime(): string
    {
        return $this->mime;
    }

    /**
     * @param string $mime
     */
    public function setMime(string $mime): void
    {
        $this->mime = $mime;
    }

    /**
     * @return string
     */
    public function getSize(): string
    {
        return $this->size;
    }

    /**
     * @param string $size
     */
    public function setSize(string $size): void
    {
        $this->size = $size;
    }

}