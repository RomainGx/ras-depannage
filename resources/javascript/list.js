(function() {
    'use strict';

    angular
        .module('app.list', [])
        .controller('ListController', ListController);


    ListController.$inject = ['$http', '$resource'];
    function ListController($http, $resource)
    {
        var vm = this;

        this.reports = [];

        loadTickets();

        function loadTickets()
        {
            $resource('home/getReports', {})
                .query()
                .$promise
                .then(function (reports) {
                    vm.reports = reports;
                });
        }
    }
})();