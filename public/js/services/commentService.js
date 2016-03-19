angular.module('commentService', [])

    .factory('Comment', function ($http){
        return {

            get : function(company_slug){
                return $http.get('/api/comments/' + company_slug    );
            },

            save : function(commentData, company_id){
                return $http({
                    method      : 'POST',
                    url         : '/api/comments/save/' + company_id,
                    data        : $.param(commentData),
                    headers : {'Content-Type' : 'application/x-www-form-urlencoded'}
                });
            },

            destroy : function(commentId){
                return $http.get('/api/comments/delete/' + commentId);
            }
        };
    });