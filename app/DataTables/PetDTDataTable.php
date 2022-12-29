<?php

namespace App\DataTables;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use App\Models\Pet;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PetDTDataTable extends DataTable
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
                    return "<div class='btn-group'><a href='". route('pet.show', $row->p_id)."'>
                            <button class='btn btn-block btn-success'><i class='fa fa-eye'></i> Show</button></a>" .
                        "<a href='". route('pet.edit', $row->p_id). "'><button class='btn btn-block btn-info'><i class='fa fa-eye'></i> Edit</button></a>
                        <form action='". route('pet.destroy', $row->p_id). "' method=POST >". csrf_field() .
                                '<input name="_method" type="hidden" value="DELETE">
                                <button type="submit" class="btn btn-block btn-danger"><i class="fa fa-lock"></i> Deactivate</button>
                                  </form></div>';
                }else{
                    return "<div class='btn-group'><form action='". route('prestore', $row->p_id). "' method=POST >". csrf_field() .
                                '<input name="_method" type="hidden" value="GET">
                                <button type="submit" class="btn btn-block btn-warning"><i class="fa fa-unlock" aria-hidden="true"></i> Activate</button>
                                  </form></div>';
                }     
            })
            ->addColumn('customer', function (Pet $pets) {
                    return $pets->customer->fname." ".$pets->customer->lname;
                })
            ->addColumn('pimg', function ($pets) {
                    $url= url($pets->pimg);
                    return '<img src="'.$url.'" border="0" width="90" height="90" align="center">';
                })
            ->rawColumns(['pimg','pets','customer','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Pet $model): QueryBuilder
    {
        return $model->with(['customer'])->withTrashed();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('petdt-table')
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
            
            Column::make('p_id'),
            Column::make('pname')->title('Pet Name'),
            Column::make('ptype')->title('Type'),
            Column::make('page')->title('Age'),
            Column::make('pimg')->title('Image'),
            Column::make('customer')->name('customer.name')->title('Owner Name'),
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
        return 'PetDT_' . date('YmdHis');
    }
}
