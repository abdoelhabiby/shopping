<?php

namespace App\DataTables;

use App\Models\Product;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
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
            ->addColumn('action', 'dashboard.products.button.index');
           // ->addColumn('image', 'dashboard.products.button.image');

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
    {
        return $model->with(['categories'])->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {




        return $this->builder()
            ->setTableId('product-table')
            ->columns($this->getColumns())
            ->dom('Bfrtip')
            ->orderBy(1)
            ->parameters([
                'lengthMenu' => [
                    [10, 25, 50, -1],
                    ['10 rows', '25 rows', '50 rows', 'Show all']
                ],
                'dom' => 'Bfrtip',
                'buttons' => ['csv', 'excel', 'pdf', 'print', 'reset', 'reload', 'pageLength'],
                "language" => [


                     "url" => localeLanguage() == 'ar' ? asset("data_table_arabic.json") : '',

                    // "buttons" => [
                    //     "print" =>  "طباعه",
                    //     "copy" =>  "نسخ",
                    //     "pdf" =>  " PDF",
                    //     "excel" =>  "اكسيل",
                    //     "csv" =>  "csv",
                    //     'reset' => 'إعادة تعيين',
                    //     "export" => "استخراج",
                    //     "create" => "اضافه",
                    //     "reload" => "اعاده تحميل ",
                    //     "collection" => 'test',
                    // ]

                ]

            ]);
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
            Column::make('slug'),
            Column::make('name')->title('name')->orderable(false)->searchable(false),
            Column::make('is_active')->title('active'),
           // Column::make('category.slug')->title('category'),
            Column::make('created_at')->title('created at'),
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
        return 'Product_' . date('YmdHis');
    }
}
