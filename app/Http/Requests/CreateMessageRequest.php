<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * receiver_id required User id you want to sent message to.
 * title required Message title.
 * content required Message content.
 * reply_on The parent message Id, if the message is a reply on another message
 */
class CreateMessageRequest extends FormRequest
{
    public function rules()
    {
        return [
            'receiver_id' => 'required|exists:users,id',
            'name_message' => 'max:30',
            'content_message' => 'required',
            'reply_parent' => 'string',
        ];
    }
}
