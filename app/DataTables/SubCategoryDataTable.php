<?php

namespace App\DataTables;

use App\Models\Category;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SubCategoryDataTable extends DataTable
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
            ->addColumn('action', 'dashboard.sub_categories.button.index');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Category $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Category $model)
    {
        $locale = \Config::get('app.locale');
        $fallback_locale = \Config::get('translatable.fallback_locale');

        return $model->whereHas('translation_default')->subCategory()->with(['parent.translation_default' => function($q) use ($locale,$fallback_locale){
            return $q->where('locale',$locale)->orWhere('locale',$fallback_locale)->get();
        },'translation_default'])->newQuery();
    }




    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('sub-category-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
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

                   // "url" => asset("data_table_arabic.json"),

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
            Column::make('translation_default.name')->title('name')->orderable(false),
            Column::make('parent.translation_default.name')->title('parent')->orderable(false),


            Column::make('is_active')->title('active'),
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
        return 'MainCategory_' . date('YmdHis');
    }
}
