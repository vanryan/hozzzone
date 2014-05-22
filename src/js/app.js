
var H = H || {};

H.init = function(initJson) {
    H.app = H.viewFactory.create(initJson.modules);   
};

