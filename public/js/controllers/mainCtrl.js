angular.module('mainCtrl', [])

    .controller('mainController', function($http, $scope, Tag, Comment){

        $scope.tagData = {};
        $scope.commentData = {};

        var href = window.location.href;
        href = href.split('/');
        var number = href.length;
        var company_slug = (href[number-1]);

        $scope.loading = true;
        Tag.get()
            .success(function(data){
                $scope.tags = data;
                $scope.loading = false;
            });

        Comment.get(company_slug)
            .success(function(data){
            $scope.comments = data;
            $scope.loading = false;
        });

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
    });