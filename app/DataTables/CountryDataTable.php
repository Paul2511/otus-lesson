<?php

namespace App\DataTables;

use App\Services\Countries\CountryService;
use App\Services\Routes\CMS\CMSRoutes;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CountryDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('data_show',function($row){
                return $row->data_show ? __('cms-country.data_show') : __('cms-country.data_hide') ;
            })
            ->addColumn('action', function($row){
                $rout_edit =CMSRoutes::CMS_COUNTRIES_EDIT;
                $rout_destroy =CMSRoutes::CMS_COUNTRIES_DELETE;
                return view('cms.buttons. datatable_buttons',compact('row','rout_edit','rout_destroy'));
            })
            ->rawColumns(['action']);
    }


    /**
     * @param CountryService $model
     * @return Builder
     */
    public function query(CountryService $model):Builder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('country-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1,'asc')
                    ->buttons(
                        Button::make('create'),
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [

            Column::make('id'),
            Column::make('country_code'),
            Column::make('country_name'),
            Column::make('data_show'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Country_' . date('YmdHis');
    }
}
