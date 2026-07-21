<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Traits\ApiResponse;

class MessageController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $messages = Message::latest()->paginate(10);

        return $this->successResponse($messages, 'Messages fetched successfully.');
    }

    public function show($id)
    {
        $message = Message::findOrFail($id);

        if (!$message->is_read) {
            $message->update([
                'is_read' => true,
            ]);
        }

        return $this->successResponse($message, 'Message fetched successfully.');
    }

    public function destroy($id)
    {
        $message = Message::findOrFail($id);

        $message->delete();

        return $this->successResponse([], 'Message deleted successfully.');
    }
}