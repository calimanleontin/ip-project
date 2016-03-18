angular.module('tagService', [])

    .factory('Tag', function ($http){
        return {
            get : function(){
                return $http.get('/api/tags/');
            },

            assign : function(tagData){
                return $http({
                    method  :   'POST',
                    url     :   '/api/tags/assign',
                    data    : $.param(tagData),
                    headers : {'Content-Type' : 'application/x-www-form-urlencoded'}

                });
            },

            destroy : function(tagId) {
                return $http.get('/api/tags/delete/' + tagId );
            }
        }
    });