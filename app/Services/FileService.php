<?php

namespace App\Services;

class FileService
{
    /**
     * Opens file.
     *
     * @param string $filePath path of the file
     * @param string $mode mode to opent the file. eg: 'w', 'r'
     *
     * @return mixed
     */
    public static function fOpen(string $filePath, string $mode): mixed
    {
        return fopen($filePath, $mode);
    }

    /**
     * Closes file
     *
     * @param resource $stream file to close
     *
     * @return void
     */
    public static function fCLose($stream): void
    {
        fclose($stream);
    }
    
    /**
     * get list data
     *
     * @param string $filePath path of the file
     * @param string $mode mode to opent the file. eg: 'w', 'r'
     *
     * @return array
     */
    public function list(string $filePath, string $mode): array
    {
        $data  = [];
        if (!file_exists($filePath)) {
            $file = static::fOpen($filePath, WRITE);
        } else {
            $file = static::fOpen($filePath, $mode);
            while ($row = fgetcsv($file)) {
                $data[] = $row;
            }
        }
        static::fCLose($file);
        return $data;
    }
    
    /**
     * store data
     *
     * @param string $filePath path of the file
     * @param string $mode mode to opent the file. eg: 'w', 'r'
     * @param array $data set of data to save
     *
     * @return array
     */
    public function store(string $filePath, string $mode, array $data): array
    {
        $file = file_exists($filePath) ? static::fOpen($filePath, $mode) : static::fOpen($filePath, WRITE);
        fputcsv($file, $data);
        static::fCLose($file);
        return $data;
    }
}
