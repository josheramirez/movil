<?php

namespace App\Http\Controllers;

use App\Notifications\PostNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\User;


class PostController extends Controller
{
    public function index()
    {
        $post=factory(Post::class, 1)->create();
        // dd($post->first());
        // Auth::user()->notify(new PostNotification($post->first()));

        User::all()
            ->except($post->first()->user_id)
            ->each(function(User $user) use($post){
                $user->notify(new PostNotification($post->first()));
            });
        // $fromUser = User::find(2);
        // $toUser = User::find(1);

        // // send notification using the "user" model, when the user receives new message
        // $toUser->notify(new NewMessage($fromUser));

        // // send notification using the "Notification" facade
        // Notification::send($toUser, new NewMessage($fromUser));
        return redirect()->back()->with('status','notificacion enviada');
    }
}
