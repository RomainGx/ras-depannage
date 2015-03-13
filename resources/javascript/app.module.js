(function() {
    'use strict';

    angular
        .module('app', [
            // Angular dependencies
            'ngRoute',
            'ngTouch',
            'ngResource',

            // Custom dependencies
            'app.form',
            'app.success',
            'app.list',

            // 3rd party dependencies
            'duScroll'
        ]);
})();