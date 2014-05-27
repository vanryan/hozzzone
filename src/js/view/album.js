var H = H || {};

H.views.Album = H.View.extend({

});


H.views.subscribeBtn = H.views.Button.extend({
    onClick: function() {
        console.log('subscribed!!!');
        return false;
    }
});


H.views.commentBtn = H.views.Button.extend({
    onClick: function() {
        console.log('just commented!!!');
        return false;
    }
});


H.views.commentReplyBtn = H.views.Button.extend({
    onClick: function() {
        console.log('replied!!');
    }
});
