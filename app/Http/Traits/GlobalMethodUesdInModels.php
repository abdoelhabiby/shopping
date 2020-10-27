<?php


namespace App\Http\Traits;


trait GlobalMethodUesdInModels
{
    //------------------------return attibute is active prety-------------
    public function getIsActiveAttribute($p)
    {
        return $p == true ? 'active' : 'deactive';
    }




}
