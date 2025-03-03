<?php
namespace App\Http\Controllers;

use App\Http\Resources\LessonResource;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limit  = $request->input('limit');
        $limit  = ($limit > 50) ? 50 : $limit;
        $lesson = LessonResource::collection(Lesson::paginate($limit));
        return $lesson->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $lesson = new LessonResource(Lesson::create($request->all()));
        return $lesson->response()->setStatusCode(200, "The Lesson updated Succeffully");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $lesson = new LessonResource(Lesson::findOrFail($id));
        return $lesson->response()->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $id = Lesson::findOrFail($id);
        $this->authorize('update', $id);
        $lesson = new LessonResource(Lesson::findOrFail($id));
        $lesson->update($request->all());

        return $lesson->response()->setStatusCode(200, "the Lesson Updated Succeffully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $id = Lesson::findOrFail($id);
        $this->authorize('delete', $id);
        Lesson::findOrFail($id)->delete();
        return 204;
    }
}