<template>
    <div></div>
</template>

<script>
    export default{
        mounted(){
            this.getAuthUserData();
        },
        methods:{
            getAuthUserData(){
                this.$http.get('auth_user_data').then((response)=>{
                    this.$store.commit('auth_user_data',response.body)
                })
            }
        }
    }
</script>