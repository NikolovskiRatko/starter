<?php

namespace App\Util\DataExport;

use Illuminate\Support\Collection;

interface DataExportServiceInterface
{
    /**
     * @param Collection $data
     * @param string $filename
     * @param string $delimiter
     * @return mixed
     */
    public function array_to_csv_download($data, $filename, $delimiter);
}
