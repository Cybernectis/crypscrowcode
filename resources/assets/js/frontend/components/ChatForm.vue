<template>
   
        
    
    <div class="input-group">
        
        <input id="btn-input" type="text" name="message" class="form-control input-sm" placeholder="Type your message here..." v-model="newMessage" @keydown="isTyping" @keyup="notTyping" @keyup.enter="sendMessage">

        <span class="input-group-btn">
            <button class="btn btn-primary btn-sm" id="btn-chat" @click="sendMessage">
                Send
            </button>
        </span>
        
    </div>
</template>

<script>
    export default {
        props: ['user',
        'typing'],

        data() {
            return {
                newMessage: '',
               
            }
        },

        methods: {
            sendMessage() {
                this.$emit('messagesent', {
                    user: this.user,
                    message: this.newMessage
                });

                this.newMessage = ''
            } ,
            isTyping() {
                let channel = window.Echo.private('chat');
                console.log("herr "+ this.typing);
                channel.whisper('typing', {
                        user: this.user,
                        typing: true
                    });
                // setTimeout(function() {
                //     console.log("working");
                //     channel.whisper('typing', {
                //         user: this.user,
                //         typing: true
                //     });
                // }, 300);
            },
            notTyping() {
                let channel = window.Echo.private('chat');
                console.log("not typing")
                // setTimeout(function() {
                //     channel.whisper('typing', {
                //         user: Laravel.user,
                //         typing: true
                //     });
                // }, 300);
            },
        }    
    }
</script>