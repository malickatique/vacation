<template>
    <div class="container">
        
    <h1 class="mt-2 text-center"> <i class="fa fa-envelope" aria-hidden="true"></i> Messaging </h1> 
    <hr>

        <div class="row">

            <div v-show="myAllMessages == '' " class="text-center">
                <h2> No messages received. </h2>
            </div>

<!-- chat part -->
<div class="col-md-8 col-md-offset-2 my-5">

    <div v-if="friendId!=''">
        <div class="card">

            <li class="list-group-item active"> {{currentUser}} 
                
                <!-- Online Status -->
                <span> 
                    <i class="fa fa-circle" :class="(online=='yes')?'text-success':'text-danger'"></i>
                </span>
            </li>

            <ul class="list-group list-group-flush chat-body" ref='msgBody' id="chatBackground">

                <thread v-for="(msg, index) in chat.messages" v-bind:key="msg.index"
                :color="(msg.user_id==myId)?'success':'primary'"
                :time="msg.created_at"
                :user= chat.messages[index].user
                :isFollow="getIsFollow(index)"
                
                >
                    {{ msg.message }} 
                </thread>

                <div class="p-4"
                v-if="typingUser!=''"> <b>{{typingUser.name+ ' is typing...'}}</b> </div>
            
            </ul>
        </div>

        <form>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> 
                    @
                </span>
            </div>
                <textarea v-model="message" @keyup.enter='send' @keydown="onTyping"
                class="form-control form-control-lg" type="text" placeholder="your message" maxlength="150">
                </textarea>
            <div class="input-group-append">
                <span class="input-group-text" :class="(message.length==150)?'text-danger':''" 
                v-text="(150 - message.length)"></span>
            </div>
        </div>
        </form>

    </div>
</div>
<!-- end of chat part -->

<!-- users -->
<div class="col-md-4 col-md-offset-2 my-5">
    <div class="card">
        <ul class="list-group list-group-flush"
            v-for="(messages, index) in myAllMessages" v-bind:key="index"
        >
        
        <li class="list-group-item d-flex justify-content-between align-items-center row d-flex"> 

            <a href="#" class=""
            @click.prevent="chatWith(index)"
            >

                <div class="p-2 float-left">
                    <!-- <img src="images/user.png" alt="user" class="image-fluid xs-img"> -->
                    <img v-if="messages[0]['friend_image']!=''" :src="getUserPic(index)" alt="user" class="image-fluid xs-img">
                </div>


                <div class="mt-4 float-left">
                    <p>
                        {{ messages[0]['friend_name'] }}
                        <span class="badge badge-danger badge-pill"> {{ messages[0]['total_msg'] }} </span>
                    </p>
                </div>

            </a>
        </li>
            
        </ul>
    </div>

