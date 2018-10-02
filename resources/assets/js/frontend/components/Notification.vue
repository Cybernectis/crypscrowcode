<template>
    
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <span class="glyphicon glyphicon-globe"></span>
            Notifications <span class="badge">{{ count }}</span> <span class="caret"></span>
        </a>

        <ul class="dropdown-menu scroll" role="menu" v-bind:style="styleObject">
            <li v-for="notification in notifications">
                <a v-bind:href="notification.data.testurl" v-on:click="MarkAsRead(notification)">
                    <strong>{{notification.time}}</strong>
                
                 
                    <small>{{ notification.data.message }}</small>
                </a>
            </li>
            <li v-if="notifications.length == 0">
                There is no new notifications
            </li>
        </ul>
    </li>
</template>

<script>
    export default {
        props: ['notifications', 'count'],
        
        data() {
            return {
                styleObject: {
                    overflowY:'scroll',
                    minHeight:"250px",
                    height:"200px"
                    }
            }
        },
        methods: {
            MarkAsRead: function(notification) {
            
                var data = {
                    id: notification.id
                };
                var url = host+'/notification/read';
                axios.post(url, data).then(response => {
                    
                });
            }
        }
    }
</script>
