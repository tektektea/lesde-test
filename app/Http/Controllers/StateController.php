<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class StateController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        return inertia('Backend/State/ListPage',[
            'list'=>State::query()
                ->when($search,fn($q)=>$q->where('name','LIKE',"%$search%")->orWhere('code',"LIKE","$search"))
                ->paginate($request->get('perPage') ?? 15)
        ]);
    }

    public function show(Request $request)
    {

    }
    public function create(Request $request)
    {
        return inertia('Backend/State/CreatePage');
    }


    public function edit(Request $request,State $state)
    {
        return inertia('Backend/State/EditPage',[
            'data'=>$state
        ]);
    }

    public function store(Request $request)
    {
        $validatedData=$this->validate($request, [
            'name'=>'required',
            'code'=>'required|unique:states',
            'description'=>'string'
        ]);
        $data=State::query()->create($validatedData);

        Session::flash('success', 'State created successfully');
        return Redirect::route('state.index');


    }

    public function update(Request $request,State $state)
    {
        $validatedData=$this->validate($request, [
            'name'=>'required',
            'code'=>['required',Rule::unique('states')->ignore($state->id)],
            'description'=>'string'
        ]);

        $state->update($validatedData);
        Session::flash('success', 'State updated successfully');
        return Redirect::route('state.index');
    }

    public function destroy(Request $request, State $state)
    {
        $state->delete();
        Session::flash('success', 'State deleted successfully');
        return Redirect::route('state.index');
    }
}
