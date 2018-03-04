<?php
/**
 * Created by PhpStorm.
 * User: lukas
 * Date: 29.09.16
 * Time: 23:22
 */

namespace App\_Classes;


use App\Models\Assignment;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use ZipArchive;

class UploadService
{

    private $storagePrefix = '/Users/lukas/Desktop/';

    /**
     * @param Assignment   $assignment
     * @param User         $user
     * @param UploadedFile $upload
     *
     * @return int number of stored bytes
     */
    public function storeUpload($assignment, $user, $upload)
    {
        $storagePath = $this->getStoragePath($assignment, $user);
        if (File::exists($storagePath)) {
            $this->moveToArchive($assignment, $user);
            $this->controlExistPath($this->getAssignmentPath($assignment));
            $this->controlExistPath($storagePath);

            return $this->storeFile($storagePath.'/'.$upload->getClientOriginalName(), $upload);
        } else {
            $this->controlExistPath($this->getAssignmentPath($assignment));
            $this->controlExistPath($storagePath);

            return $this->storeFile($storagePath.'/'.$upload->getClientOriginalName(), $upload);
        }
    }

    /**
     * @param Assignment $assignment
     * @param User       $user
     *
     * @return bool result of move
     */
    public function moveToArchive($assignment, $user)
    {
        $storagePath = $this->getStoragePath($assignment, $user);
        $archivePath = $this->getArchivePath($assignment, $user);

        $this->controlExistPath($this->getPureArchivePath());
        $this->controlExistPath($this->getAssignmentArchivePath($assignment));
        $this->controlExistPath($archivePath);

        return File::moveDirectory($storagePath, $archivePath.'/'.date('Y-m-d_H-i-s'));
    }

    /**
     * @param Assignment $assignment
     * @param User       $user
     *
     * @return String $path
     */
    private function getArchivePath($assignment, $user)
    {
        return $this->getAssignmentArchivePath($assignment).'/'.$user->id;
    }

    /**
     * @param Assignment $assignment
     * @param User       $user
     *
     * @return String $path
     */
    private function getStoragePath($assignment, $user)
    {
        return $this->getAssignmentPath($assignment).'/'.$user->id;
    }

    /**
     * @param Assignment $assignment
     *
     * @return String Assignemnt path
     */
    private function getAssignmentPath($assignment)
    {
        return $this->storagePrefix.$assignment->id;
    }

    /**
     * @param Assignment $assignment
     *
     * @return String Archive assignment path
     */
    private function getAssignmentArchivePath($assignment)
    {
        return $this->storagePrefix.'_archive/'.$assignment->id;
    }

    /**
     * @return String pure archive path
     */
    private function getPureArchivePath()
    {
        return $this->storagePrefix.'_archive';
    }

    /**
     * @param String $path
     */
    private function controlExistPath($path)
    {
        if (!File::exists($path))
            File::makeDirectory($path);
    }

    /**
     * @param String       $path
     * @param UploadedFile $file
     *
     * @return int stored bytes
     */
    private function storeFile($path, $file)
    {
        if ($file->extension() == 'zip') {
            $zip = new ZipArchive;
            if ($zip->open($file) === TRUE) {
                $zip->extractTo(str_replace($file->getClientOriginalName(), '', $path));
                $zip->close();

                return 1;
            }
        }

        return File::put($path, $file);
    }

}