<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{
    Comment,
    LikeDislike,
    Post,
    User
};
use Illuminate\{
    Http\Request,
    Support\Facades\Auth,
    Http\RedirectResponse,
};

class LikeDislikeController extends Controller
{
    public function postLike($post_id, Request $request): RedirectResponse
    {
        $post = Post::find($post_id);
        if (!$post)
            return redirect()->back()->with('fail', 'Post does not exist');

        $is_like_duplicate = LikeDislike::where('user_id', Auth::id())->where('post_id', $post_id)->first();

        $data = [
            'user_id' => Auth::id(),
            'post_id' => $post_id,
            'type' => $request->input('type')
        ];
        if ($is_like_duplicate) {
            $current = (int)Post::where('id', $post_id)->first()->likes;
            $new = $current - 1;
            Post::where('id', $post_id)->update(array('likes' => $new));
            LikeDislike::where('post_id', $post_id)->where('user_id', Auth::id())->delete();
            $user_id = Post::where('id', $post_id)->first()->user_id;
            $currentUserRating = (int)User::where('id', $user_id)->first()->rating;
            $UpdatedUserRating = $currentUserRating - 1;
            User::where('id', $user_id)->update(array('rating' => $UpdatedUserRating));
            return redirect()->route('home')->with('success', 'Like deleted successfully!');
        }
        $current = (int)Post::where('id', $post_id)->first()->likes;
        $new = $current + 1;
        Post::where('id', $post_id)->update(array('likes' => $new));

        $user_id = Post::where('id', $post_id)->first()->user_id;
        $currentUserRating = (int)User::where('id', $user_id)->first()->rating;
        $UpdatedUserRating = $currentUserRating + 1;
        User::where('id', $user_id)->update(array('rating' => $UpdatedUserRating));
        LikeDislike::create($data);
        return redirect()->route('home')->with('success', 'Like created successfully!');
    }
        public function postDislike($post_id, Request $request): RedirectResponse
        {
            $data = [
                'user_id' => Auth::id(),
                'post_id' => $post_id,
                'type' => $request->input('type')
            ];
            $is_dislike_duplicate = LikeDislike::where('user_id', Auth::id())->where('post_id', $post_id)->first();

            if($is_dislike_duplicate){
                $current = Post::where('id', $post_id)->first()->dislikes;
                $new = $current + 1;
                Post::where('id', $post_id)->update(array('dislikes' => $new));
                LikeDislike::where('post_id', $post_id)->where('user_id', Auth::id())->delete();
                $user_id = Post::where('id', $post_id)->first()->user_id;
                $current_user_rating = (int)User::where('id', $user_id)->first()->rating;
                $updated_user_rating = $current_user_rating + 1;
                User::where('id', $user_id)->update(array('rating' => $updated_user_rating));
                return redirect()->route('home')->with('Dislike deleted successfully!');
            }
            $current = (int)Post::where('id', $post_id)->first()->dislikes;
            $new = $current + 1;
            Post::where('id', $post_id)->update(array('dislikes' => $new));

            $user_id = Post::where('id', $post_id)->first()->user_id;
            $current_user_rating = (int)User::where('id', $user_id)->first()->rating;
            $updated_user_rating = $current_user_rating - 1;
            User::where('id', $user_id)->update(array('rating' => $updated_user_rating));
            LikeDislike::create($data);
            return redirect()->route('home')->with('success', 'Dislike created successfully!');
        }

    public function commentLike($comment_id, Request $request): RedirectResponse
    {
        $comment = Comment::find($comment_id);
        if (!$comment)
            return redirect()->back()->with('fail', 'Comment does not exist');

        $is_like_duplicate = LikeDislike::where('user_id', Auth::id())->where('comment_id', $comment_id)->first();

        $data = [
            'user_id' => Auth::id(),
            'comment_id' => $comment_id,
            'type' => $request->input('type')
        ];
        if($is_like_duplicate) {
            $current = (int)Comment::where('id', $comment_id)->first()->likes;
            $new = $current - 1;
            Comment::where('id', $comment_id)->update(array('likes' => $new));
            LikeDislike::where('comment_id', $comment_id)->where('user_id', Auth::id())->delete();
            $user_id = Comment::where('id', $comment_id)->first()->user_id;
            $currentUserRating = (int)User::where('id', $user_id)->first()->rating;
            $UpdatedUserRating = $currentUserRating - 1;
            User::where('id', $user_id)->update(array('rating' => $UpdatedUserRating));
            return redirect()->route('home')->with('success', 'Like deleted successfully!');
        }
        $current = (int)Comment::where('id', $comment_id)->first()->likes;
        $new = $current + 1;
        Comment::where('id', $comment_id)->update(array('likes' => $new));

        $user_id = Comment::where('id', $comment_id)->first()->user_id;
        $currentUserRating = (int)User::where('id', $user_id)->first()->rating;
        $UpdatedUserRating = $currentUserRating + 1;
        User::where('id', $user_id)->update(array('rating' => $UpdatedUserRating));
        LikeDislike::create($data);
        return redirect()->route('home')->with('success', 'Like created successfully!');
    }
    public function commentDislike($comment_id, Request $request): RedirectResponse
    {
        $data = [
            'user_id' => Auth::id(),
            'comment_id' => $comment_id,
            'type' => $request->input('type')
        ];
        $is_dislike_duplicate = LikeDislike::where('user_id', Auth::id())->where('comment_id', $comment_id)->first();

        if($is_dislike_duplicate){
            $current = Comment::where('id', $comment_id)->first()->dislikes;
            $new = $current + 1;
            Comment::where('id', $comment_id)->update(array('dislikes' => $new));
            LikeDislike::where('comment_id', $comment_id)->where('user_id', Auth::id())->delete();
            $user_id = Comment::where('id', $comment_id)->first()->user_id;
            $current_user_rating = (int)User::where('id', $user_id)->first()->rating;
            $updated_user_rating = $current_user_rating + 1;
            User::where('id', $user_id)->update(array('rating' => $updated_user_rating));
            return redirect()->route('home')->with('Dislike deleted successfully!');
        }
        $current = Comment::where('id', $comment_id)->first()->dislikes;
        $new = $current - 1;
        Comment::where('id', $comment_id)->update(array('dislikes' => $new));

        $user_id = Comment::where('id', $comment_id)->first()->user_id;
        $current_user_rating = (int)User::where('id', $user_id)->first()->rating;
        $updated_user_rating = $current_user_rating - 1;
        User::where('id', $user_id)->update(array('rating' => $updated_user_rating));
        LikeDislike::create($data);
        return redirect()->route('home')->with('success', 'Dislike created successfully!');
    }

}
