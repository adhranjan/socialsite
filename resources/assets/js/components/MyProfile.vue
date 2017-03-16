<template>
    <div>
        <a class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
    </div>
</template>

<script>
    export default {
        mounted() {
                this.$store.state.visited_profile_id=this.profile_user_id;
                this.$store.state.friendShipStatus='fight';
        },
        props:['profile_user_id'],
        data(){
            return{
                loading:true,
            }
        },
    }
</script>
