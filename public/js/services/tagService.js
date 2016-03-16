angular.module('tagService', [])

    .factory('Tag', function ($http){
        return {
            get : function(id){
                return $http.get('/api/tags/' + id);
            },

            save : function(tagId,companyId){
                return $http.get('/api/tags/assign/' + tagId + '/' + companyId)
            },

            destroy : function(tagId, companyId) {
                return $http.delete('/api/tags/delete/' + tagId + '/' + companyId);
            }
        }
    });