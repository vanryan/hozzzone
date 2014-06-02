var H = H || {};

H.Resource = function(name, data) {
    this.name = name;
    this.data = JSON.stringify(data);
};


// use the Underscore _.extend to make the code more readable
_.extend(H.Resource.prototype, {
    call: function(method, callbacks) {
        var promise = this._call(method);

        // customized success callback
        if(callbacks && callbacks.success) {
            promise.done(callbacks.success);
        }

        // customized fail callback
        if(callbacks && callbacks.error) {
            promise.fail(callbacks.error);
        }

        // customized always callback
        if(callbacks && callbacks.complete) {
            // whatever success or eroors, always excecute
            promise.always(callbacks.complete);
        }

        // default fail callback
        promise.fail(function(err) {

            // how to send get ajax to be evaluated as error
            // and also send client json 
            // that includes this 'msg' property
            H.View.prototype.hideLoading();
            H.View.prototype.errorNotify(err);

        });

        // default success callback
        promise.done(function() {
            H.View.prototype.hideLoading();
        });

        return promise;
        // still returns a promise
        // for chaining more 'done, then, fail' kind of method
    },
    _call: function(method) {
        var defer = new $.Deferred(),
            // e.g /resource/hozzz/get
            // I don't know what the hell is going here 
            // If I keep the trailing slash, server side will keeps shouting 301 back
            // and redirect me to some other url
            // It may be a bug or something not that I know of
            // Get the idea from:
            // http://stackoverflow.com/questions/18934588/json-giving-301-moved-permanently
            requestURL = '/hozzzone/public/resources/' + this.name + '/' + method,
            data = {
          //      from: window.location.pathname,
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
                     return void defer.reject('error, connection failed!');
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

