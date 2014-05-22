
var H = H || {};

H.Router = Backbone.Router.extend({
    routes: {
        'album/:id': 'checkOutAlbum',
        'user/:id': 'checkOutUser',
    }, 
    checkOutAlbum: function(id) {
        console.log(id); 
    },
    checkOutUser: function(id) {
        console.log(id);
    }
});

Backbone.history.start({
    'pushState': true
});

H.router = new H.Router();
