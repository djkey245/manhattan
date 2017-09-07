
var elixir = require('laravel-elixir');


require('laravel-elixir-vueify');

elixir(function(mix) {
    mix.browserify('app.js');
});

elixir(function(mix) {
    mix.sass('app.scss');
});
