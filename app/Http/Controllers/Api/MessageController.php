<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMessageRequest;
use App\Models\Message;
use App\Repositories\MessageRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    private MessageRepositoryInterface $messageRepository;
    public function __construct(MessageRepositoryInterface $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }
    public function index(Request $request) :JsonResponse
    {
        $paginate = $request->query('per_page', 10);
        if($request->query('folder', 'inbox') == 'inbox'){
            $message_user = 'receiver';
        }else{
            $message_user = 'sender';
        }
        return response()->json($this->messageRepository->get($paginate,$message_user));

    }



    public function store(CreateMessageRequest $request)
    {

        $message = $this->messageRepository->store($request->validated());
        return response()->json(['message' => 'message sent']);

    }


    public function show(Message $message)
    {
        //
    }


    public function edit(Message $message)
    {
        //
    }


    public function update(Request $request, Message $message)
    {
        //
    }


    public function destroy(Message $message)
    {
        //
    }
}
