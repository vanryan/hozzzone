/*
 * view json init:
 *
 * uid
 * name
 * data
 * options
 *
 *
 *
 */



var H = H || {};

H.loadViewConstructor = function(viewName) {
    return H.views[viewName]; 
};


// create views
H.viewFactory = {
    create: function(viewModule, parentEle) {

        parentEle = parentEle || null;

        // the parenthesis around 'H.loadViewConstructor(viewModule.name)' is very important!!!
        var view = new (H.loadViewConstructor(viewModule.name))({
            // bind this view to the element via 'uid' throught the 'id' attr
            el: $('#' + viewModule.uid, parentEle),
            options: viewModule.options,
            name: viewModule.name,
            data: viewModule.data
        }); 

        if(viewModule.children) {
            view.children = _.map(viewModule.children, function(item) {
                var childView = H.viewFactory.create(item, view.$el);
                childView.parent = view;
                view.setChildViewById(childView.cid, childView);
                return childView;
            });
        }

        return view;
    },
    append: function(viewModule, parentView) {
        parentView.children.push(H.viewFactory.create(viewModule, parentView.$el));
    }
};
