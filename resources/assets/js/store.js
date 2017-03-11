import Vuex from 'vuex'
import Vue from 'vue'

Vue.use(Vuex)

export const store = new Vuex.Store({
    state:{
        notifications:[]
    },
    getters:{
        all_notifications(state){
            return state.notifications
        },
        all_notification_count(state){
            return state.notifications.length
        }
    },

    mutations:{
        add_notification(state, notification){
            return state.notifications.push(notification)
        }
    }
})