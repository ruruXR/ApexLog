<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterController extends Controller
{
    public function tweet(Request $request)
    {
        $twitter = new TwitterOAuth(
            env('TWITTER_CLIENT_ID'),
            env('TWITTER_CLIENT_SECRET'),
            env('TWITTER_CLIENT_ID_ACCESS_TOKEN'),
            env('TWITTER_CLIENT_ID_ACCESS_TOKEN_SECRET')
            );

        $twitter->post("statuses/update", [
            "status" =>
                'タイトル「' . $title . '」' . PHP_EOL .
                'https://www.holy-place-photo.com/photos/' . $id
        ]);
    }
}
