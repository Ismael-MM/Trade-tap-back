<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\MultimediaStoreRequest;
use App\Http\Requests\Api\v1\MultimediaUpdateRequest;
use App\Http\Resources\Api\v1\MultimediaCollection;
use App\Http\Resources\Api\v1\MultimediaResource;
use App\Models\Multimedia;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MultimediaController extends Controller
{
    public function index(Request $request): Response
    {
        $multimedia = Multimedia::all();

        return new MultimediaCollection($multimedia);
    }

    public function store(MultimediaStoreRequest $request): Response
    {
        $multimedia = Multimedia::create($request->validated());

        return new MultimediaResource($multimedia);
    }

    public function show(Request $request, Multimedia $multimedia): Response
    {
        return new MultimediaResource($multimedia);
    }

    public function update(MultimediaUpdateRequest $request, Multimedia $multimedia): Response
    {
        $multimedia->update($request->validated());

        return new MultimediaResource($multimedia);
    }

    public function destroy(Request $request, Multimedia $multimedia): Response
    {
        $multimedia->delete();

        return response()->noContent();
    }
}
