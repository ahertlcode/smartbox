var app = angular.module('mainPage', []);
user = local_store({}, "mathchamp-user", "get");
app.controller("mainCtrl", function($filter, $scope, $http){
    $scope.user = user;
    $scope.logout = function(){
        local_store({}, "mathchamp-user", "remove");
        setInterval("gohome();", 500);
    };
});

app.controller ('signinCtrl',  function($scope, $http) {
    this.user = {username:'', password:''};

    $scope.signin = function() {
        var param = {"method":"signin", "table":"users", "data":this.user};
        $http({
            url:base_api_url+"users_http_api.php",
            method: "POST",
            data:param
        }).then((result) => {
            local_store(result.data, "mathchamp-user", "add");
            notify(result.data.msg, 'success', "2000");
            (result.data.user.role == 'Standard-User') ? setInterval("gohome();", 2000) : setInterval("goportal();", 2000);
        }, function(error) {
            notify(error.statusText, "danger", "2000");
        });
    };
});

app.controller ('signUpCtrl', function($filter, $scope, $http) {
    this.user = {username:'', name:'', mobile_phone:'', email:'', role:'', password:'', cpassword:'', date_registered:''};
    $scope.deful = function(){
        $scope.user = {role:'Standard-User', date_registered:$filter('date')(new Date(),'yyyy-MM-dd hh:mm:ss')};
    }
    $scope.signup = function() {
        var param = {"method":"save", "table":"users", "data":this.user};
        $http({
            url:base_api_url+"users_http_api.php",
            method: "POST",
            data:param
        }).then((result) => {
            notify(result.data.msg, "success", 2000);
        }, function(error) {
            notify(error.statusText, "danger", 2000);
        });
    };
});