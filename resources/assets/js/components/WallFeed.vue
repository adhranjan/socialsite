<template>
    <div>
        <ul class="messages" v-if="this.$store.getters.whatsFriendShipStatus=='fight'">
            <li v-for="post in all_posts">
                <img :src="post.user.avatar" alt="Avatar" class="avatar">
                <div class="message_date">
                    <p class="month">{{ post.created_at }}</p>
                </div>
                <div class="message_wrapper"><h4 class="heading"><a :href="post.user.profile_id">{{ post.user.name }}</a></h4>
                    <blockquote class="message">
                        {{ post.content }}
                    </blockquote>
                    <like :id="post.id"></like>
                </div>
            </li>
        </ul>
        <div class="text-center" v-if="loading"><i class="fa fa-spinner fa-spin fa-5x"></i></div>
    </div>
</template>

<script>
    export default{
        mounted(){

        },
        data () {
            return {
                page:1,
                loading:false,
           };
        },
        methods:{
            handleScroll () {
                if(this.$store.getters.whatsFriendShipStatus=='fight'){
                    if($(window).scrollTop() + $(window).height() > $(document).height() - 30) {
                        if(this.loading==false){
                            this.loading=true;
                            this.page++;
                            this.$http.get('get/wall/post/'+this.$store.state.visited_profile_id+'?page='+this.page)
                                    .then((posts)=>{
                                        posts.body.forEach((post)=>{
                                            this.$store.commit('add_post',post)
                                        })
                                        if(posts.body.length==0){
                                            this.loading=true;
                                        }
                                    })
                        }
                    }
                }
            }
        },
        computed:{
            all_posts(){
                return this.$store.getters.all_post
            },
        },
        created () {
            window.addEventListener('scroll', this.handleScroll);
        },
        destroyed () {
            window.removeEventListener('scroll', this.handleScroll);
        }
    }
</script>