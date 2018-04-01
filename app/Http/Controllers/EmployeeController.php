<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{

    public function index(){
        return view('employee.employees');
    }

    public function create(){
        return view('employee.create',[
            'companies' => \App\Company::all()
        ]);
    }

    public function update($id){
        // reuse view of store action
        return view('employee.create',[
            'employee' => \App\Employee::find($id),
            'companies' => \App\Company::all()
        ]);
    }

    public function remove($id){
        $user = Auth::user();
        $employee = Employee::find($id);

        if($employee &&
            $user->company()->where('id',$employee->company_id)->first() &&
            $employee->delete()){
            return redirect()
                ->back()
                ->with('status',__('employee.removed', [ 'name' => $employee->full_name ]));
        }

        return redirect()
            ->back()
            ->with('status', __('main.general-error'));
    }

    public function store(Request $request){

        $this->validate($request,[
            'first_name' => 'string',
            'last_name' => 'string',
            'company_id' => 'exists:companies,id'
        ]);

        $user = Auth::user();
        $data = $request->all();
        unset($data['_token']);

        if($request->has('employee_id')){
            $employee = \App\Employee::find($request->get('employee_id'));
            if($employee && $employee->company->user_id == $user->id){
                $employee->first_name = $data['first_name'];
                $employee->last_name = $data['last_name'];
                $employee->email = $data['email'];
                $employee->phone = $data['phone'];
                if(!$employee->save())
                    $employee = null;
            }
        }else {
            $employee = \App\Employee::create($data);
        }

        if($employee){
            return redirect()
                ->back()
                ->with('status', !$request->has('employee_id') ? __('employee.created-successfully', [
                    'name' => $employee->full_name,
                ]) : __('employee.updated-successfully', [ 'name' => $employee->full_name ]));
        } return redirect()
            ->back()
            ->with('status',__('main.general-error'));
    }

    public function getList(){
        $model = \App\Employee::query();

        return DataTables::eloquent($model)
            ->filter(function ($query) {
                if (request()->has('search')) {
                    if(!empty(request('search')['value']))
                        $query->where('first_name', 'like', "%" . request('search')['value'] . "%");
                }
            })
            ->toJson();
    }
}
