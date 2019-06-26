<?php
namespace Illuminate\Log;   
namespace App\Http\Controllers;
use DateTime;
use App\User;
use App\Message;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Log\LogManager;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function fetchMe(){
        return Auth::user();
    }
    public function getMessages(User $user)
    {
        $privateCommunication = Message::with('user')
        ->where(['user_id'=> auth()->id(), 'receiver_id'=> $user->id])
        ->orWhere(function($query) use($user){
            $query->where(['user_id' => $user->id, 'receiver_id' => auth()->id()]);
        })
        ->get();

        return $privateCommunication;
    }
    public function getUsers()
    {
        return User::all();
    }
    public function fetchMessages()
    {
        return Message::with('user')->get();
    }
    public function sendMessages(Request $request, User $user)
    {
        $input = $request->all();
        $input['receiver_id'] = $user->id;
        $sender = Auth::user()->id;
        $receiver = $user->id;
        if( $sender > $receiver )
        {
            $input['conversation_id'] = $receiver.'_'.$sender;
        }
        else
        {
            $input['conversation_id'] = $sender.'_'.$receiver;
        }
        $message = auth()->user()->messages()->create( $input );
        //Trigger event
        broadcast( new MessageSent( $message->load('user') ) )->toOthers();
        return $message;
    }
    public function getAllMessages()
    {
        $data = [];
        $user = Auth::user();

        $allMessages = Message::with('user')
        ->where('user_id', '=', $user->id)
        ->orWhere('receiver_id', '=', $user->id)
        ->orderBy('conversation_id')
        ->get();

        $index = -1;
        $currentConversationId = 0;
        $count= 0;
        $lock = 0;
        foreach($allMessages as $message)
        {
            if($currentConversationId != $message->conversation_id)
            {
                $currentConversationId = $message->conversation_id;
                $index++;
                $count = 0;

                //Getting My Data and other user data
                if($lock == 0)
                {
                    if($message->user_id == Auth::user()->id)
                    {
                        $meta['total_msg'] = Message::where('conversation_id', $message->conversation_id)->count();
                        $meta['my_id'] = Auth::user()->id;
                        $meta['my_name'] = Auth::user()->name;
                        $receiver = User::where('id', '=', $message->receiver_id)->first();
                        $meta['friend_id'] = $receiver->id;
                        $meta['friend_name'] = $receiver->name;
                        $meta['role'] = $receiver->user_type;
                        $meta['friend_image'] = $receiver->user_image;

                        $data[$index][$count] = $meta;
                    }
                    else
                    {
                        $meta['total_msg'] = Message::where('conversation_id', $message->conversation_id)->count();
                        $receiver = User::where('id', '=', $message->user_id)->first();
                        $meta['friend_id'] = $receiver->id;
                        $meta['friend_name'] = $receiver->name;
                        $meta['friend_image'] = $receiver->user_image;
                        $meta['role'] = $receiver->user_type;
                        $meta['my_id'] = Auth::user()->id;
                        $meta['my_name'] = Auth::user()->name;

                        $data[$index][$count] = $meta;
                    }
                    $lock++;
                }
            }
            $currentConversationId = $message->conversation_id;
            
            $count++;
            $lock=0;
            $data[$index][$count] = $message;
        }

        return $data;

    }
    public function getFriend($user)
    {
        return $user = User::where('id', '=', $user)->first();
    }
}
