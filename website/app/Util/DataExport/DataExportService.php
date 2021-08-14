<?php

namespace App\Util\DataExport;

class DataExportService implements DataExportServiceInterface
{
    public function ccccc($aaaaa)
    {
        die(dump('ExportService'));
    }

    public function array_to_csv_download($data, $filename = "export.csv", $delimiter=";") {
        // Convert Collection to Array
        $data = $data->toArray();
        // Get column names
        foreach ($data as &$item)
            $item = (array) $item;
        $header = array_keys($data[0]);
        // open raw memory as file so no temp files needed, you might run out of memory though
        $f = fopen('php://memory', 'w');
        //set first line
        fputcsv($f, $header, $delimiter);
        // loop over the input array
        foreach ($data as $line) {
            // generate csv lines from the inner arrays
            fputcsv($f, $line, $delimiter);
        }
        // reset the file pointer to the start of the file
        fseek($f, 0);
        // tell the browser it's going to be a csv file
        header('Content-Type: application/csv');
        // tell the browser we want to save it instead of displaying it
        header('Content-Disposition: attachment; filename="'.$filename.'";');
        // make php send the generated csv lines to the browser
        fpassthru($f);
        exit;
    }
}
