<?php

namespace App\Services;

class BaseService
{
    /**
     * path of the file
     *
     * @var string
     */
    protected string $filePath;

    /**
     * columns for the csv
     *
     * @var array
     */
    protected array $columns;

    /**
     * Method __construct
     *
     * @param string $filePath path of the file
     * @param array $columns columns of csv file
     *
     * @return void
     */
    public function __construct($filePath, $columns)
    {
        $this->filePath = $filePath;
        $this->columns = $columns;
    }

    /**
     * Filter unknown column from the request.
     *
     * @param array $data data from request
     * @param array $column columns of csv file.
     *
     * @return array
     */
    protected function filterColumn($data, $column): array
    {
        $result = [];
        foreach ($column as $item) {
            $result[$item] = $data[$item];
        }
        return $result;
    }

    /**
     * function to make associative array
     *
     * @param array $data csv row
     * @param array $columns columns of csv file.
     *
     * @return array
     */
    function makeAssoc($data, $columns): array
    {
        $result = [];
        foreach ($data as $key => $item) {
            $result[$columns[$key]] = $item;
        }
        return $result;
    }

    /**
     * get list data
     *
     * @return array
     */
    public function list(): array
    {
        $result  = [];
        if (!file_exists($this->filePath)) {
            $file = fopen($this->filePath, "w");
        } else {
            $file = fopen($this->filePath, "r");
            if (request()->paginate == 1 || request()->page > 0) {
                $perPage = request()->per_page ?? 10;
                $page = request()->page ?? 1;
                $offset = ($perPage * $page) - $perPage;
                $count = 1;
                while ($row = fgetcsv($file)) {
                    if ($count > $offset && $count <= $perPage * $page) {
                        $result[] = $this->makeAssoc($row, $this->columns);
                    }
                    $count++;
                }
            }
            while ($row = fgetcsv($file)) {
                $result[] = $this->makeAssoc($row, $this->columns);
            }
        }
        fclose($file);
        return $result;
    }

    /**
     * store data
     *
     * @param string $mode mode to opent the file. eg: 'w', 'r'
     * @param array $data set of data to save
     *
     * @return array
     */
    public function store(array $data): array
    {
        $file = file_exists($this->filePath) ? fopen($this->filePath, "a") : fopen($this->filePath, "w");
        $count = count(file($this->filePath));
        $id = $count + 1;
        $data = array_merge(['id' => $id], $data, [
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $data = $this->filterColumn($data, $this->columns);
        fputcsv($file, $data);
        fclose($file);
        return $data;
    }
}
