<template>
    <li class="nav-item dropdown" v-if="notifications.length">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span><i class="material-icons md-dark md-18">notifications</i></span>
        </a>

        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a v-for="notification in notifications"
               class="dropdown-item"
               :href="notification.data.link"
               v-text="notification.data.message"
               @click="markAsRead(notification)"
            >
            </a>
        </div>
    </li>
</template>

<script>
    export default {
        name: "UserNotifications",

        data(){
            return { notifications: false }
        },

        created(){
            axios.get("/profiles/" + window.App.user.name + "/notifications")
                .then(response => this.notifications = response.data);
        },

        methods: {
            markAsRead(notification){
                axios.delete("/profiles/" + window.App.user.name + "/notifications/" + notification.id);
            }
        }
    }
</script>

<style scoped>
    .dropdown-toggle::after {
        display:none;
    }
    .md-18 {
        font-size: 18px !important;
        line-height: 24px !important;
    }
</style>