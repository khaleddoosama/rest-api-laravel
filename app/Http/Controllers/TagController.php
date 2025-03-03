<?php
namespace App\Http\Controllers;

use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit');
        $limit = ($limit > 50) ? 50 : $limit;
        $tag   = TagResource::collection(Tag::paginate($limit));
        return $tag->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tag = new TagResource(Tag::create($request->all()));
        return $tag->response()->setStatusCode(200, "The Tag updated Succeffully");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tag = new TagResource(Tag::findOrFail($id));
        return $tag->response()->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->authorize('update', Tag::class);

        $id = Tag::findOrFail($id);
        $this->authorize('update', $id);
        $tag = new TagResource(Tag::findOrFail($id));
        $tag->update($request->all());

        return $tag->response()->setStatusCode(200, "the Tag Updated Succeffully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $id = Tag::findOrFail($id);
        $this->authorize('delete', $id);
        Tag::findOrFail($id)->delete();
        return 204;
    }
}