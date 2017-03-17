<template>
    <div>
        <ul class="messages">
            <li v-for="post in all_posts">
                <img :src="post.user.avatar" alt="Avatar" class="avatar">
                <div class="message_date">
                    <p class="month">{{ post.created_at }}</p>
                </div>
                <div class="message_wrapper">
                    <h5 class="heading">
                        <a :href="post.user.profile_id">{{ post.user.name }}</a>
                        <span v-if="post.wallof.id !== post.user.id">
                            to
                            <a :href="post.wallof.profile_id">{{ post.wallof.name }}</a>
                        </span>
                    </h5>
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
            this.getFeed();
        },
        data () {
            return {
                page:1,
                loading:false,
            };
        },
        methods:{
            getFeed(){
                this.$http.get('get/friend/post')
                        .then((posts)=>{
                            posts.body.forEach((post)=>{
                                this.$store.commit('add_post',post)
                            })
                        })
            },
            handleScroll () {
                if($(window).scrollTop() + $(window).height() > $(document).height() - 70) {
                    if(this.loading==false){
                        this.loading=true;
                        this.page++;
                        this.$http.get('get/friend/post?page='+this.page)
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
        },
        computed:{
            all_posts(){
                return this.$store.getters.all_post
            }
        },
        created () {
            window.addEventListener('scroll', this.handleScroll);
        },
        destroyed () {
            window.removeEventListener('scroll', this.handleScroll);
        }
    }
</script>