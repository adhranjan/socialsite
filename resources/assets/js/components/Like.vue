<template>
    <div>
        <p>
            <a href="#" v-if="!auth_user_likes_post" v-on:click.prevent="like()"><i class="fa fa-thumbs-o-up fa-2x"></i></a>
            <a href="#" v-else v-on:click.prevent="unlike()"><i class="fa fa-thumbs-up fa-2x"></i></a>
            <span v-if="post.likes.length !=0">
                <span v-if="!auth_user_likes_post">
                    <span v-if="post.likes.length==1">
                            <a :href="post.likes[0].user.profile_id">{{ post.likes[0].user.name }}</a> likes this.
                    </span>
                    <span v-else>
                            {{ post.likes.length }} people likes.
                    </span>

                </span>
                <span v-else>
                    <span v-if="post.likes.length==1">
                        You like this.
                    </span>
                    <span v-else>
                        You and {{ post.likes.length-1 }} other like this.
                    </span>
                </span>
            </span>
        </p>
    </div>
</template>
<script>
    export default{
        mounted(){

        },
        props:['id'],
        computed:{
            postLiker(){
                var postLiker=[];
                this.post.likes.forEach((like)=>{
                    postLiker.push(like.user.id)
                })
                console.log(postLiker)
                return postLiker;
            },
            auth_user_likes_post(){
                var checkIndex=this.postLiker.indexOf(
                        this.$store.state.auth_user.id
                )

                if(checkIndex === -1){
                    return false
                }
                else{
                    return true
                }
            },
            post(){
                return  this.$store.state.posts.find((post)=>{
                    return post.id===this.id
                })
            }
        },
        methods:{
            like(){
                this.$http.post('like/'+this.id).then((response)=>{
                    this.$store.commit('update_post_likes',{
                        id:this.id,
                        like:response.body,
                    })
                })
            },
            unlike(){
                this.$http.post('unlike/'+this.id).then((response)=>{
                    this.$store.commit('update_post_unlike',{
                        id:this.id,
                        like_id:response.body
                    })
                })
            }
        }
    }
</script>