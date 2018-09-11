//javascript file for access using angularjs for data-binding.
var base_api_url = "http://localhost:8085/mathchamp/api/";
var user = local_store({}, "mathchamp-user", "get");
var app = angular.module('accessView', []);

app.controller ('accessCtrl', function($scope, $http) {

    this.acces = {user:user, id:'', asset:'', access:'', dateadded:'', addedby:'', role:''};
    this.update = {col_name:'', col_value:''};

    $scope.acces_save = function() {
        if (this.update == undefined) {
            var pb = {"method":"save", "table":"access", "data":this.acces};
            save_acces($scope, $http, pb);
        } else {
            var data = Object.assign(this.acces, this.update);
            var pu = {"method":"update", "table":"access", "data":data};
            update_acces($scope, $http, pu);
        }
    };

    $scope.acces_view_single = function(coln, colv){
        show_selected($scope, $http, coln, colv);
    };

    $scope.do_acces_update = function(colname, colvalue){
        $scope.update = {"col_name":colname, "col_value":colvalue};
        show_selected($scope, $http, colname, colvalue);
    };

    $scope.acces_delete = function(coln, colv){
        delete_acces($scope, $http, coln, colv);
    };

    $http({
        url: base_api_url+"access_http_api.php",
        method: "POST",
        data:{"method":"view", "table":"access"}
    }).then((result) =>{
        $scope.access = result.data;
    }, function(error){
        //$scope.berror = error.statusText;
        show_alert(error.statusText, "2000", "danger");
    });

});

function save_acces($scope, $http, pb){
    $http({
        url: base_api_url+"access_http_api.php",
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
        url: base_api_url+"access_http_api.php",
        method: "POST",
        data:{"method":"view", "table":"access", "data":{"col_name":column, "col_value":value}}
    }).then((result) =>{
        $scope.acces = result.data.acces;
    }, function(error){
        //$scope.berror = error.statusText;
        show_alert(error.statusText, "2000", "danger");
    });
}

function update_acces($scope, $http, pb){
    $http({
        url: base_api_url+"access_http_api.php",
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

function delete_acces($scope, $http, column, value){
    $http({
        url: base_api_url+"access_http_api.php",
        method: "POST",
        data:{"method":"delete", "table":"access", "data":{"col_name":column, "col_value":value}}    }).then((result) =>{
        //$scope.berror = result.data.msg;
        show_alert(result.data.msg, "2000", "success");
    }, function(error){
        //$scope.berror = error.statusText;
        show_alert(error.statusText, "2000", "danger");
    });
}