</div>
<!-- users -->
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return { 
                baseURL: Vue.prototype.$baseURL,
                online: 'no',
                isFollow: 'no',
                myId: '',
                friendId: '',
                me: '',
                time: '',
                user: '',
                userId: '',
                chat:{
                    messages:[],
                    user:[],
                    color:[],
                    time:[],
                },
                message: '',
                typingClock: '',
                typingUser: '' ,
                currentUser: 'User',
                onlineUsers: '', 

                myAllMessages: [],
                test: '',
                lock: '0',
            }
        },
        watch:{
            onlineUsers: function(val){
                this.updateStatuses();
            },
            typingUser: function(val){
                this.scrollToEnd();
                this.updateStatuses();
            },
            chat: function(val){
                this.scrollToEnd();
            },
            friendId: function(){
                this.online = 'no';
                this.updateStatuses();
            },
        },
        methods:{
            getAllMessages(){
                console.log('getting all chats.');
                axios.get('/getAllMessages')
                .then( response => {
                    this.myAllMessages = response.data;
                });
            },
            chatWith(index){
                this.currentUser = this.myAllMessages[index][0]['friend_name'];
                this.myId = this.myAllMessages[index][0]['my_id'];
                this.friendId = this.myAllMessages[index][0]['friend_id'];
                this.fetchMessages();
                this.initListeners();
                this.updateStatuses();
            },
            chatWithPropOwner(){
                this.fetchMessages();
                this.initListeners();
            },
            updateStatuses(){
                for(let i=0;i<this.onlineUsers.length;i++)
                {
                    // console.log('online, FID: '+this.friendId+', UID: '+ this.onlineUsers[i].id);
                    if(this.friendId == this.onlineUsers[i].id)
                    {
                        this.online = 'yes';
                        // this.currentUser = this.onlineUsers[i].name;
                        break;
                    }
                    else
                    {
                        this.online = 'no';
                        // this.currentUser = this.onlineUsers[i].name;
                    }
                }
            },
            onTyping(){
                Echo.private('chat.'+this.friendId).whisper('typing',{
                    user: this.me,
                });
            },
            getIsFollow(index){
                if(index!=0)
                {
                    let prev = index-1;
                    // console.log(this.chat.messages[prev].user_id);
                    if(this.chat.messages[index].user_id == this.chat.messages[prev].user_id)
                    {
                        return 'yes';
                    }
                    else{
                        return 'no';
                    }
                }
            },
            scrollToEnd(){
                // document.getElementById('msg-box').scrollTo(0,9999);
                var messageDisplay = this.$refs.msgBody;
                messageDisplay.scrollTop = messageDisplay.scrollHeight;
                console.log('Scrolling');
            },
            send(){
                if(this.message.length != 0){
                    console.log('sending message to: '+this.friendId+ ' msg: '+ this.message);

                    if(this.chat.messages.length!=0)
                    {
                        console.log('empty..');
                    //Get instant current message
                    this.chat.messages.push({
                        conversation_id: this.chat.messages[0]['conversation_id'],
                        created_at: new Date(),
                        updated_at: new Date(),
                        id: '',
                        image: '',
                        message: this.message,
                        receiver_id: this.friendId,
                        user_id: this.myId,
                        user: this.me,
                        });
                        setTimeout(this.scrollToEnd,10);
                    }

                    axios.post('/messages/'+ this.friendId, {message:  this.message})
                    .then( response => {
                        if(this.chat.messages.length==0)
                        {
                            console.log('not empty..');
                            this.chat.messages.push(response.data);
                        }
                        setTimeout(this.scrollToEnd,100);
                    });
                    this.message = '';
                }
            },
            fetchMe()
            {
                axios.get('/fetchMe')
                .then( response => {
                    this.me = response.data;
                });
            },
            fetchMessages(){
                console.log('getting '+this.friendId);
                axios.get('/messages/'+this.friendId)
                .then( response => {
                    this.chat.messages = response.data;
                });
                setTimeout(this.scrollToEnd,1000);
            },
            getTime(){
                let time = new Date();
                return time;
                // return time.getHours()+':'+time.getMinutes();
            },
            setTypingUser(){
                console.log('event');
                if(this.test.id==this.friendId)
                {
                    console.log('changed');
                    this.typingUser = this.test;
                }
            },
            initListeners(){
                if(this.lock == '0')
                {
                    console.log('Initializing..');
                    Echo.private('chat.'+this.myId )
                    .listenForWhisper('typing', (e)=>{
                            this.test = e.user;
                            this.setTypingUser();
                        if(this.typingClock) clearTimeout(); //Without this it'll keep flashing :)
                        this.typingClock = setTimeout(()=>{
                            this.typingUser = '';
                        },3000);
                    })
                    .listen('MessageSent', (e) => {
                        e.message.created_at = new Date();
                        e.message.updated_at = new Date();
                        console.log(e.message.created_at);
                        this.chat.messages.push(e.message);
                        console.log('receive msg: '+ e.message.message);
                        setTimeout(this.scrollToEnd(), 500);
                    })

                    //Another channel to check whather user is online or not
                    Echo.join('onlineStatus')
                    .here((users) => {
                        this.onlineUsers = users;
                        this.updateStatuses();
                        // console.log(this.onlineUsers);
                    })
                    .joining((user) => {
                        this.onlineUsers.push(user);
                        this.updateStatuses();
                        // console.log(user.name);
                    })
                    .leaving((user) => {
                        this.onlineUsers.splice(this.onlineUsers.indexOf(user), 1);
                        this.updateStatuses();
                        // console.log(user.name);
                    });

                    this.lock = '1';
                }
            },
            getFriend(){
                // console.log('friend me: '+this.friendId);
                axios.get('/getFriend/'+this.friendId)
                .then( response => {
                    this.currentUser = response.data.name;
                    // this.myAllMessages.push();
                });
            },
            loadFirst(){
                //chat of first user in the list
                console.log('found: '+ this.myAllMessages.length);
                if(this.myAllMessages.length!=0)
                {
                    console.log('Get first of: '+this.myAllMessages[0][0]['friend_id']);
                    this.friendId = this.myAllMessages[0][0]['friend_id'];
                    this.myId = this.myAllMessages[0][0]['my_id'];
                    this.chatWithPropOwner();
                    this.getFriend();
                }
            },
            getUserPic(index){
                if(this.myAllMessages[index][0]['role'] == 'owner')
                {
                let pic = (this.myAllMessages[index][0]['friend_image'].length > 200) ? this.myAllMessages[index][0]['friend_image'] : this.baseURL+"/images/user/owner/"+ this.myAllMessages[index][0]['friend_image'];
                return pic;
                }
                else{
                let pic = (this.myAllMessages[index][0]['friend_image'].length > 200) ? this.myAllMessages[index][0]['friend_image'] : this.baseURL+"/images/user/renter/"+ this.myAllMessages[index][0]['friend_image'];
                return pic;
                }
            },
            uploadFile(e){
                console.log('file'. e);
            }
        },
        mounted() {
            this.updateStatuses();
        },
        created(){

            //Will fetch matches after every x000 (x seconds)
            // setInterval(() => {
            //     this.getAllMessages();
            // }, 3000);
            //Fetching end
            

            console.log('created');
            this.fetchMe();
            this.getAllMessages();

            // Chat of property redirected user
            // console.log(' global: '+ this.$get.friendId+ ', asd'+ this.$get.myId);
            console.log('friend: '+this.$friendId);
            if(this.$friendId!='null')
            {
                console.log('In global first');
                this.friendId = this.$friendId;
                this.myId = this.$myId;
                this.chatWithPropOwner();
                this.initListeners();
                this.getFriend();
            }
            else
            {
                setTimeout(this.loadFirst, 2000);
                console.log('prototype: '+ this.$friendId);
            }

        }
    }
</script>
