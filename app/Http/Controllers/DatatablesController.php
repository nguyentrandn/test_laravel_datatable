<?php

namespace App\Http\Controllers;

use App\Models\User;
use Yajra\Datatables\Datatables;

class DatatablesController extends Controller
{
    //
    public function getIndex()
    {
        return view('datatables.index');
    }
    public function anyData()
    {
        return Datatables::of(User::query())->make(true);
    }
}
