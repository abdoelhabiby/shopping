<?php





/*
   sidebar item is active and open
*/

function isActive($module,$number = 2)
{

    return request()->segment($number) !== null && request()->segment($number) == $module ? 'active open' : '';
}


/*
   order number of rows page pagination count
*/

function orderNumberOfRows()
{
    $start = 0;
    $page = request()->page ? (int) request()->page : 0;

    if ($page && $page > 0) {

        $start = ($page * PAGINATE_COUNT) - PAGINATE_COUNT;
    }

    return $start;
}







function imageUpload($photo, $folder_save)
{

    $image = $photo->store("/", $folder_save);

    $path = "/images/" . $folder_save . "/" . $image;

    return $path;
}



function deleteFile($photo_to_delet)
{
    if (\Illuminate\Support\Facades\File::exists(public_path($photo_to_delet))) {

        \Illuminate\Support\Facades\File::delete(public_path($photo_to_delet));
    }
}


function user()
{

    return auth()->user() ?? false;
}

function admin()
{

    return auth('admin')->user() ?? false;
}



function pageNameReplaceespace($name)
{
    return trim(str_replace(' ', '-', $name));
}


//----------function return catch error---------------

function catchErro($route_name,$error_catch, $message = 'some errors happend pleas try again later')
{

    \Illuminate\Support\Facades\Log::alert($error_catch);

    return redirect()->route($route_name)->with(['error' => $message]);
}


//-----------------get supported languages---------------------


function  supportedLanguages(){
    return  Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLanguagesKeys();
}



