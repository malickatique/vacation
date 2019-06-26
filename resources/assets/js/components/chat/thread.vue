<template>

<div class="thread msg-bubble">

    <div class="msg-body shadow" :class="className">

        <div class="massenger-name">
            <p :class="userNameColor" class=" text-success"> <b>{{user.name }}</b> </p>
        </div>

        <div class="msg-text">
            <h5> <slot></slot> </h5>
        </div>

        <div class="msg-time">
            <small class="badge float-right"> {{ time | timeAgo}} </small>
        </div>
    </div>


<!-- <div class="container">
    <div class="msg">
        <div :class="(isFollow=='no')?'bubble':'bubble-follow'">
            <div class="txt">
                <span class="name">{{user.name}}</span>
                <span class="timestamp">10:20 pm</span>      
                <span :class="(isFollow=='no')?'messsage':'message follow'">
                    <slot></slot> 
                </span> 
            </div>
            <div :class="(isFollow=='no')?'bubble-arrow':''"></div>
        </div>
    </div>  
</div> -->



</div>
</template>

<script>    
    export default {
        props:[
            'color',
            'user',
            'time',
            'isFollow',
        ],
        data(){
            return {
            }
        },
        methods:{
            init(){
 
            },
        },
        computed:{
            className(){
                // console.log(this.color);
                if(this.color == 'primary')
                {
                    return 'msg-receiver col-6 float-left';
                    // return 'col-4 float-right list-group-item-'+this.color;
                    return 'col-6 float-left';
                }
                else{
                    return 'msg-sender col-6 float-right';
                    return 'col-6 float-right';
                }
            },
            userNameColor(){
                if(this.color == 'primary')
                {
                    return 'text-danger';
                }
                else{
                    return 'text-secondary';
                }
            },
        },
        mounted() {
            // this.init();
        },
    }
</script>
