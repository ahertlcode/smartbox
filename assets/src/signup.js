//SignUp Javascript file using angularjs for data-binding.
var base_api_url = "http://localhost:8085/educaredb/api/";
var app = angular.module('signUpView', []);

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
