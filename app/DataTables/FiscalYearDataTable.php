<?php

namespace App\DataTables;

use App\Models\FiscalYear;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FiscalYearDataTable extends DataTable
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
            ->addColumn('action', function ($row) {
                return include('admin.section.buttons.button-edit');
                        include("admin.section.buttons.button-delete");
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\FiscalYearDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(FiscalYear $model)
    {
        return $model->newQuery()->select('id', 'fiscal_np');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        // return $this->builder()
        //             ->setTableId('fiscalyeardatatable-table')
        //             ->columns($this->getColumns())
        //             ->minifiedAjax()
        //             ->dom('Bfrtip')
        //             ->orderBy(1)
        //             ->buttons(
        //                 Button::make('create'),
        //                 Button::make('export'),
        //                 Button::make('print'),
        //                 Button::make('reset'),
        //                 Button::make('reload')
        //             );

        return $this->builder()
            ->setTableId('fiscalyear-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px'])
            ->parameters([
                'dom' => 'Bfrtip',
                'order' => [[0, 'desc']],
                'buttons' => ['copy', 'csv', 'excel', 'pdf', 'print'],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        // return [
        //     Column::computed('action')
        //           ->exportable(false)
        //           ->printable(false)
        //           ->width(60)
        //           ->addClass('text-center'),
        //     Column::make('id'),
        //     Column::make('add your columns'),
        //     Column::make('created_at'),
        //     Column::make('updated_at'),
        // ];

        return [
            'id',
            'fiscal_np',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'FiscalYear_' . date('YmdHis');
    }
}
