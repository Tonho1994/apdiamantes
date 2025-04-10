<?php

namespace App\DataTables\Logs;

use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AuditLogsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param  mixed  $query  Results from query() method.
     *
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->rawColumns(['description', 'properties', 'action'])
            ->editColumn('id', function (Activity $model) {
                return $model->id;
            })
            ->editColumn('subject_id', function (Activity $model) {
                if (!isset($model->subject)) {
                    return '';
                }

                if (isset($model->subject->name)) {
                    return $model->subject->name;
                }

                return $model->subject->user()->first()->name;
            })
            ->editColumn('causer_id', function (Activity $model) {
                return $model->causer ? $model->causer->first_name : __('System');
            })
            ->editColumn('properties', function (Activity $model) {
                $content = $model->properties;

                return view('pages.log.audit._details', compact('content'));
            })
            ->editColumn('created_at', function (Activity $model) {
                return $model->created_at->format('Y-m-d H:i:s');
            })
            ->addColumn('action', function (Activity $model) {
                return view('pages.log.audit._action-menu', compact('model'));
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param  Activity  $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Activity $model)
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
            ->setTableId('audit-log-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->stateSave(true)
            ->orderBy(6)
            ->responsive()
            ->autoWidth(false)
            ->parameters([
                'scrollX' => true,
                'language' => [
                    'url' => url('lang/datatables/' . app()->getLocale() . '.json'),
                ],
                'drawCallback' => 'function() { KTMenu.createInstances(); }',
            ])
            ->addTableClass('align-middle table-row-dashed fs-6 gy-5');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id')->title('Log ID')->addClass('ps-0'),
            Column::make('log_name')->title(__('Location')),
            Column::make('description')->title(__('Description')),
            Column::make('subject_type')->title(__('Type')),
            Column::make('subject_id')->title(__('Subject')),
            Column::make('causer_id')->title(__('Causer')),
            Column::make('created_at')->title(__('Created at')),
            Column::computed('action')
                ->title(__('Actions'))
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center')
                ->responsivePriority(-1),
            Column::make('properties')->addClass('none'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'DataLogs_'.date('YmdHis');
    }
}
