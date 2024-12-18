<?php

namespace App\Http\Livewire\Chat;

use App\Models\User;
use App\Models\Message;
use Livewire\Component;
use App\Models\Conversation;

class Chatbox extends Component
{

    public $selectedConversation;
    public $receiver;
    public $messages;
    public $height;
    public $paginateVar= 10;
    protected $listeners=['loadConversation', 'pushMessage', 'loadmore', 'updateHeight'];

    public function pushMessage($messageId){

        $newMessage = Message::find($messageId);
        $this->messages->push($newMessage);

        $this->dispatchBrowserEvent('rowChatToBottom');
    }

    function loadmore(){

        // dd('top reached');
        $this->paginateVar=$this->paginateVar +10;
        $this->messages_count= Message::where('conversation_id', $this->selectedConversation->id)->count();
        $this->messages= Message::where('conversation_id', $this->selectedConversation->id)
                                ->skip($this->messages_count - $this->paginateVar)
                                ->take($this->paginateVar)->get();

                                $height= $this->height;
                                $this->dispatchBrowserEvent('updatedHeight', ($height));

    }


    function updateHeight($height){

        $this->height= $height;
    }


    public function loadConversation(Conversation $conversation, User $receiver){

        // dd($conversation, $receiver);

        $this->selectedConversation = $conversation;
        $this->receiverInstance =$receiver;

        $this->messages_count= Message::where('conversation_id', $this->selectedConversation->id)->count();
        $this->messages= Message::where('conversation_id', $this->selectedConversation->id)
                                ->skip($this->messages_count - $this->paginateVar)
                                ->take($this->paginateVar)->get();

                                $this->dispatchBrowserEvent('chatSelected');
    }

    public function render()
    {
        return view('livewire.chat.chatbox');
    }
}
