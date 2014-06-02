var H = H || {};

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
    childListen: function(event, callback) {
    
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
    getChildViewByElement: function(ele) {
        // _.filter returns an array
        return _.filter(this.children, function(c) {{
            return c.$el.is(ele);
        }})[0];  
    },
    appendChildView: function(childViewData) {
        this.$el.append(childViewData.html);
        H.viewFactory.append(siblingViewData.view, this);
        console.log('appended children');
    },
    removeChild: function() {
    
    },
    appendSiblingView: function(siblingViewData) {
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
    _replaceEle: function(html) {
        this.$el.before(html);
        this.destroy();
    },
    _replaceView: function(viewModule) {
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
    replaceWith: function(viewData) {
        this._replaceEle(viewData.html);
        this._replaceView(viewData.modules);
    },
    showLoading: function() {
        console.log('Loading...'); 
    },
    hideLoading: function() {
        console.log('hide loading');         
    },
    errorNotify: function(msg) {
        console.log(msg);
    }
});

