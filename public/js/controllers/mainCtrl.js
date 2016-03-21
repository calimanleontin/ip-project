angular.module('mainCtrl', [])

    .controller('mainController', function($http, $scope, Tag, Comment){

        $scope.tagData = {};
        $scope.commentData = {};

        var href = window.location.href;
        href = href.split('/');
        var number = href.length;
        var company_slug = (href[number-1]);
        var secondVar = (href[number-2]);

        $scope.loading = true;
        if(company_slug == 'edit' && secondVar == 'company')
        {
            Tag.get()
                .success(function(data){
                    $scope.tags = data;
                    $scope.loading = false;
                });
        }
        var routes = ['login', 'register', 'update', 'edit'];

        if(secondVar == 'company' && company_slug in  routes == false )
        {
            Comment.get(company_slug)
                .success(function(data){
                    $scope.comments = data;
                    $scope.loading = false;
                });
        }

        $scope.submitTag = function(){
            $scope.loading = true;

            Tag.assign($scope.tagData)
                .success(function(data){
                    Tag.get()
                        .success(function(getData){
                            $scope.tags = getData;
                            $scope.loading = false;
                        });
                });
        };

        $scope.deleteTag = function(tagId){
            $scope.loading = true;

            Tag.destroy(tagId)
                .success(function(data){
                    Tag.get()
                        .success(function(getData){
                            $scope.tags = getData;
                            $scope.loading = false;
                        });
                });
        };

        $scope.submitComment = function(companyId){
            $scope.loading = true;

            Comment.save($scope.commentData, companyId)
                .success(function(data){
                    Comment.get(company_slug)
                        .success(function(getData){
                            $scope.comments = getData;
                            $scope.loading = false;
                        });
                });
        };

        $scope.deleteComment = function(commentId){
            $scope.loading = true;

            Comment.destroy(commentId)
                .success(function(data){
                    Comment.get(company_slug)
                        .success(function(getData){
                            $scope.comments = getData;
                            $scope.loading = false;
                        });
                });
        };
    });