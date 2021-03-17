// import vue here
import Vue from 'https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.esm.browser.js'

// import components
import MovieThumb from "./components/TheMovieThumb.js";

(() => {
    const mnVM = new Vue({
        data: {
            movies: []
        },

        created: function(){
            fetch('./index.php')
            .then(res => res.json())
            .then(data => this.movies = data)
        .catch(err => console.error(err));
        },

        methods: {

        },

        components: {
            moviethumb: MovieThumb
        }
    }).$mount("#app");
})();