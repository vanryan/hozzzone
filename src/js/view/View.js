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
        this.parent.$el.append(siblingViewData.html);
        H.viewFactory.append(siblingViewData.view, this.parent);
        console.log('appended a sibling!!'); 
    },
    // 5.22
    replaceEle: function(html) {
        this.$el.replaceWith(html);
        this.remove();
        this.off();
    },
    replaceView: function(viewModule) {
        this.parent.children.push(H.viewFactory.create(viewModule, this.parent.$el));
    },
    // 5.22
    showLoading: function() {
        console.log('Loading...'); 
    }
});

