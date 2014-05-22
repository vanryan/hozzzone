var H = H || {};




// for unique buttons
H.views.Button = H.View.extend({
    events: {
        'click': 'onClick'
    }
});


H.views.addHoz = H.views.Button.extend({
    onClick: function() {
        console.log('add'); 
    }
});

H.views.backToTop = H.views.Button.extend({
    onClick: function() {
        console.log('back to top');
        return false;
    }
});
