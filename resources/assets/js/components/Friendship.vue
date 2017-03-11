<template>
        <div>
            <p class="text-info" v-if="loading">Loading....</p>
            <button class="btn btn-info" v-if="status == 'not_friend'" @click="add_friend">Make Friend</button>
            <button class="btn btn-danger" v-if="status == 'cancel'" @click="cancel_request">Cancel Request</button>
            <button class="btn btn-warning" v-if="status == 'fight'" @click="fight">Unfriend</button>
            <button class="btn btn-success" v-if="status == 'accept/ignore'" @click="friend_response">Accept Request</button>
            <button class="btn btn-danger" v-if="status == 'accept/ignore'" @click="cancel_request">Cancel Request</button>
        </div>
</template>

<script>
    export default {
        mounted() {
            this.$http.get('check_friendship_status/'+this.profile_user_id)
                    .then((response)=>{
                        console.log(response.body.status)
                        this.loading=false;
                        this.status=response.body.status;
                    })
        },
        props:['profile_user_id'],
        data(){
            return{
                status:'',
                loading:true,
            }
        },
        methods:{
            add_friend(){
                this.loading=true;
                this.$http.post('friend_request/'+this.profile_user_id).then((response)=>{
                    this.status='cancel' //activate canrel request btn
                    noty({
                        type:'success',
                        layout:'bottomLeft',
                        text:'Request Sent.',
                    })
                    this.loading=false

                })
            },
            cancel_request(){
                this.loading=true;
                this.$http.post('cancel_request/'+this.profile_user_id).then((response)=>{
                    this.status='not_friend' //activate add friend btn
                    noty({
                        type:'error',
                        layout:'bottomLeft',
                        text:'Request Cancelled.',
                    })
                    this.loading=false
                })
            },
            friend_response(){
                this.loading=true;
                this.$http.post('friend_response/'+this.profile_user_id).then((response)=>{
                    this.status='fight'; //unfriend btn
                    noty({
                        type:'success',
                        layout:'bottomLeft',
                        text:'Request Accepted.',
                    })
                    this.loading=false;

                })
            },
            fight(){
                this.loading=true;
                this.$http.post('delete_friend/'+this.profile_user_id).then((response)=>{
                    console.log(response);
                    this.status='not_friend'; //unfriend btn
                    noty({
                        type:'error',
                        layout:'bottomLeft',
                        text:'Removed from friend list.',
                    })
                    this.loading=false;

                })
            },
        }
    }
</script>
