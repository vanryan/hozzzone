
var H = H || {};


H.User = Backbone.Model.extend({
    isAuth: function() {
        return !!this.get('id');
    },
    login: function() {

    },
    logout: function() {
    
    }
});
