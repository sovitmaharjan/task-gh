<?php

namespace App\Services;

class ClientService
{
    protected static $columns = ["id", "name", "gender", "phone", "email", "address", "nationality", "dob", "contact_mode", "created_at", "updated_at"];

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
        $result  = [];
        if (!file_exists($filePath)) {
            $file = fopen($filePath, WRITE);
        } else {
            $file = fopen($filePath, $mode);
            while ($row = fgetcsv($file)) {
                $result[] = makeAssoc($row, static::$columns);
            }
        }
        fclose($file);
        return $result;
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
        $file = file_exists($filePath) ? fopen($filePath, $mode) : fopen($filePath, WRITE);
        $count = count(file($filePath));
        $id = $count + 1;
        array_unshift($data, $id); // added id for each row
        $data['created_at'] = now();
        $data['updated_at'] = now();
        // dd(
        //     $count,
        //     file($filePath)
        //     // array_map('str_getcsv', file($filePath, FILE_IGNORE_NEW_LINES))
        //     // array_map('str_getcsv', $file)
        // );
        fputcsv($file, $data);
        fclose($file);
        return $data;
    }
}
