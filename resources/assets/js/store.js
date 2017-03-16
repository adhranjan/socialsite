import Vuex from 'vuex'
import Vue from 'vue'

Vue.use(Vuex)

export const store = new Vuex.Store({
    state:{
        notifications:[],
        posts:[],
        auth_user:{},
        visited_profile_id:'',
        whatAboutFriendShip:'',
    },
    getters:{
        whatsFriendShipStatus(state){
            return state.whatAboutFriendShip
        },
        all_notifications(state){
            return state.notifications
        },
        all_notification_count(state){
            return state.notifications.length
        },
        all_post(state){
            return state.posts;
        }
    },

    mutations:{
        changeFriendShipStatus(state,status){
            console.log(state)
            console.log(status)
          return state.whatAboutFriendShip=status
        },
        add_notification(state, notification){
            return state.notifications.push(notification)
        },
        hrefHandler(event){
            console.log(event)
        },
        add_post(state, post){
            return state.posts.push(post)
        },
        add_new_post_online(state, post){
            return state.posts.unshift(post)
        },
        auth_user_data(state,user){
            state.auth_user=user;
        },
        update_post_likes(state,payload){
            var post= state.posts.find( (currentPost)=>{
                return currentPost.id === payload.id
            })
            post.likes.push(payload.like)
        },
        update_post_unlike(state,payload){
            var post= state.posts.find( (currentPost)=>{
                return currentPost.id === payload.id
            })
            var like= post.likes.find((l)=>{
                return l.id===payload.like_id
            })
            var index=post.likes.indexOf(like)
            post.likes.splice(index,1);
        }
    },
})