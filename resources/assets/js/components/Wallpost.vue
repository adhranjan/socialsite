<template>
    <div v-if="this.$store.state.friendShipStatus == 'fight'">
        <textarea class="form-control" placeholder="Write on all" rows="4" v-model="content"></textarea>
        <br>
        <button class="btn btn-success pull-right" :disabled="not_working" @click="create_post()"> Post </button>
    </div>
</template>

<script>
    export default{
        mounted(){

        },
        data(){
            return {
                content:'',
                not_working:true,
            }
        },
        methods:{
            create_post(){
              this.$http.post('create/wall/post',{content:this.content,wall_of:this.$store.state.visited_profile_id})
                      .then((response)=>{
                          this.content='';
                          this.$store.commit('add_new_post_online',response.body);
                      })
          }
        },
        watch:{
            content(){
                if(this.content.length>0){
                    this.not_working=false
                }else{
                    this.not_working=true
                }

            }
        }

    }
</script>