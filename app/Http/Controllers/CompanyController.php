<?php

namespace App\Http\Controllers;

use App\Company;
use App\Mail\NewCompanyEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class CompanyController extends Controller
{
    public function index(){
        return view('company.companies');
    }

    public function getList(){
        // laravel datatable plugin auto generate required response...
        $model = \App\Company::query();

        return DataTables::eloquent($model)
            ->filter(function ($query) {
                if (request()->has('search')) {
                   if(!empty(request('search')['value']))
                    $query->where('name', 'like', "%" . request('search')['value'] . "%");
                }
            })
            ->toJson();
    }

    public function create(){
        return view('company.create');
    }

    public function update($id){

        $user = Auth::user();
        // find company that belongs to user.
        $company = $user->company()->find($id);

        // company not found
        if (!$company) return redirect()->back()->with('status',__('Record is not found'));

        // we can reuse view of create functionality
        return view('company.create',[
            'company' => $company
        ]);
    }

    public function remove($id){

        $user = Auth::user();
        $company = $user->company()->find($id);

        // if user has company with $id, than we can delete it
        if($company &&
            $company->employees()->delete() &&
            $company->delete()){
            return redirect()
                ->back()
                ->with('status',__('company.removed', [ 'company' => $company->name ]));
        }
        // company not found or can not be deleted...
        return redirect()
            ->back()
            ->with('status', __('main.general-error'));
    }

    public function store(Request $request){
        // default laravel validation
        $this->validate($request,[
            'name' => 'required|string',
            'logo' => 'mimes:jpeg,gif,png|dimensions:min_width=100,min_height=100|max:2048', // min 100x100 & max 2Mb
        ]);

        // the case of editing the existing company
        if($request->has('company_id')){
            $company = Company::find($request->get('company_id'));
            if(!$company){
                return redirect()
                    ->back()
                    ->with('status',__('main.general-error'));
            }
        }else{ // create new company object
            $company = new Company;
        }

        $user = Auth::user();

        $company->user()->associate($user);
        $company->name = $request->get('name');

        // logo is optional
        if($request->hasFile('logo')){
            $company->logo = 'storage/' . $request->file('logo')->store('companies', 'public');
        }

        $company->phone = $request->get('phone');
        $company->fax = $request->get('fax');
        $company->address = $request->get('address');
        $company->email = $request->get('email');
        $company->website = $request->get('website');

        // go back with message
        if($company->save()){
            // if we are not updating, we creating
            // and sending email to user about that action
            // here is better to use queue job...
            if(!$request->has('company_id'))
                Mail::to($request->user())->send(new NewCompanyEntry($company));

            return redirect()
                ->back()
                ->with('status', $request->has('company_id') ?
                    __('company.updated', [ 'company' => $company->name ]):
                    __('company.created', [ 'company' => $company->name ]));
        } return redirect()
            ->back()
            ->with('status',__('main.general-error'));
    }
}
