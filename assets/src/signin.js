//SignUp Javascript file using angularjs for data-binding.
var base_api_url = "http://localhost:8085/mathchamp/api/";
var app = angular.module('signinView', []);

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