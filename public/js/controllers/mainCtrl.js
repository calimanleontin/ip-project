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

            Tag.save($scope.tagData)
                .success(function(data){
                    Tag.get()
                        .success(function(getData){
                            $scope.tags = getData;
                            $scope.loading = false;
                        });
                });
        };

        $scope.deleteTag = function(id){
            $scope.loading = true;

            Tag.destroy(id)
                .success(function(data){
                    Tag.get()
                        .success(function(getData){
                            $scope.tags = getData;
                            scope.loading = false;
                        });
                });
        };
    });