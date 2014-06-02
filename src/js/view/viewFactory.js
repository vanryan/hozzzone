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
    create: function(viewModule) {

        // the parenthesis around 'H.loadViewConstructor(viewModule.name)' is very important!!!

        // console.log(viewModule.name);

        var view = new (H.loadViewConstructor(viewModule.name))({
            // bind this view to the element via 'uid' throught the 'id' attr
            el: $('#' + viewModule.uid),
            options: viewModule.options,
            name: viewModule.name,
            data: viewModule.data
        }); 

        // set current viewer for ease of switch viewers
        // when hit the view layout button on rightBar
        if (/Items$/.test(viewModule.name)) {
            H.currentViewer = view;
        }

        if(viewModule.children) {
            view.children = _.map(viewModule.children, function(item) {
                var childView = H.viewFactory.create(item);
                childView.parent = view;
                view.setChildViewById(childView.cid, childView);
                return [childView.cid, childView];
            });

            view.children = _.object(view.children);

        } else {
            delete view.children;
        }

        return view;
    },
    append: function(viewModule, parentView) {
        var childView = H.viewFactory.create(viewModule);
        parentView.setChildViewById(childView.cid, childView);
    }
};
