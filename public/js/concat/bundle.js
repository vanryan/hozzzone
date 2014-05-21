
var H = H || {};


H.User = Backbone.Model.extend({
    isAuth: function() {
        return !!this.get('id');
    },
    login: function() {

    },
    logout: function() {
    
    }
});
;
var H = H || {};

H.Router = Backbone.Router.extend({
    routes: {
        'album/:id': 'checkOutAlbum',
        'user/:id': 'checkOutUser',
    }, 
    checkOutAlbum: function(id) {
        console.log(id); 
    },
    checkOutUser: function(id) {
        console.log(id);
    }
});

Backbone.history.start({
    'pushState': true
});

H.router = new H.Router();
;var H = H || {};

H.View = Backbone.View.extend({
    className: 'View',
    // called in the View.constructor with arguments passed into constructor
    initialize: function(prop) {
        if(prop) {
            if(prop.options) {
                this.options = prop.options; 
            }
            if(prop.name) {
                this.name = prop.name;
            } else {
                this.name = '';
            }
            if(prop.data) {
                this.data = prop.data;
            }
        }

        this.$el.addClass(this.className);
        this._childViewIdMappings = {};

        // delete the id attr
        // in case get so many ids in the document
        // but still keep the bind between this view and this element
        this.$el.removeAttr('id');

    },
    size: function() {
        // get the size of its children
        return this.children.length;
    },
    childAt: function(idx) {
        // get child view at index
        return this.children[idx];
    },
    getChildViewById: function(name) {
        return this._childViewIdMappings[name]; 
    },
    setChildViewById: function(name, value) {
        this._childViewIdMappings[name] = value;
    },
    findChildViewByElement: function(ele) {
        // _.filter returns an array
        return _.filter(this.children, function(c) {{
            return c.$el.is(ele);
        }});  
    },
    destory: function() {
    
    },
    remove: function() {
    
    },
    detachAllEvents: function() {
    
    },
    appendChild: function(childViewData) {
        this.$el.append(childViewData.html);
        H.viewFactory.append(siblingViewData.view, this);
        console.log('appended children');
    },
    removeChild: function() {
    
    },
    appendSibling: function(siblingViewData) {
        this.parent.$el.append(siblingViewData.html)
        H.viewFactory.append(siblingViewData.view, this.parent);
        console.log('appended a sibling!!'); 
    },
    showLoading: function() {
        console.log('Loading...'); 
    }
});

;var H = H || {};

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
;var H = H || {};

H.Resource = function(name, data) {
    this.name = name;
    this.data = JSON.stringify(data);
};


// use the Underscore _.extend to make the code more readable
_.extend(H.Resource.prototype, {
    call: function(method, callbacks) {
        var promise = this._call(method);

        promise.fail(function(err) {
            console.log(err);
        });

        if(callbacks && callbacks.success) {
            promise.done(callbacks.success);
        }

        if(callbacks && callbacks.error) {
            promise.fail(callbacks.error);
        }

        if(callbacks && callbacks.complete) {
            // whatever success or eroors, always excecute
            promise.always(callbacks.complete);
        }
        return promise;
        // still returns a promise
        // for chaining more 'done, then, fail' kind of method
    },
    _call: function(method) {
        var defer = new $.Deferred(),
            // e.g /resource/hozzz/get/
            requestURL = '/resource/' + this.name + '/' + method + '/',
            data = {
                from: window.location.pathname,
                data: this.data
            }; 

        $.ajax({
            cache: false,
            url: requestURL,
            data: data,
            dataType: 'json',
            type: method,
            complete: function(jqXHR, textStatus) {
                if(textStatus === 'abort') {
                    // the void word is useful as it makes the expr undefineable
                    // and still excute the expr that follows behind
                    return void defer.reject('aborted'); 
                }

                if(textStatus === 'error') {
                    return void defer.reject('error, fuck!');
                }

                var responseData = JSON.parse(jqXHR.responseText);

                defer.resolve(responseData);
                // resolve the promise with responseData
            } 
        });

        return defer.promise();
    },
    get: function(callbacks) {
        return this.call('get', callbacks);
        // returns a promise
    },
    post: function(callbacks) {
        return this.call('post', callbacks);
    }

});


H.resourceFactory = function(name, data) {
    return new H.Resource(name, data);
};

;var H = H || {};

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
        console.log(e.currentTarget === this);
        console.log($(e.currentTarget).html());
        console.log(this.data.like + ' ' + this.data.itemId);
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
        
        console.log($(e.currentTarget).html());
        this.showLoading(); 
    
        var picResource = H.resourceFactory('HozzzAlbum', {fuck: 'you'});

        picResource = picResource.get({
            success: function(responseViewData) {
                self.appendSibling(responseViewData);
                console.log(self); 
            },
            error: function(err) {
                console.log('notify errors');
            }
        });

        console.log(picResource);

        e.preventDefault();
        return false;
    }
});

// use $._data(element, 'events') to check out the events that were attached to the element
// element is dom element not jquery element

// view squareItems inherits from H.views.Items
H.views.squareItems = H.views.Items.extend({
    events: {
        'click .img-overlay': 'checkOutPic'
    }
});


// view defaultItems inherits from H.views.Items
H.views.defaultItems = H.views.Items.extend({
    events: {
        'click .front': 'checkOutPic',
        'mouseenter .front': 'dropDownAlbum'
    },
    dropDownAlbum: function(e) {
        var viewEle = $(e.currentTarget).closest('.item');
        var view = this.findChildViewByElement(viewEle)[0];
        console.log('drop down');
        console.log(view.data.author);
    }
});



;var H = H || {};




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
;var H = H || {};


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

;
var H = H || {};

H.init = function(initJson) {
    H.app = H.viewFactory.create(initJson.modules);   
};

