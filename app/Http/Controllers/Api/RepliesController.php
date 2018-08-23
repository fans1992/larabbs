<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\ReplyRequest;
use App\Models\Reply;
use App\Models\Topic;
use App\Transformers\ReplyTransformer;
use Illuminate\Http\Request;

class RepliesController extends Controller
{
    public function store(Topic $topic, ReplyRequest $request, Reply $reply)
    {
        $user_id = $this->user()->id;
        $topic_id = $topic->id;

        $reply->fill($request->all());
        $reply->user_id = $user_id;
        $reply->topic_id = $topic_id;
        $reply->save();

        return $this->response->item($reply, new ReplyTransformer())
            ->setStatusCode(201);
    }
}
