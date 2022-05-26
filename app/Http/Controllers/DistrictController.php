<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class DistrictController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        return inertia('Backend/District/ListPage',[
            'list'=>District::query()
                ->when($search,fn($q)=>$q->where('name','LIKE',"%$search%")->orWhere('code',"LIKE","$search"))
                ->paginate($request->get('perPage') ?? 15)
        ]);
    }

    public function show(Request $request)
    {

    }
    public function create(Request $request)
    {

        return inertia('Backend/District/CreatePage',[
            'stateOptions' => State::query()->get(['id as value','name as label']),
        ]);
    }


    public function edit(Request $request,District $district)
    {
        $district->load('state');
        return inertia('Backend/District/EditPage',[
            'data'=>$district,
            'stateOptions'=>State::query()->get(['id as value','name as label'])
        ]);
    }

    public function store(Request $request)
    {
        $validatedData=$this->validate($request, [
            'name'=>'required',
            'state_id' => ['required',Rule::exists('states','id')],
            'code'=>'required|unique:districts',
            'description'=>'string'
        ]);
        $data=District::query()->create($validatedData);

        Session::flash('success', 'District created successfully');
        return Redirect::route('district.index');


    }

    public function update(Request $request,District $district)
    {
        $validatedData=$this->validate($request, [
            'name'=>'required',
            'state_id' => Rule::exists('states','id'),
            'code'=>['required',Rule::unique('districts')->ignore($district->id)],
            'description'=>'string'
        ]);

        $district->update($validatedData);
        Session::flash('success', 'District updated successfully');
        return Redirect::route('district.index');
    }

    public function destroy(Request $request, District $District)
    {
        $District->delete();
        Session::flash('success', 'District deleted successfully');
        return Redirect::route('district.index');
    }
}
