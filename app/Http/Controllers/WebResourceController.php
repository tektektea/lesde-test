<?php

namespace App\Http\Controllers;

use App\Models\WebResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class WebResourceController extends Controller
{
    public function privacy(Request $request)
    {
        $data = WebResource::query()->where('type', WebResource::PRIVACY)->first();
        return Inertia::render('Backend/Privacy/PrivacyPage', [
            'data' => $data
        ]);
    }
    public function term(Request $request)
    {
        $data = WebResource::query()->where('type', WebResource::TERM)->first();
        return Inertia::render('Backend/Term/TermPage', [
            'data' => $data
        ]);
    }

    public function edit(Request $request, string $type)
    {
        $data=WebResource::query()->where('type', $type)->first();
        return match ($type) {
            WebResource::TERM => \inertia('Backend/Term/TermEditPage',['data'=>$data]),
            WebResource::PRIVACY => \inertia('Backend/Privacy/PrivacyEditPage',['data'=>$data]),
            default => throw new \Exception('No view found'),
        };
    }
    public function update(Request $request, string $type)
    {
        $data=WebResource::query()
            ->where('type', $type)
            ->update([
                'content'=>$request->get('content')
            ]);
        Session::flash('success','Content updated successfully');
        return $type==WebResource::TERM? Redirect::route('term.read',['data'=>$data]):
            Redirect::route('privacy.read',['data'=>$data]);
    }
}
