<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Rate;
use App\Models\Comment;
use App\Http\Requests\BlogCommentRequest;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list()
    {
        $blog=Blog::orderBy('created_at', 'DESC')->paginate(3);
        return view ('frontend.blog.blog-list', compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function detail($id)
    {
        $blog = Blog::findorFail($id);
        $getcomment = Comment::where('id_blog',$id)
                     ->orderBy('id','desc')
                     ->get();

        $avgRate = Rate::where('id_blog', $id)->avg('rate');
        $avgRate = round($avgRate);

        $totalVote = Rate::where('id_blog', $id)->count();

        $next = Blog::where('id', '>', $id)->orderBy('id')->first();
        $previous = Blog::where('id', '<', $id)->orderBy('id', 'desc')->first();

        return view('frontend.blog.blog-detail', compact('blog', 'avgRate', 'totalVote',  'getcomment', 'next', 'previous'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function rate(Request $request){

        if(!Auth::check()){
            return response()->json(['error' => 'Vui lòng đăng nhập để đánh giá.']);
        }
        // dd($request->all());

        $data = $request->all();
        $rating = $data['rate'];
        $blogId = $data['id_blog'];
        $userId = Auth::id();
        
        $checkrate = Rate::where('id_blog', $blogId)->where('id_user', $userId)->first();

        if($checkrate){
            $checkrate->update(['rate' => $rating]);

        } else{
            Rate::create([
                'id_blog' => $blogId,
                'id_user' => $userId,
                'rate' => $rating,
            ]);
        }    

        return response()->json(['success' => 'Đánh giá thành công.']);
    }

    public function comment(BlogCommentRequest $request)
    {
        if(!Auth::check()){
            return response()->json(['error' => 'Vui lòng đăng nhập để bình luận.']);
        }

        $data = $request->all();
        //dd($data);

        $data['id_user'] = Auth::id();
        $data['name_user'] = Auth::user()->name;
        $data['avatar_user'] = Auth::user()->avatar;

        $comment = Comment::create($data);
        if ($comment) {
            return response()->json([
                'success' => 'Bình luận thành công.',
                'id' => $comment->id,
                'comment' => $comment->comment,
                'name_user' => $comment->name_user,
                'avatar_user' => $comment->avatar_user,
                'time' => $comment->created_at->format('Y-m-d H:i:s'),
            ]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
