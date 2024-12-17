<div>

    @if ($selectedConversation)
            
        <form wire:submit.prevent='sendMessage' action="">
            <div class="chatbox_footer">

                <div class="costum_form_group">

                    <input wire:model='body' type="text" class="control" placeholder="write message">
                    <button type="submit" class="submit">Send</button>

                </div>
        
            </div>
        
        </form>

    @endif
    
</div>
