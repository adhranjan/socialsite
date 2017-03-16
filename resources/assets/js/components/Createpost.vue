<template>
    <div>
        <textarea class="form-control" placeholder="Whats on your mind?" rows="4" v-model="content"></textarea>
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
              this.$http.post('create/post',{content:this.content})
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