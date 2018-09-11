//javascript file for setup using angularjs for data-binding.
var base_api_url = "http://localhost:8085/mathchamp/api/";
var user = local_store({}, "mathchamp-user", "get");
var app = angular.module('setupView', []);

app.controller ('setupCtrl', function($scope, $http) {

    this.setup = {user:user, id:'', quiz_time:'', number_of_questions:'', min_win_score:'', mode:''};
    this.update = {col_name:'', col_value:''};

    $scope.setup_save = function() {
        if (this.update == undefined) {
            var pb = {"method":"save", "table":"setup", "data":this.setup};
            save_setup($scope, $http, pb);
        } else {
            var data = Object.assign(this.setup, this.update);
            var pu = {"method":"update", "table":"setup", "data":data};
            update_setup($scope, $http, pu);
        }
    };

    $scope.setup_view_single = function(coln, colv){
        show_selected($scope, $http, coln, colv);
    };

    $scope.do_setup_update = function(colname, colvalue){
        $scope.update = {"col_name":colname, "col_value":colvalue};
        show_selected($scope, $http, colname, colvalue);
    };

    $scope.setup_delete = function(coln, colv){
        delete_setup($scope, $http, coln, colv);
    };

    $http({
        url: base_api_url+"setup_http_api.php",
        method: "POST",
        data:{"method":"view", "table":"setup"}
    }).then((result) =>{
        $scope.setup = result.data;
    }, function(error){
        //$scope.berror = error.statusText;
        show_alert(error.statusText, "2000", "danger");
    });

});

function save_setup($scope, $http, pb){
    $http({
        url: base_api_url+"setup_http_api.php",
        method: "POST",
        data:pb
    }).then((result) =>{
        //$scope.berror = result.data.msg;
        show_alert(result.data.msg, "2000", "success");
    }, function(error){
        //$scope.berror = error.statusText;
        show_alert(error.statusText, "2000", "danger");
    });
}

function show_selected($scope, $http, column, value){
    $http({
        url: base_api_url+"setup_http_api.php",
        method: "POST",
        data:{"method":"view", "table":"setup", "data":{"col_name":column, "col_value":value}}
    }).then((result) =>{
        $scope.setup = result.data.setup;
    }, function(error){
        //$scope.berror = error.statusText;
        show_alert(error.statusText, "2000", "danger");
    });
}

function update_setup($scope, $http, pb){
    $http({
        url: base_api_url+"setup_http_api.php",
        method: "POST",
        data:pb
    }).then((result) =>{
        //$scope.berror = result.data.msg;
        show_alert(result.data.msg, "2000", "success");
    }, function(error){
        //$scope.berror = error.statusText;
        show_alert(error.statusText, "2000", "danger");
    });
}

function delete_setup($scope, $http, column, value){
    $http({
        url: base_api_url+"setup_http_api.php",
        method: "POST",
        data:{"method":"delete", "table":"setup", "data":{"col_name":column, "col_value":value}}    }).then((result) =>{
        //$scope.berror = result.data.msg;
        show_alert(result.data.msg, "2000", "success");
    }, function(error){
        //$scope.berror = error.statusText;
        show_alert(error.statusText, "2000", "danger");
    });
}

