(function() {
    'use strict';

    angular
        .module('app.detail', [])
        .controller('DetailController', DetailController);


    DetailController.$inject = ['$resource', '$routeParams'];
    function DetailController($resource, $routeParams)
    {
        var vm = this;

        this.report = {};

        $resource('home/getReport/:id', { id: '@id' })
            .get({ id: $routeParams.id })
            .$promise
            .then(function (report) {
                vm.report = report;
            });
    }
})();