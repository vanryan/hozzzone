var H = H || {};

H.views = {};

// app
H.views.app = H.View.extend();

// small items
H.views.item = H.View.extend({
    events: {
        'click .like': 'sendLikeButton',
        'click .avatar': 'checkOutAuthor'
    },
    sendLikeButton: function(e) {
        return false;
    },
    checkOutAuthor: function(e) {

        var data = this.data;

        H.router.navigate('user/' + data.authorId, {trigger: true});

        this.showLoading();



        e.preventDefault();
        return false;
    },
});

H.views.likeButton = H.View.extend();

// big viewers
H.views.Items = H.View.extend({
    checkOutPic: function(e) {

        var self = this;

        this.showLoading(); 
    
        var picResource = H.resourceFactory('HozzzAlbum', {fuck: 'you'});

        picResource = picResource.get({
            success: function(responseViewData) {
                self.appendSibling(responseViewData);
            },
            error: function(data) {
                // need a method that replace current whole subview of some view
                // instead of just append views 
                self.replaceEle(data.html);
                self.replaceView(data.view);
            }
        });


        e.preventDefault();
        return false;
    }
});

// use $._data(element, 'events') to check out the events that were attached to the element
// element is dom element not jquery element

// view squareItems inherits from H.views.Items
H.views.squareItems = H.views.Items.extend({
    events: {
        'click .content': 'checkOutPic'
    }
});


// view defaultItems inherits from H.views.Items
H.views.defaultItems = H.views.Items.extend({
    events: {
        'click .front': 'checkOutPic',
        'mouseenter .front': 'dropDownAlbum',
    },
    dropDownAlbum: function(e) {
        var viewEle = $(e.currentTarget).closest('.item');
        if (!$(e.currentTarget).hasClass('seen')) {
            viewEle.addClass('seen');
        }
        // var view = this.findChildViewByElement(viewEle)[0];
    }
});



