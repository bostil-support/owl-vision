<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{

    /**
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $tagsQuery = Tag::query();

        if ($request->has('search')) {
            $tagsQuery->where('title', 'like', "%" . $request->search . "%");
        }

        if ($request->page === '-1') {
            $tags = $tagsQuery->get();
        } else {
            $tags = $tagsQuery->paginate();
        }

        return TagResource::collection($tags);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function store(Request $request)
    {
        $request->validate(['title' => 'required|string|max:255']);
        $tag = Tag::query()->create($request->validated());

        return (new TagResource($tag))->response()->setStatusCode(201);
    }

    /**
     * @param $id
     *
     * @return \App\Http\Resources\TagResource
     */
    public function show($id)
    {
        $tag = Tag::query()->findOrFail($id);

        return new TagResource($tag);
    }
}
