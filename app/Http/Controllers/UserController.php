<?php
       
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UsersModel;
use Error;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('*');
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('status', function($row){
                         switch ($row->status) {
                            case '1':
                                return '<span class="badge badge-warning">cho xac thuc</span>';
                                break;
                            case '2':
                                return '<span class="badge badge-primary">Phe duyet</span>';
                                break;
                            case '3':
                                return '<span class="badge badge-secondary">Ngung hoat dong</span>';
                                break;
                            case '4':
                                return '<span id="a" class="badge badge-danger">Rut khoi hoi</span>';
                                break;
                            default:
                                # code...
                                break;
                         }
                    })
                    ->addColumn('id', function(User $user) {
                        return '<input type="checkbox" name="checkbox" value="'.$user->id.'"> ';
                    })
                    ->filter(function ($instance) use ($request) {
                        if ($request->get('status')) {
                            $instance->where('status', $request->get('status'));
                        }
                        if ($request->get('gender') == '0' || $request->get('gender') == '1'){
                            $instance->where('grender', $request->get('gender'));
                        }
                        if (!empty($request->get('search'))) {
                             $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                $w->orWhere('name', 'LIKE', "%$search%")
                                ->orWhere('number', 'LIKE', "%$search%");
                            });
                        }
                    })
                    ->rawColumns(['status','id'])
                    ->make(true);
                }
        return view('users'); 
    }
    public function delete(Request $request){
        $arr = $request->all();
        UsersModel::whereIn('id', $arr['arr'])->delete();
    }

    // Controller Update
    public function update(Request $req){
        $arr = $req->all();
        $newArr_id = [];
        foreach ($arr as  $key => $value) {
            if ($key === 'status') {
                $new_status = $value;
            }
            if ($key === 'arr') {
                foreach ($value as $value) {
                    array_push($newArr_id, $value);
                }
            }
        }
        try {
            if ($new_status == 0) {
                return "Vui long chon tranng thai";
            }else{
                if ($newArr_id) {
                    UsersModel::whereIn('id', $newArr_id)
                    ->update(['status' => $new_status]);
                    return 'Update complete.';
                } else {
                    return 'vui long chon ID';
                }
            }
        } catch (\Throwable $th) {
            return throw $th;
        }
        // $a =8;
        // if(isset($a) && $a<0){
        //     $a= 10;
        // }
        // // $a =
    }
}