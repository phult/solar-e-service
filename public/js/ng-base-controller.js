function BaseController($scope, $rootScope, $http, io) {
    var self = this;
    this.initialize = function () {
    };
    $scope.getItem = function (list, fieldName, value) {
        var retVal = null;
        list.forEach(function (item) {
            if (item[fieldName] == value) {
                retVal = item;
            }
        });
        return retVal;
    };
    $scope.getFilteredItem = function (list, filter) {
        var retVal = [];
        list.forEach(function (item) {
            for (var variable in filter) {
                if (item.hasOwnProperty(variable) && item[variable] == filter[variable]) {
                    retVal.push(item);
                }
            }
        });
        return retVal;
    };
    $scope.removeItem = function (list, fieldName, value) {
        var retval = false;
        for (var i = 0; i < list.length; i++) {
            if (list[i][fieldName] === value) {
                retval = true;
                list.splice(i, 1);
                break;
            }
        }
        return retval;
    };
    $scope.getCurrentTimeString = function (addMinutes) {
        if (addMinutes == null) {
            addMinutes = 0;
        }
        var date = new Date();
        date = new Date(date.getTime() + addMinutes * 60000);
        return date.getHours() + ":" + date.getMinutes();
    };
    $scope.getCurrentDateString = function () {
        var date = new Date();
        return date.getDate() + "/" + (date.getMonth() + 1) + "/" + date.getFullYear();
    };
    $scope.showLoading = function () {

    };
    $scope.hideLoading = function () {

    };
    $scope.getDate = function (dateString) {
        var retval = "";
        if (dateString != null && dateString !== "" && dateString !== "0000-00-00 00:00:00") {
            var date = new Date(dateString);
            if (date != null) {
                retval = date.getDate() + "/" + (date.getMonth() + 1) + "/" + date.getFullYear();
            }
        }
        return retval;
    }
}
