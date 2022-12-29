<?php

namespace App\DataTables;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use App\Models\Service;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ServiceDTDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
       return (new EloquentDataTable($query))
            ->addColumn('action', function($row) {
                if ($row->deleted_at == null) {
                    return "<div class='btn-group'><a href='". route('service.show', $row->s_id)."'>
                            <button class='btn btn-block btn-success'><i class='fa fa-eye'></i> Show</button></a>" .
                        "<a href='". route('service.edit', $row->s_id). "'><button class='btn btn-block btn-info'><i class='fa fa-eye'></i> Edit</button></a>
                        <form action='". route('service.destroy', $row->s_id). "' method=POST >". csrf_field() .
                                '<input name="_method" type="hidden" value="DELETE">
                                <button type="submit" class="btn btn-block btn-danger"><i class="fa fa-lock"></i> Deactivate</button>
                                  </form></div>';
                }else{
                    return "<div class='btn-group'><form action='". route('srestore', $row->s_id). "' method=POST >". csrf_field() .
                                '<input name="_method" type="hidden" value="GET">
                                <button type="submit" class="btn btn-block btn-warning"><i class="fa fa-unlock" aria-hidden="true"></i> Activate</button>
                                  </form></div>';
                }     
            })
            ->addColumn('simg', function ($service) {
                    $images = explode("|",$service->simg); 
                    $collection = collect($images);
                    return $collection->map(function($p) {
                         $url= url($p);
                        return '<img src="'.$url.'" border="0" width="90" height="90" align="center">';
                  })->implode('');
                })
            ->rawColumns(['simg','services','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Service $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Service $model): QueryBuilder
    {
        return $model->withTrashed();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('servicedt-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1);
                    // ->buttons(
                    //     Button::make('create'),
                    //     Button::make('export'),
                    //     Button::make('print'),
                    //     Button::make('reset'),
                    //     Button::make('reload')
                    // );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        return [
            Column::make('s_id'),
            Column::make('sname')->title('Service Name'),
            Column::make('cost')->title('Cost'),
            Column::make('simg')->title('Image'),
            Column::make('created_at')->title('created'),
            Column::make('updated_at')->title('updated'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'ServiceDT_' . date('YmdHis');
    }
}
