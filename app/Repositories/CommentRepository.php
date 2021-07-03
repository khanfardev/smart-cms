<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CommentRepository implements CommentRepositoryInterface
{
    private Comment $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function get()
    {

        return $this->category->paginate(10);
    }

    public function show($comment)
    {
        return $this->comment->find($comment);
    }

    public function store($data,$post)
    {
        $data['post_id'] = $post;
        $data['user_id'] = auth()->user()->id;
        return $this->comment->create($data);
    }

    public function update($data,$comment)
    {
        return $this->show($comment)->update($data);
    }

    public function delete($comment)
    {
        return $comment->delete();
    }
}
