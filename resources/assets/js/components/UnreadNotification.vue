<template>
    <div>
        {{ all_notification_counted }}
    </div>
</template>

<script>
    export default{
         mounted(){
            this.get_unread();
         },
         methods:{
            get_unread(){
                this.$http.get('get_unread').then((notifications)=>{
                    notifications.body.forEach((notification)=>{
                        this.$store.commit('add_notification',notification)
                    })
                })
            }
         },
         computed:{
             all_notification_counted(){
                return this.$store.getters.all_notification_count
             }
         }
    }
</script>