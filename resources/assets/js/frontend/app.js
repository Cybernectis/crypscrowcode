
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('../bootstrap');
require('../plugins');
var Vue = require('vue');



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo'

window.Pusher = require('pusher-js');
window.Bus = new Vue();
window.Echo = new Echo({

    broadcaster: 'pusher',
    key: 'bdba74e1651b02a1e999',
    cluster: 'ap2',
    encrypted: false

});
import VueTimeago from 'vue-timeago'

Vue.use(VueTimeago, {
  name: 'timeago', // component name, `timeago` by default
  locale: 'en-US',
  locales: {
    // you will need json-loader in webpack 1
    'en-US': require('vue-timeago/locales/en-US.json')
  }
})
// window.Vue = require('vue');
// import VueRouter from 'vue-router';
// import router from './routes';
// Vue.use(VueRouter);
Vue.component('example', require('./components/ExampleComponent.vue'));

Vue.component('create-group', require('./components/CreateGroup.vue'));
Vue.component('groups', require('./components/Groups.vue'));
Vue.component('group-chat', require('./components/GroupChat.vue'));
Vue.component('notification', require('./components/Notification.vue'));
Vue.component('file-upload',require('./components/FileUpload.vue'));
 var element = document.getElementById("myapp");
if (element !== null || (typeof element === 'undefined')) {
const app = new Vue({
    el: '#myapp',

    
});
}
const app1 = new Vue({
    el: '#myapp1',

	 data: {
	        notifications: '',
            count:""
	    },
	    created() {
            var authstatus = $('meta[name="authstatus"]').attr('content');
            
            if(authstatus)
            {
                
                this.getNotifications();
                
               
                window.Echo.private('notification.' + userId).notification((notification) => {
                    this.getNotifications();
                });
            }
	    	
	    },
        methods: {
            getNotifications: function() {
            
                var url = host+'/notification/get';
                axios.post(url).then(response => {
                    this.notifications = response.data.data;
                    this.count = response.data.count;
                });
            }
        }
});


