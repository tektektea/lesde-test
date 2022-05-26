<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        return Inertia::render('Backend/Faq/ListPage',[
            'list' => Faq::query()
                ->when($search, fn($q) => $q->where('question', 'LIKE', "$search%"))

                ->paginate($request->get('perPage',15)),
        ]);
    }

    public function store(Request $request)
    {
        $validatedData=$this->validate($request, [
            'question'=>'required',
            'answer'=>'required',
            'published'=>'required|boolean'
        ]);
        $data=Faq::query()->create($validatedData);

        Session::flash('success', 'Faq created successfully');
        return Redirect::to(route('faq.index'));
    }

    public function create(Request $request)
    {
        return Inertia::render('Backend/Faq/CreatePage');
    }

    public function show(Request $request)
    {

    }

    public function update(Request $request, Faq $faq)
    {
        $validatedData=$this->validate($request, [
            'question'=>'required',
            'answer'=>'required',
            'published'=>'required',
        ]);
        $faq->update($validatedData);
        Session::flash('success', 'Faq updated successfully');
        return Redirect::to(route('faq.index'));


    }

    public function togglePublish(Request $request, Faq $faq)
    {
        $faq->published = !(boolean)$faq->published;
        $faq->save();
        Session::flash('success', 'Faq published successfully');
        return back();
    }
    public function edit(Request $request, Faq $faq)
    {
        return Inertia::render('Backend/Faq/EditPage', ['data'=>$faq]);
    }

    public function destroy(Request $request, Faq $faq)
    {
        $faq->delete();
        Session::flash('success', 'Faq deleted successfully');
        return Redirect::route('faq.index');
    }
}

