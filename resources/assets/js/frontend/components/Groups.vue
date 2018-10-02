<template>
    <div>
        <group-chat  :group="groups" :key="groups.id" ></group-chat>
    </div>
</template>

<script>
    export default {
        props: ['initialGroups', 'user'],

        data() {
            return {
                groups: [],
            }
        },

        mounted() {
            this.groups = this.initialGroups; 
            Bus.$on('groupCreated', (group) => {
                this.groups.push(group);
            });

            this.listenForNewGroups();
        },

        methods: {
            listenForNewGroups() {
                window.Echo.private('users.' + this.user.id)
                    .listen('GroupCreated', (e) => {
                        this.groups.push(e.group);
                    });
            }
        }
    }
</script>
