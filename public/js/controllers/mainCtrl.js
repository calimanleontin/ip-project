angular.module('mainCtrl', [])

    .controller('mainController', function($http, $scope, Tag){

        $scope.tagData = {};

        $scope.loading = true;
        Tag.get()
            .success(function(data){
                $scope.tags = data;
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