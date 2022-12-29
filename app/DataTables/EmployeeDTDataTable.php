<?php

namespace App\DataTables;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use App\Models\User;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class EmployeeDTDataTable extends DataTable
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
                    return "<div class='btn-group'><a href='". route('employee.show', $row->id)."'>
                            <button class='btn btn-block btn-success'><i class='fa fa-eye'></i> Show</button></a>" .
                        "<a href='". route('employee.edit', $row->id). "'><button class='btn btn-block btn-info'><i class='fa fa-eye'></i> Edit</button></a>
                        <form action='". route('employee.destroy', $row->id). "' method=POST >". csrf_field() .
                                '<input name="_method" type="hidden" value="DELETE">
                                <button type="submit" class="btn btn-block btn-danger"><i class="fa fa-lock"></i> Deactivate</button>
                                  </form></div>';
                }else{
                    return '<div class="btn-group">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal'.$row->id.'">
                                  Assign Role
                                </button>
                            </div>
                    <div class="modal fade" id="exampleModal'.$row->id.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                      <div class="modal-dialog">
                      <form action="'. route('erestore', $row->id).'" method=POST >'.csrf_field().'<input name="_method" type="hidden" value="POST">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel" style="color:black;">Set Employee Role and Actication </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <div class="mb-3">
                              <label for="role" class="form-label" style="color:black;">Role</label>
                              <select class="form-select" name="role">
                                   <option value="vet">Veterinarian</option>
                                     <option value="groomer">Groomer</option>
                                </select>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save Role and Activate Account</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </form>
                    </div>';
                }     
            })
            ->addColumn('img', function ($user) {
                    $url= url($user->img);
                    return '<img src="'.$url.'" border="0" width="90" height="90" align="center">';
                })
            ->rawColumns(['img','user','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model): QueryBuilder
    {
        return $model->where('role','employee')->orwhere('role','vet')->orwhere('role','groomer')->withTrashed();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('employeedt-table')
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
            
            Column::make('id'),
            Column::make('fname')->title('First Name'),
            Column::make('lname')->title('Last Name'),
            Column::make('addr')->title('Address'),
            Column::make('img')->title('Image'),
            Column::make('role')->title('Role'),
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
        return 'EmployeeDT_' . date('YmdHis');
    }
}
