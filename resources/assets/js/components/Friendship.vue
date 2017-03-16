<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <i class="fa fa-spinner fa-spin fa-2x" v-if="loading"></i>
                <div v-else>
                    <button class="btn btn-info" v-if="this.$store.getters.whatsFriendShipStatus== 'not_friend'" @click="add_friend">Make Friend</button>
                    <button class="btn btn-danger" v-if="this.$store.getters.whatsFriendShipStatus == 'cancel'" @click="cancel_request">Cancel Request</button>
                    <button class="btn btn-warning" v-if="this.$store.getters.whatsFriendShipStatus == 'fight'" @click="fight">Unfriend</button>
                    <button class="btn btn-success" v-if="this.$store.getters.whatsFriendShipStatus == 'accept/ignore'" @click="friend_response">Accept Request</button>
                    <button class="btn btn-danger"  v-if="this.$store.getters.whatsFriendShipStatus == 'accept/ignore'" @click="cancel_request">Cancel Request</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.$store.state.visited_profile_id=this.profile_user_id;
            this.$http.get('check_friendship_status/'+this.profile_user_id)
                    .then((response)=>{
                    this.loading=false
                    this.$store.commit('changeFriendShipStatus',response.body.status)
                    if(response.body.status=='fight'){
                        this.$http.get('get/wall/post/'+this.$store.state.visited_profile_id)
                                .then((posts)=>{
                                    posts.body.forEach((post)=>{
                                        this.$store.commit('add_post',post)
                                    })
                                })
                    }
            })
        },
        props:['profile_user_id'],
        data(){
            return{
                loading:true,
            }
        },
        methods:{
            add_friend(){
                this.loading=true;
                this.$http.post('friend_request/'+this.profile_user_id).then((response)=>{
                    this.$store.commit('changeFriendShipStatus','cancel');
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
                    this.$store.commit('changeFriendShipStatus','not_friend');
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
                    this.$store.commit('changeFriendShipStatus','fight');
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
                    this.$store.commit('changeFriendShipStatus','not_friend');
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
