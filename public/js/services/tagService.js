angular.module('tagService', [])

    .factory('Tag', function ($http){
        return {
            get : function(){
                return $http.get('/api/tags');
            },

            save : function(tagData){
                return $http({
                    method  :   'POST',
                    url     :   '/api/tags/save',
                    data    : $.param(tagData),
                    headers : {'Content-Type' : 'application/x-www-form-urlencoded'}
                });
            },

            destroy : function(id) {
                return $http.delete('/api/tags/delete/' + id);
            }
        }
    });