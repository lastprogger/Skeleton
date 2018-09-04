<?php
/**
 * Created by PhpStorm.
 * User: neduck
 * Date: 17/08/2018
 * Time: 12:38
 */

namespace App\Extensions\CloudFileStorageClient;

use BelkaCar\PhpLibFilestorage\Dto\FileDto;
use Illuminate\Http\UploadedFile;
use BelkaCar\PhpLibFilestorage\StorageClient;

class FileStorageClient
{
    private const STORAGE_TYPE_CDN = 'cdn';

    /**
     * @var StorageClient
     */
    private $fileStorageClient;

    /**
     * FileStorageService constructor.
     *
     * @param StorageClient $fileStorageClient
     */
    public function __construct(StorageClient $fileStorageClient)
    {
        $this->fileStorageClient = $fileStorageClient;
    }

    /**
     * @param string       $filename
     * @param string       $filePath
     * @param UploadedFile $file
     * @param int          $ownerId
     *
     * @return FileDto
     * @throws \Throwable
     */
    public function uploadFile(
        string $filename,
        string $filePath,
        UploadedFile $file,
        int $ownerId
    ): FileDto {
        $path = sys_get_temp_dir() . '/' . $filename;
        copy($file->getRealPath(), $path);

        try {
            $fileDto = $this->fileStorageClient->uploadFile(
                $filename,
                $filePath,
                self::STORAGE_TYPE_CDN,
                fopen($path, 'rb'),
                $ownerId
            );
        } catch (\Throwable $exception) {
            throw $exception;
        } finally {
            unlink($path);
        }

        return $fileDto;
    }

    /**
     * @return StorageClient
     */
    public function getFileStorageClient(): StorageClient
    {
        return $this->fileStorageClient;
    }
}
