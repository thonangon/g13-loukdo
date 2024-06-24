<?php

namespace App\Http\Controllers;

use App\Models\Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

// class MessagesController extends Controller
// {
//     /**
//      * Display a listing of the resource.
//      */
//     public function index()
//     {
//         //
//     }

//     /**
//      * Store a newly created resource in storage.
//      */
//     public function store(Request $request)
//     {
//         $sender_id = Auth()->id();
//         $message = new Messages();

//         $validatedData = Validator::make($request->all(),[
//             'receiver_id' => 'required|exists:users,id',
//             'text' => 'required|string',
//             'image' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
//         ]);

//         if ($validatedData->fails()){
//             return response()->json([
//                 'success'=> false,
//                 'message'=> $validatedData->errors(),
//                 'status'=>404
//             ]);
//         }

//         $img = $request->image;
//         $ext = $img->getClientOriginalExtension();
//         $imageName = time().'.'.$ext;
//         $img->move(public_path('/images/product/'), $imageName);

//         $message->sender_id = $sender_id;
//         $message->receiver_id =

        

//         return response()->json(['message' => 'Message sent successfully', 'data' => $message], 201);
//         $validatedData = Validator::make($request->all(),[
//             'product_id' => 'required|exists:products,id',
//             'comment' => 'required|string',
//             'image' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
//         ]);
//        //  return $request;
//         $comment = new CommentProduct();
        
//         if ($validatedData->fails()){
//             return response()->json([
//                 'success'=> false,
//                 'message'=> $validatedData->errors(),
//                 'status'=>404
//             ]);
//         }

//         $img = $request->image;
//         $ext = $img->getClientOriginalExtension();
//         $imageName = time().'.'.$ext;
//         $img->move(public_path('/images/product/'), $imageName);

//         $comment->product_id = $request->product_id;
//         $comment->user_id = $user_id;
//         $comment->comment = $request->comment;
//         $comment->image = $imageName;
//         $comment->save();
//     }

//     /**
//      * Display the specified resource.
//      */
//     public function show(Messages $messages)
//     {
//         //
//     }

//     /**
//      * Update the specified resource in storage.
//      */
//     public function update(Request $request, Messages $messages)
//     {
//         //
//     }

//     /**
//      * Remove the specified resource from storage.
//      */
//     public function destroy(Messages $messages)
//     {
//         //
//     }
// }
