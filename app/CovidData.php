<?php

namespace App;

use League\Csv\Reader;

class CovidData
{
    public Reader $csvReader;

    public function __construct(string $path)
    {
        $this->path = $path;
        $this->csvReader = Reader::createFromPath($path, 'r');
        $this->csvReader->setHeaderOffset(0);
        $this->csvReader->setDelimiter(";");
    }

    public function getRecords(): \League\Csv\TabularDataReader
    {
        return \League\Csv\Statement::create()->process($this->csvReader);
    }

    public function searchRecords(string $name)
    {
        $searchedRecords = [];
        foreach ($this->getRecords() as $record)
        {
            if ($record['Valsts'] === $name)
            {
                $searchedRecords[] = $record;
            }
        } return $searchedRecords;
    }
}