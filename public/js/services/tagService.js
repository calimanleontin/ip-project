angular.module('tagService', [])

    .factory('Tag', function ($http){
        return {
            get : function(){
                return $http.get('/api/tags');
            },

            save : function(tagId,companyId){
                return $http.get('/api/tags/assign/' + tagId + '/' + companyId)
            },

            destroy : function(id) {
                return $http.delete('/api/tags/delete/' + id);
            }
        }
    });