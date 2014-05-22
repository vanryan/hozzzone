var H = H || {};


H.views.layoutButton = H.View.extend();

H.views.rightBar = H.View.extend();

H.views.viewLayout = H.View.extend({
    events: {
        'click li': 'changeViewLayout'
    },
    changeViewLayout: function(e) {
        var view = this.findChildViewByElement($(e.currentTarget))[0];
        console.log('change to view: ' + view.data.view);


        return false;
    }
});

