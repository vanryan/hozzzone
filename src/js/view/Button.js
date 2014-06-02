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

        $('body').animate({scrollTop: 0}, {
            duration: 350,
            complete: function() {
                console.log('fuck you');
            }
        });

        return false;
    }
});
