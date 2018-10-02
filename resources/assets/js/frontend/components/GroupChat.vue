<template>
    <div>
    <div class="panel panel-default">
            <div class="panel-heading" id="accordion">
                <span class="glyphicon glyphicon-comment"></span> {{ group.name }}
                <div class="btn-group pull-right">
                    <a type="button" class="btn btn-default btn-xs" data-toggle="collapse" data-parent="#accordion-" :href="'#collapseOne-' + group.id">
                        <span class="glyphicon glyphicon-chevron-down"></span>
                    </a>
                </div>
            </div>
            <div class="panel-collapse " :id="'collapseOne-' + group.id">
                <div class="panel-body chat-panel">
                    <div class="well text-justify" v-if="conversations.length == 0"><p>New trade chat welcome message. </p>
                        <p>Any Messages sent here are encrypted and can only be read by you and <b>{{ group.users[0].username }}</b>.</p>
                        <p>In the event of dispute, you will have to provide trade’s  secret key so that our staff can assist you.</p>

                       <p> Happy trading!</p>
                       <p>Note:</p>
                       <p>1. Do not make any payment unless smart contract escrow account is funded by seller.
                       </p>
                       <p>2.  CrypScrow or it’s staff is not responsible for the loss if you trade directly with buyer/seller without using smart contract escrow account. 
                       </p>
                    </div>
                    <ul class=" list-group chat" v-if="conversations.length != 0">
                        <li class="list-group-item" v-for="conversation in conversations" v-bind:class="classObject(conversation.user.id)">
                            <span class="chat-img " v-bind:class="classLeftRight(conversation.user.id)">
                                
                                <img v-bind:src="conversation.user.picture" alt="User Avatar" class="img-circle" width="50" height="50" />
                                
                            </span>
                            
                            <div class="chat-body clearfix" >
                                <small v-bind:class="classLeftRightSmall(conversation.user.id)">{{conversation.time}}</small>
                                <div v-bind:class="classLeftRight(conversation.user.id)" >
                                    <div class="header">
                                        
                                        <strong class="primary-font">{{ conversation.user.username }}</strong>
                                    </div>
                                    <p v-html="conversation.message">
                                    </p>
                                    
                                   
                                </div>
                                
                            </div> 
                        </li>
                    </ul>
                </div>
                <div class="panel-footer">
                    <div class="input-group">
                        <input id="btn-input" type="text" class="form-control input-sm" placeholder="Type your message here..." v-model="message" @keyup.enter="store()" autofocus />

                        <span class="input-group-btn">

                            <button class="btn btn-grey btn-sm" id="btn-chat" @click.prevent="store()">
                                Send
                            </button>
                        </span>

                    </div>
                    <file-upload :groupId="this.group.id"></file-upload>
                </div>
                
            </div>
            
        </div>
    </div>
</template>

<script>
    export default {
        props: ['group'],
        // props: ['group', 'color'],
        
        data() {
            return {
                conversations: [],
                message: '',
                group_id: this.group.id,
                encrypted:"",
                conversationUpdated : [],
                encrypt:this.group.uuid,
            }
        },
        computed:{
            
        },
        created() {
            this.fetchMessages(this.group.id);
        },
        mounted() {
            this.listenForNewMessage();
        },

        methods: {
            store() {
                var url = host+'/conversations';
                var cipherObject =window.CryptoJS.AES.encrypt(this.message, this.group.uuid); 
                
                
                axios.post(url, {message: cipherObject+'', group_id: this.group.id})
                .then((response) => {
                    this.message = '';
                
                   response.data.message= CryptoJS.AES.decrypt(response.data.message.toString(), this.group.uuid).toString(CryptoJS.enc.Latin1);
                    this.conversations.push(response.data);
                });
            },

            listenForNewMessage() {
                window.Echo.private('groups.' + this.group.id)
                    .listen('NewMessage', (e) => {
                        
                        this.fetchMessages(this.group.id);
                        // this.conversations.push(e);
                    });
            },

            fetchMessages(id) {
                var url = host+'/message/'+id;
                axios.get(url).then(response => {
                     this.conversations = response.data;
                     for (var i = this.conversations.length - 1; i >= 0; i--) {
                         console.log(this.conversations[i].message);
                        var isHTML = RegExp.prototype.test.bind(/(<([^>]+)>)/i);
                        if(isHTML(this.conversations[i].message))
                        {
                            console.log("html");
                        }else{
                            this.conversations[i].message =  CryptoJS.AES.decrypt(this.conversations[i].message.toString(), this.group.uuid).toString(CryptoJS.enc.Utf8);
                        }
                        
                     }
                    // this.conversationUpdated = response.data;
                    // console.log(this.conversations)
                });
            },
            classObject(id){
                
                if (userId == id) {
                    return "list-group-item-danger "
                }else{
                    return "list-group-item-success";
                }
                
            } ,
            classLeftRight(id){
                
                if (userId == id) {
                    return "pull-right clearfix"
                }else{
                    return "pull-left clearfix";
                }
                
            } ,
            classLeftRightSmall(id)
            {
                if (userId == id) {
                    return "pull-left"
                }else{
                    return "pull-right ";
                }
            },
           
        }  
    }
</script>
