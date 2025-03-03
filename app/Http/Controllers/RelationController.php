<?php
namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Tag;
use App\Models\User;

class RelationController extends Controller
{

    public function LessonTags($id)
    {

        $lessons  = Tag::findOrFail($id)->lessons;
        $fields   = [];
        $filtered = [];
        foreach ($lessons as $lesson) {

            $fields['Title'] = $lesson->title;
            $fields['Body']  = $lesson->body;
            $filtered[]      = $fields;
        }

        return response()->json([
            'data' => $filtered,
        ], 200);
    }
    public function TagLessons($id)
    {
        $tags = Lesson::findOrFail($id)->tags;

        $fields   = [];
        $filtered = [];
        foreach ($tags as $tag) {

            $fields['Name'] = $tag->name;

            $filtered[] = $fields;
        }

        return response()->json([
            'data' => $filtered,
        ], 200);
    }
    public function UserLessons($id)
    {
        $lessons = User::findOrFail($id)->lessons;

        $fields   = [];
        $filtered = [];
        foreach ($lessons as $lesson) {

            $fields['Title'] = $lesson->title;
            $fields['Body']  = $lesson->body;
            $filtered[]      = $fields;
        }

        return response()->json([
            'data' => $filtered,
        ], 200);

    }

}