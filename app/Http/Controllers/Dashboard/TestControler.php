<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class TestControler extends Controller
{


    public function test()
    {



        return admin()->roles()->pluck('name');

    } //end of method test





} //end of class
