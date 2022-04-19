<?php

namespace App\Repositories\Dashboard;

use App\Models\Product;
use App\Contracts\ProductContract;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\Dahboard\ProdctsCollection;

class ProductRepository extends BaseRepository implements ProductContract
{

    /**
     * ProductRepository constructor.
     * @param Product $model
     */
    public function __construct(Product $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }


        /**
     * fetch with datatable
     *
     * @return mixed
     */

    public function fetchDatatable()
    {


            $draw = request()->draw;
            $row = request()->start;
            $rowperpage = request()->length; // Rows display per page
            $columnIndex = isset(request()->order[0]['column']) ? request()->order[0]['column'] : 0; // Column index
            $columnName = isset(request()->columns[$columnIndex]['data']) ?request()->columns[$columnIndex]['data'] : 'id' ; // Column name
            $columnSortOrder = isset(request()->order[0]['dir']) ? request()->order[0]['dir'] : 'desc'; // asc or desc
            $search = isset(request()->search['value']) ? request()->search['value'] : null; // Search value

            $orderBy_translations = ['name', 'description'];

            $products =  Product::leftJoin('product_attributes', 'products.id', '=', 'product_attributes.product_id')
                ->selectRaw('products.*, IFNULL(SUM(product_attributes.qty),0) AS `quantity`')
                ->when($search, function ($query, $search) {

                    return $query

                        ->whereTranslationLike('name', '%' . $search . '%')
                        ->orWhere('products.sku', 'like', '%' . $search . '%')
                        ->orWhere('products.slug', 'like', '%' . $search . '%')
                        ->orWhereRaw("(CASE WHEN products.is_active = 1 THEN 'active' ELSE 'deactive' END) like '$search%'")
                        ->orWhereHas('categories', function ($query) use ($search) {
                            return $query->whereTranslationLike('name', '%' . $search . '%')
                                ->orWhere('slug', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('brand', function ($query) use ($search) {
                            return $query->whereTranslationLike('name', '%' . $search . '%')
                                ->orWhere('slug', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('tags', function ($query) use ($search) {
                            return $query->whereTranslationLike('name', '%' . $search . '%')
                                ->orWhere('slug', 'like', '%' . $search . '%');
                        })
                        // ->orWhere(function ($query) use($search){
                        //     $query->select(DB::raw('IFNULL(SUM(qty), 0) as quantity'))
                        //         ->from('product_attributes')
                        //         ->whereColumn('product_attributes.product_id', 'products.id')
                        //         ->limit(1)
                        //         ;
                        // }, $search)
                        ;
                })

                ->when(in_array($columnName, $orderBy_translations), function ($query) use ($columnName, $columnSortOrder) {
                    return $query->orderByTranslation($columnName, $columnSortOrder);
                }, function ($query) use ($columnName, $columnSortOrder) {
                    return $query->orderBy($columnName, $columnSortOrder);
                })


                ->groupBy('products.id');



            $totalRecords = Product::count();
            $totalRecordwithFilter = $products->get()->count();

            $data = $products->skip($row)
                ->limit($rowperpage)
                ->get();

            $data =  ProdctsCollection::collection($data)->response()->getData(true);
            $response = array(
                'row' => $row,
                "draw" => intval($draw),
                "iTotalDisplayRecords" => $totalRecordwithFilter,
                "iTotalRecords" => $totalRecords,
                "aaData" => $data['data']
            );


            return json_encode($response);


    }




    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listProducts(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findProductById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Product|mixed
     */
    public function createProduct(array $params)
    {

        $collection = collect($params);
        $vendor = ['vendor_id' => admin()->id];
        $is_active = $collection->has('is_active') ? true : false; //get active
        $translation_name = nameTranslations($collection->get('name'));

        $trans_content = [];
        foreach ($collection->get('description') as $key => $value) {
            if (in_array($key, supportedLanguages())) {
                $trans_content[$key] = ['description' => $value];
            }
        }

        $translation_description = $trans_content;
        $translations = array_merge_recursive($translation_name, $translation_description);

        foreach ($translations as $key => $value) {
            $collection =  $collection->merge([$key => $value]);
        }

        $collection = $collection->merge($vendor);
        $collection = $collection->merge(['is_active' =>  $is_active]);

        $product = new Product($collection->all());
        $product->save();

        $categories = $collection->get('categories');
        $product->categories()->attach($categories);


        if ($collection->has('tags')) {
            $product->tags()->attach($collection->get('tags'));
        }

        return $product;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateProduct(array $params, Model $product)
    {


        $collection = collect($params);
        $is_active = $collection->has('is_active') ? true : false; //get active
        $collection = $collection->merge(['is_active' =>  $is_active]);
        $translation_name = nameTranslations($collection->get('name'));

        $trans_content = [];
        foreach ($collection->get('description') as $key => $value) {
            if (in_array($key, supportedLanguages())) {
                $trans_content[$key] = ['description' => $value];
            }
        }

        $translation_description = $trans_content;
        $translations = array_merge_recursive($translation_name, $translation_description);

        foreach ($translations as $key => $value) {
            $collection =  $collection->merge([$key => $value]);
        }


        if ($collection->has('vendor_id')) {
            $collection->forget('vendor_id');
        }

        $product->update($collection->all());

        $categories = $collection->get('categories');
        $product->categories()->sync($categories);


        if ($collection->has('tags')) {
            $product->tags()->sync($collection->get('tags'));
        } else {
            $product->tags()->detach();
        }

        return $product;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteProduct($id)
    {
        $product = $this->findProductById($id);
        $product->images()->delete();
        File::deleteDirectory(public_path('images/products/' . $product->id));
        $product->delete();
        return $product;
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function findProductBySlug($slug)
    {
        $product = Product::where('slug', $slug)->first();

        return $product;
    }
}
