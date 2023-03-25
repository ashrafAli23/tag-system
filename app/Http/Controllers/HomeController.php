<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function search(Request $request, $text): JsonResponse
    {
        $posts = Posts::where('title', 'like', '%' . $text . '%')->paginate(10);


        $postTags = Posts::whereHas('tags', function ($query) use ($text) {
            return $query->where('tag_name', $text);
        })->paginate(10);



        $postCat = Posts::whereHas('category', function ($query) use ($text) {
            return $query->where('name', $text);
        })->paginate(10);


        $result = collect(
            array_merge($posts->items(), $postTags->items(), $postCat->items())
        )->unique();

        $total_result = count($result);

        return response()->json([
            'total_result' => $total_result,
            'result' => $result
        ], 200);
    }
}
