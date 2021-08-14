<?php

namespace DataMigration\Abstracts;

use Illuminate\Support\Facades\DB;

abstract class DBTableTransfer
{
    protected $destinationTable;
    protected $query;

    public function run()
    {
        ini_set('max_execution_time', 300000);
        ini_set('memory_limit', '2560M');
        $this->beforeInsertCallback();
        $data = $this->retrieveData();
        $data = $this->processData($data);
        $dataSavedInd = $this->insertDataIntoDB($data);
        $this->afterInsertCallback();

        if ($dataSavedInd) {
            return "Data transferred to $this->destinationTable";
        }

        return "Data transfer failed!";
    }

    protected function retrieveData()
    {
        $data = DB::connection('mysql_old_db')
            ->select(DB::raw($this->query));

        return json_decode(json_encode($data), true);
    }

    protected function processData($data)
    {
        return $data;
    }

    protected function insertDataIntoDB($data)
    {
        foreach (array_chunk($data, 1500) as $chunkedData) {
            DB::table($this->destinationTable)->insert($chunkedData);
        }

        return true;
    }

    protected function afterInsertCallback()
    {
    }

    protected function beforeInsertCallback()
    {
    }
}
