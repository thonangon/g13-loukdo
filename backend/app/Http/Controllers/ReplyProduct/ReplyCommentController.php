<?php

namespace App\Http\Controllers\ReplyProduct;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;

use App\Models\replyComment;
use App\Models\replyComment as ModelsReplyComment;

class ReplyCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reply = replyComment::all();
        return response()->json(['data' => $reply, 'message' => 'Reply comment is successfully']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user_id = $request->user_id;
        $category_id = $request->category_id;
        $text = $request->text;

        $reply = new ModelsReplyComment();

        $reply->user_id = $user_id;
        $reply->category_id = $category_id;
        $reply->text = $text;
        try{
            $reply->save();
            return response()->json(['data' => $reply, 'message' => 'Reply comment is successfully']);
        }catch(Exception $e){
            return response()->json(['data' => $e, 'message' => 'Reply comment is not successfully']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
