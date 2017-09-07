var Vue = require('js')
var hello = require('js!./components/hello.vue')

new Vue({
    el: '#app',
    components: {
        hello: hello
    }
})