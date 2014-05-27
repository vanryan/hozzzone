var H = H || {};


H.views.layoutButton = H.View.extend();

H.views.rightBar = H.View.extend();

H.views.viewLayout = H.View.extend({
    events: {
        'click li': 'changeViewLayout',
    },
    changeViewLayout: function(e) {
        var view = this.findChildViewByElement($(e.currentTarget))[0];
        console.log('change to view: ' + view.data.view);


        return false;
    }
});

H.views.searchBox = H.View.extend({
    events: {
        'focus .search-text': 'widenInputBox',
        'blur .search-text': 'shortenInputBox',
        'click .search-img': 'search'
    },
    widenInputBox: function(e) {
        $(e.currentTarget).animate({
            'width': 150
        });
    },
    shortenInputBox: function(e) {
        $(e.currentTarget).animate({
            'width': 70
        });
    },
    search: function(e) {
        console.log('fuck, you just searched'); 
    }
});
