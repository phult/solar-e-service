solareApp.controller('SettingController', function ($scope, $rootScope, $http) {
    var self = this;
    $scope.setting = setting;
    $scope.deviceId = deviceId;
    $scope.user = user;
    $scope.message = "";
    this.__proto__ = new BaseController($scope, $rootScope, $http);
    $(document).ready(function () {
    });
    this.initialize = function () {
        this.__proto__.initialize();
    };
    $scope.save = function () {
        console.log(JSON.stringify($scope.setting));
        $scope.message = "Saving...";
        $http.post("/setting/" + $scope.user.api_key + "/" + $scope.deviceId, {
            "setting": JSON.stringify($scope.setting)
        }).success(function (data) {
            if (data.status == "successful") {
                $scope.message = "Save succeeded.";
            } else {
                $scope.message = "Save failed.";
            }
        }).error(function () {
            config.value = config.currentValue;
        });
    };
    this.initialize();
});
