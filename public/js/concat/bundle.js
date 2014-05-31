
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
        this.children = {};

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
        return this.children[name]; 
    },
    setChildViewById: function(name, value) {
        this.children[name] = value;
    },
    findChildViewByElement: function(ele) {
        // _.filter returns an array
        return _.filter(this.children, function(c) {{
            return c.$el.is(ele);
        }});  
    },
    appendChild: function(childViewData) {
        this.$el.append(childViewData.html);
        H.viewFactory.append(siblingViewData.view, this);
        console.log('appended children');
    },
    removeChild: function() {
    
    },
    appendSibling: function(siblingViewData) {
        this.parent.$el.append(siblingViewData.html);
        H.viewFactory.append(siblingViewData.view, this.parent);
        console.log('appended a sibling!!'); 
    },
    destroy: function() {
        // this.remove(); // removes dom element
        _.each(this.children, function(child) {
            child.destroy();
            // recursively destroy children views
        });      

        delete this.parent.children[this.cid];
        this.$el.empty();
        this.remove();

    },
    replaceEle: function(html) {
        this.$el.before(html);
        this.destroy();
    },
    replaceView: function(viewModule) {
        // delete 'this' reference in the children object of parent
        // for garbage collection
        // delete this.parent.children[this.cid];

        var newView = H.viewFactory.create(viewModule);
        newView.parent = this.parent;
        this.parent.setChildViewById(newView.cid, newView);

        this.parent = null;
        delete this.$el;
        delete this.el;
        // still has a little bit of memory leak
        // (detached dom tree 2 entries, 1 object count
        //  <ul class="square View"></ul> )
        // of which the cause cannot be identified

    },
    showLoading: function() {
        console.log('Loading...'); 
    }
});

;/*
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
        var view = new (H.loadViewConstructor(viewModule.name))({
            // bind this view to the element via 'uid' throught the 'id' attr
            el: $('#' + viewModule.uid),
            options: viewModule.options,
            name: viewModule.name,
            data: viewModule.data
        }); 

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
            // console.log(err);
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
                    var test_json = {
                        html: '<ul class="default" id="defaultItems-1"> <li class="item" id="item-1"> <div class="avatar"> <img src="../src/img/a.png" alt=""> <span class="name">client</span> </div> <div class="content"> <div class="front"> <div> <a href="" class="calbum"><img src="../src/img/img1.png" alt=""></a> </div> <div> <span class="title">男士 手提包 时尚元素</span><br> <a class="like" id="button-1"  href="#"><span>1054</span></a> </div> </div> <div class="peek"> <div class="sub-item"><a href=""><img src="" alt=""></a></div> </div> </div> </li> <li class="item" id="item-2"> <div class="avatar"> <img src="../src/img/a.png" alt=""> <span class="name">client</span> </div> <div class="content"> <div class="front"> <div> <a href="" class="calbum"><img src="../src/img/img1.png" alt=""></a> </div> <div> <span class="title">男士 手提包 时尚元素</span><br> <a class="like" id="button-2"  href="#"><span>1054</span></a> </div> </div> <div class="peek"> <div class="sub-item"><a href=""><img src="" alt=""></a></div> </div> </div> </li> <li class="item" id="item-3"> <div class="avatar"> <img src="../src/img/a.png" alt=""> <span class="name">client</span> </div> <div class="content"> <div class="front"> <div> <a href="" class="calbum"><img src="../src/img/img1.png" alt=""></a> </div> <div> <span class="title">男士 手提包 时尚元素</span><br> <a class="like" id="button-3"  href="#"><span>1054</span></a> </div> </div> <div class="peek"> <div class="sub-item"><a href=""><img src="" alt=""></a></div> </div> </div> </li> </ul>',
                        view: {
                            uid: 'defaultItems-1',
                            name: 'defaultItems',
                            attrs: {
                                className: 'default'
                            },
                            data: {
                                createdAt: '20140515092039'
                            },
                            children: [
                                {
                                    uid: 'item-1',
                                    name: 'item',
                                    attrs: {
                                        className: 'item'
                                    },
                                    children: [
                                        {
                                            uid: 'button-1',
                                            name: 'likeButton',
                                            likeId: '82942934294',
                                            attrs: {
                                                className: 'like'
                                            }
                                        }   
                                    ],
                                    data: {
                                        itemId: '239879342089304582304',
                                        author: 'Brian Long',
                                        time: '201405161129',
                                        like: '1548'
                                    }
                                },
                                {
                                    uid: 'item-2',
                                    name: 'item',
                                    attrs: {
                                        className: 'item'
                                    },
                                    data: {
                                        itemId: '304582304',
                                        author: 'B Long',
                                        time: '20105161129',
                                        like: '148'
                                    },
                                    children: [
                                        {
                                            uid: 'button-2',
                                            name: 'likeButton',
                                            likeId: '908203842042',
                                            attrs: {
                                                className: 'like'
                                            }
                                        }   
                                    ]
                                },
                                {
                                    uid: 'item-3',
                                    name: 'item',
                                    attrs: {
                                        className: 'item'
                                    },
                                    children: [
                                        {
                                            uid: 'button-3',
                                            name: 'likeButton',
                                            likeId: '294829304242',
                                            attrs: {
                                                className: 'like'
                                            }
                                        }   
                                    ],
                                    data: {
                                        itemId: '2398',
                                        author: 'Brian asdfasLong',
                                        time: '201405161129',
                                        like: '154'
                                    }
                                }
                            ]
                        }
                    };
                    // return void defer.reject('error, fuck!');
                     return void defer.reject(test_json);
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
;var H = H || {};


H.views.Navigate = H.View.extend();
;var H = H || {};

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
;
var H = H || {};

H.init = function(initJson) {
    H.app = H.viewFactory.create(initJson.modules);   
};

