<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;
use App\Models\CommentProduct;
use App\Models\replyComment;
use App\Models\Category;

class ProductDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\request  $request
     * @return array
     */
    public function toArray($request)
    {
        // Load owner details
        $owner = User::select('id', 'name', 'email')
                    ->where('id', $this->user_id)
                    ->first();

        // Load comments inline
        $comments = CommentProduct::select('id', 'user_id', 'comment', 'image', 'created_at')
                                  ->where('product_id', $this->id)
                                  ->get();

        // Load category inline
        $category = Category::select('id', 'category_name')
                            ->where('id', $this->category_id)
                            ->first();

        // load reply comments inline
        $reply = replyComment::select('id', 'comment_id', 'user_id','text')
        ->where('comment_id', $this->id)
        ->get();


        return [
            'data' => [
                'id' => $this->id,
                'name' => $this->name,
                'price' => $this->price,
                'description' => $this->description,
                'image' => $this->image,
                'category_id' => $this->category_id,
                'pro_owner' => $owner ? [
                    'id' => $owner->id,
                    'name' => $owner->name,
                    'email' => $owner->email,
                    'profile' => $owner->profile,
                ] : null,
                'category' => $category ? [
                    'id' => $category->id,
                    'category_name' => $category->category_name,
                ] : null,
                'comments' => $comments->map(function ($comment) {
                    return [
                        'id' => $comment->id,
                        'user_id' => $comment->user_id,
                        'comment' => $comment->comment,
                        'image' => $comment->image,
                        'created_at' => $comment->created_at,
                        'user' => User::select('id', 'name', 'email')
                                      ->where('id', $comment->user_id)
                                      ->first(),
                     'replies' => replyComment::where('comment_id', $comment->id)->get(),
                    ];
                }),
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'success' => true,
            'message' => 'get product details successfully'
        ];
    }
}

// {
//     "data": {
//         "id": 2,
//         "product_name": "Pink boys",
//         "price": "23.80",
//         "description": "Discond 24% for Khmer new yeare",
//         "category_id": 1,
//         "pro_owner": {
//             "id": 2,
//             "name": "User",
//             "email": "user@gmail.com",
//             "profile": null
//         },
//         "category": {
//             "id": 1,
//             "category_name": "Clothes"
//         },
//         "comments": [
//             {
//                 "id": 1,
//                 "user_id": 2,
//                 "comment": "this product is so good",
//                 "image": "1719581109.jpg",
//                 "created_at": "2024-06-28T13:25:09.000000Z",
//                 "user": {
//                     "id": 2,
//                     "name": "User",
//                     "email": "user@gmail.com",
//                     "profile": null
//                 }
//             }
//         ],
//         "created_at": "2024-06-28T08:48:14.000000Z",
//         "updated_at": "2024-06-28T08:48:14.000000Z"
//     },
//     "success": true,
//     "message": "get product details details successfully"
// }