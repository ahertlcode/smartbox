//javascript file for schools using angularjs for data-binding.
var base_api_url = "http://localhost:8085/mathchamp/api/";
var user = local_store({}, "mathchamp-user", "get");
var app = angular.module('schoolsView', []);

app.controller ('schoolsCtrl', function($scope, $http) {

    this.school = {user:user, id:'', name:'', address:'', cutoff:'', adrule:'', dateadded:'', status:''};
    this.update = {col_name:'', col_value:''};

    $scope.school_save = function() {
        if (this.update == undefined) {
            var pb = {"method":"save", "table":"schools", "data":this.school};
            save_school($scope, $http, pb);
        } else {
            var data = Object.assign(this.school, this.update);
            var pu = {"method":"update", "table":"schools", "data":data};
            update_school($scope, $http, pu);
        }
    };

    $scope.school_view_single = function(coln, colv){
        show_selected($scope, $http, coln, colv);
    };

    $scope.do_school_update = function(colname, colvalue){
        $scope.update = {"col_name":colname, "col_value":colvalue};
        show_selected($scope, $http, colname, colvalue);
    };

    $scope.school_delete = function(coln, colv){
        delete_school($scope, $http, coln, colv);
    };

    $http({
        url: base_api_url+"schools_http_api.php",
        method: "POST",
        data:{"method":"view", "table":"schools"}
    }).then((result) =>{
        $scope.schools = result.data;
    }, function(error){
        //$scope.berror = error.statusText;
        show_alert(error.statusText, "2000", "danger");
    });

});

function save_school($scope, $http, pb){
    $http({
        url: base_api_url+"schools_http_api.php",
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
        url: base_api_url+"schools_http_api.php",
        method: "POST",
        data:{"method":"view", "table":"schools", "data":{"col_name":column, "col_value":value}}
    }).then((result) =>{
        $scope.school = result.data.school;
    }, function(error){
        //$scope.berror = error.statusText;
        show_alert(error.statusText, "2000", "danger");
    });
}

function update_school($scope, $http, pb){
    $http({
        url: base_api_url+"schools_http_api.php",
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

function delete_school($scope, $http, column, value){
    $http({
        url: base_api_url+"schools_http_api.php",
        method: "POST",
        data:{"method":"delete", "table":"schools", "data":{"col_name":column, "col_value":value}}    }).then((result) =>{
        //$scope.berror = result.data.msg;
        show_alert(result.data.msg, "2000", "success");
    }, function(error){
        //$scope.berror = error.statusText;
        show_alert(error.statusText, "2000", "danger");
    });
}

