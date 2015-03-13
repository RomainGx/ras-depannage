(function() {
    'use strict';

    angular
        .module('app.form', [])
        .controller('FormController', FormController);


    FormController.$inject = ['$http', '$location', '$document'];
    function FormController($http, $location, $document)
    {
        var vm = this;
        var now = new Date();

        this.error = {
            msg: null
        };
        this.data = {
            dateBegin: now.toLocaleFormat('%d/%m/%Y'),
            dateEnd: now.toLocaleFormat('%d/%m/%Y'),
            timeEnding: now.toLocaleFormat('%H:%M'),
            signatures: {
                tech: false,
                client: false
            }
        };
        this.save = save;
        this.canSave = canSave;
        this.setClientSigned = setClientSigned;
        this.setTechSigned = setTechSigned;

        $('#techSign, #clientSign').jSignature({'UndoButton':true});


        function save()
        {
            vm.data.signatures.tech = $('#techSign').jSignature('getData', 'image');
            vm.data.signatures.client = $('#clientSign').jSignature('getData', 'image');


            var headers = {
                'Content-Type': 'application/x-www-form-urlencoded'
            };

            return $http
                .post('/FichesDepannage/home/saveReport', vm.data, {})
                .success(function (data) {
                    if (data.status == 'success')
                        $location.path('/success');
                    else
                    {
                        vm.error.msg = data.error;
                        $document.scrollTopAnimated(0, 700);
                    }
                })
                .error(function () {
                    vm.error.msg = 'Une erreur s\'est produite lors de la sauvegarde du rapport.';
                    $document.scrollTopAnimated(0, 700);
                });
        }

        function canSave()
        {
            return vm.data.dateBegin && vm.data.dateEnd && vm.data.timeBegin && vm.data.timeEnding &&
                vm.data.client && vm.data.clientMail && vm.data.report && vm.data.signatures.tech &&
                vm.data.signatures.client;
        }

        function setClientSigned()
        {
            vm.data.signatures.client = true;
        }

        function setTechSigned()
        {
            vm.data.signatures.tech = true;
        }
    }
})();