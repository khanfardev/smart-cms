<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Message;
use App\Models\Page;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MessageRepository implements MessageRepositoryInterface
{
    private Message $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function get($paginate=10,$message_user= 'receiver')
    {

        $messages =  $this->message->select([
        'messages.*',
        'sender.name as name_sender',
        'receiver.name as name_receiver'
    ])
        ->whereNull($message_user . '_deleted_at')
        ->whereNull('reply_parent')
        ->where($message_user . '_id', auth()->user()->id)
        ->Join('users as sender', 'sender.id', 'messages.sender_id')
        ->Join('users as receiver', 'receiver.id', 'messages.receiver_id')
        ->paginate($paginate);


        return  $messages;
    }

    public function show($message)
    {
        return $this->message->find($message);
    }

    public function store($data)
    {
        return $this->message->create($data);
    }

    public function update($message, $data)
    {
        return $this->show($message)->update($data);
    }

    public function delete($message)
    {
        return $this->show($message)->delete();
    }
}
