<?php


namespace App\Services\Reports;


use App\Services\Handlers\ExportCsvHandler;
use App\Services\Reports\Helpers\ReportsCallsFormDataHelper;
use App\Services\Reports\Repositories\EloquentModRecordsRepository;
use App\Services\Reports\Repositories\EloquentModScenarioAliasesRepository;
use Illuminate\Support\Facades\Storage;

class ReportCallsService
{

    private ReportsCallsFormDataHelper $callsFormDataHelper;
    private EloquentModScenarioAliasesRepository $eloquentModScenarioAliasesRepository;
    private ExportCsvHandler $exportCsvHandler;

    public function __construct(
        EloquentModRecordsRepository $eloquentModRecordsRepository,
        EloquentModScenarioAliasesRepository $eloquentModScenarioAliasesRepository,
        ReportsCallsFormDataHelper $callsFormDataHelper,
        ExportCsvHandler $exportCsvHandler
    ) {
        $this->eloquentModRecordsRepository = $eloquentModRecordsRepository;
        $this->callsFormDataHelper = $callsFormDataHelper;
        $this->eloquentModScenarioAliasesRepository= $eloquentModScenarioAliasesRepository;
        $this->exportCsvHandler = $exportCsvHandler;
    }

    public function getReport(array $data)
    {
        $query = $this->eloquentModRecordsRepository->getRecords($data);
        $report_data = $this->callsFormDataHelper->handle($query);
        $this->exportCsvHandler->handle( Storage::disk('public')->url('reports') .'/Выгрузка ответов по проекту '. $data['project'] . '.csv',$report_data);
    }

}
