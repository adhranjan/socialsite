<template>
    <li role="presentation" class="dropdown">
        <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-envelope-o"></i>
            <span class="badge bg-green">
                <unreadnotification></unreadnotification>
            </span>
        </a>
        <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
            <li v-for="display in display_all">
                <a @click="getHrefHandler(1)">
                    <span class="image">

                    </span>
                    <span>
                    <span>{{ display.data.name }}</span>
                    <span class="time">3 mins agos</span>
                    </span>
                            <span class="message">
                    Film festivals used to be do-or-die moments for movie makers. They were where...
                    </span>
                </a>
            </li>
        </ul>
    </li>
</template>

<script>
        export default{
            mounted() {
                    this.listen();
                },
            data () {
                return {
                    notificationType:'',
                };
            },

            props:['id'],
            methods:{
                listen(){
                    Echo.private('App.User.'+this.id)
                        .notification((notification)=>{
                            console.log(1);
                            this.notificationType=notification.type.split("\\");
                            console.log(this.notificationType)
                            if(this.notificationType[2] == "NewWallPost"){
                                this.$store.commit('add_new_post_online',notification.post);
                            }else{
                            this.$store.commit('add_notification',notification)
                            noty({
                                type:'success',
                                layout:'bottomLeft',
                                text:notification.message,
                            })
                            document.getElementById('noty_audio').play()
                            }
                        })
                    },
                getHrefHandler(link){
                    this.$store.commit('hrefHandler',link)

                }

            },
            computed:{
                display_all(){
                    return this.$store.getters.all_notifications
                }
            }

        }
</script>
