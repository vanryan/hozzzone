var H = H || {};


H.views.layoutButton = H.View.extend();

H.views.rightBar = H.View.extend();

H.views.viewLayout = H.View.extend({
    events: {
        'click li:not(.active)': 'changeViewLayout',
    },
    changeViewLayout: function(e) {
        var view = this.getChildViewByElement($(e.currentTarget));
        console.log('change to view: ' + view.data.view);

        var newViewer = H.resourceFactory(view.data.view + 'Items', {});

        newViewer.get({
            success: function(responseViewData) {
                console.log(responseViewData); 
                H.currentViewer.replaceWith(responseViewData);
            }
        });
    }
});

H.views.searchForm = H.View.extend({
    events: {
        'focus .search-text': 'widenInputBox',
        'blur .search-text': 'shortenInputBox',
        'submit': 'onSubmit'
    },
    onSubmit: function(e) {
        console.log('you just submitted!'); 
        return false;
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
    }
});

