<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use App\Http\Requests\UrlRequest;
use Symfony\Component\HttpFoundation\Response;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return auth()->user()->urls()->paginate(4);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UrlRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UrlRequest $request)
    {
        $url = auth()->user()->urls()->create($request->all());
        return response($url, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function show(Url $url)
    {
        $url->increment('visits');
        return redirect($url->original_url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function destroy(Url $url)
    {
        $url->delete();
        return response('', Response::HTTP_NO_CONTENT);
    }
}
