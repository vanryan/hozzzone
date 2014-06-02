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

        var target = $(e.currentTarget),
            itemEle;

        if (target.hasClass('content')) {
            itemEle = target.closest('.item');
        }

        var self = this;

        self.showLoading(); 


        var itemView = this.getChildViewByElement(itemEle);
        
        var picResource = H.resourceFactory('album', {albumId: itemView.albumId});

        picResource = picResource.get({
            success: function(responseViewData) {
                self.appendSiblingView(responseViewData);
                // self.replaceWith(responseViewData);
            }
        });

        e.preventDefault();
        e.stopPropagation();
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
        'click .content': 'checkOutPic',
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



