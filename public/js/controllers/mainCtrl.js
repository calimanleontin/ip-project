angular.module('mainCtrl', [])

    .controller('mainController', function($http, $scope, Tag){

        $scope.tagData = {};

        $scope.loading = true;

        var href = window.location.href;
        href = href.split('/');
        var number = href.length;
        var id = (href[number-1]);

        Tag.get(id)
            .success(function(data){
                $scope.tags = data;
                $scope.loading = false;
            });

        $scope.submitTag = function(tagId, companyId){
            $scope.loading = true;

            Tag.assign(tagId, companyId)
                .success(function(data){
                    Tag.get(id)
                        .success(function(getData){
                            if(getData == '')
                                $scope.loading = false;
                            else
                            {
                                $scope.tags = getData;
                                $scope.loading = false;
                            }
                        });
                });
        };

        $scope.deleteTag = function(tagId, companyId){
            $scope.loading = true;

            Tag.destroy(tagId, companyId)
                .success(function(data){
                    Tag.get(id)
                        .success(function(getData){
                            if(getData == '')
                                $scope.loading = false;
                            else
                            {
                                $scope.tags = getData;
                                $scope.loading = false;
                            }
                        });
                });
        };
    });