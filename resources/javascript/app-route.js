(function() {
    'use strict';

    angular
        .module('app')
        .config(config);

    config.$inject = ['$routeProvider'];
    function config($routeProvider)
    {
        $routeProvider
            .when('/newReport', { templateUrl: 'resources/partials/form.html', controller: 'FormController', controllerAs: 'FormCtrl' })
            .when('/listReports', { templateUrl: 'resources/partials/list.html', controller: 'ListController', controllerAs: 'ListCtrl' })
            .when('/success', { templateUrl: 'resources/partials/success.html', controller: 'SuccessController', controllerAs: 'SuccessCtrl' })
            .otherwise({ redirectTo: '/newReport' });
    }
})();