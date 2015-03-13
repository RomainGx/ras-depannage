(function() {
    'use strict';

    angular
        .module('app', [
            // Angular dependencies
            'ngRoute',
            'ngTouch',
            'ngResource',
            'ngSanitize',

            // Custom dependencies
            'app.form',
            'app.detail',
            'app.success',
            'app.list',

            // 3rd party dependencies
            'duScroll'
        ]);
})();