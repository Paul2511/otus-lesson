<?php


namespace App\Services\Handlers;


class ExportCsvHandler
{
    public function handle($filename, $data): void
    {
        $handle = fopen($filename, 'w');
        fputs($handle, chr(0xEF) . chr(0xBB) . chr(0xBF)); // BOM
        $title = $data;

        fputcsv($handle, array_keys(array_shift($title)), ',');
        fseek($handle, -1, SEEK_CUR);
        fwrite($handle, "\r\n");

        collect($data)->map(function ($u) use ($handle){
            fputcsv($handle, $u, ',');
            fseek($handle, -1, SEEK_CUR);
            return fwrite($handle, "\r\n");
        })->chunk(5000);

        fclose($handle);
    }
}
