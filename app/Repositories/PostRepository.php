<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PostRepository implements PostRepositoryInterface
{
    private Post $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function get()
    {
        return $this->post->with('user')->with('category')->paginate(10);
    }
    public function listPosts()
    {
        return $this->post->paginate(10);
    }
    public function show($post)
    {
        return $post;
    }
    public function myPosts(){
        return $this->post->where('user_id',auth()->user()->id)->paginate(10);
    }
    public function showPost($id){
        return $this->post->with('comments')->find($id);
    }
    public function store($data)
    {
        $data['user_id'] = auth()->user()->id;
        $post = $this->post->create($data);
        if(isset($data['attachments'])){
            $i = 1;
            foreach ($data['attachments'] as $file) {
                $filename = $post->slug.'-'.time().'-'.$i.'.'.$file->getClientOriginalExtension();
                $file_size = $file->getSize();
                $file_type = $file->getMimeType();
                $path = public_path('assets/posts/' . $filename);
                Image::make($file->getRealPath())->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path, 100);

                $post->attachments()->create([
                    'file_name' => $filename,
                    'file_size' => $file_size,
                    'file_type' => $file_type,
                ]);
                $i++;
            }
        }
        if(isset($data['tags'])){
            $post->tags()->sync($data['tags']);

        }
        return $post;
    }

    public function update($post,$data)
    {
        return $post->update($data);
    }

    public function delete($post)
    {
        return $post->delete();
    }
}
