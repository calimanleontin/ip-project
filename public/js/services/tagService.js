angular.module('tagService', [])

    .factory('Tag', function ($http){
        return {
            get : function(id){
                if(id == '')
                    return '';
                else
                    return $http.get('/api/tags/' + id);
            },

            assign : function(tagId,companyId){
                return $http.get('/api/tags/assign/' + tagId + '/' + companyId)
            },

            destroy : function(tagId, companyId) {
                return $http.delete('/api/tags/delete/' + tagId + '/' + companyId);
            }
        }
    });