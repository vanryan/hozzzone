var H = H || {};

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

