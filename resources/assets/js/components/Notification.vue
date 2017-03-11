<template>
    <div>
        I'm an example component!
    </div>
</template>

<script>
        export default{
            mounted() {
                    this.listen();
                },
            props:['id'],
            methods:{
                listen(){
                    Echo.private('App.User.'+this.id)
                        .notification((notification)=>{
                            this.$store.commit('add_notification',notification)
                            noty({
                                type:'success',
                                layout:'bottomLeft',
                                text:notification.message,
                            })
                            document.getElementById('noty_audio').play()
                        })
                    }
            }
        }
</script>
