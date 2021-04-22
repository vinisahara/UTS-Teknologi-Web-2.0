<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\D111811023_news;
use Illuminate\Support\Facades\Validator;

class D111811023_newsController extends Controller
{
    public function index(){
        $news = D111811023_news::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'List Data News',
            'data' => $news
        ], 200);
    }

    public function show($id){
        $new = D111811023_news::findOrfail($id);

        return response()->json([
            'success' => true,
            'message' => 'Detail Data News',
            'data' => $new
        ], 200);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'img_url' => 'required',
            'sub_desc' => 'required',
            'desc' => 'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $new = D111811023_news::create([
            'title' => $request->title,
            'img_url' => $request->img_url,
            'sub_desc' => $request->sub_desc,
            'desc' => $request->desc
        ]);

        if ($new) {
            return response()->json([
                'success' => true,
                'message' => 'News Created',
                'data' => $new
            ], 201);
        }
    }
    
    public function update(Request $request, D111811023_news $new){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'img_url' => 'required',
            'sub_desc' => 'required',
            'desc' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $new = D111811023_news::findOrFail($new->id);
        if ($new) {
            $new->update([
                'title' => $request->title,
                'img_url' => $request->img_url,
                'sub_desc' => $request->sub_desc,
                'desc' => $request->desc
            ]);
            return response()->json([
                'success' => true,
                'message' => 'News Updated',
                'data' => $new
            ], 200);
        }
    }

    public function destroy($id){
        $new = D111811023_news::findOrfail($id);

        if ($new) {
            $new->delete();

            return response()->json([
                'success' => true,
                'message' => 'News Deleted',
            ], 200);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'News Not Found',
        ], 404);
    }
}
