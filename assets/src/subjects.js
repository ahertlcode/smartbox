//javascript file for subjects using angularjs for data-binding.
var base_api_url = "http://localhost:8085/mathchamp/api/";
var user = local_store({}, "mathchamp-user", "get");
var app = angular.module('subjectsView', []);

app.controller ('subjectsCtrl', function($scope, $http) {

    this.subject = {user:user, id:'', subject:'', moderator:'', dateadded:'', active:''};
    this.update = {col_name:'', col_value:''};

    $scope.subject_save = function() {
        if (this.update == undefined) {
            var pb = {"method":"save", "table":"subjects", "data":this.subject};
            save_subject($scope, $http, pb);
        } else {
            var data = Object.assign(this.subject, this.update);
            var pu = {"method":"update", "table":"subjects", "data":data};
            update_subject($scope, $http, pu);
        }
    };

    $scope.subject_view_single = function(coln, colv){
        show_selected($scope, $http, coln, colv);
    };

    $scope.do_subject_update = function(colname, colvalue){
        $scope.update = {"col_name":colname, "col_value":colvalue};
        show_selected($scope, $http, colname, colvalue);
    };

    $scope.subject_delete = function(coln, colv){
        delete_subject($scope, $http, coln, colv);
    };

    $http({
        url: base_api_url+"subjects_http_api.php",
        method: "POST",
        data:{"method":"view", "table":"subjects"}
    }).then((result) =>{
        $scope.subjects = result.data;
    }, function(error){
        //$scope.berror = error.statusText;
        show_alert(error.statusText, "2000", "danger");
    });

});

function save_subject($scope, $http, pb){
    $http({
        url: base_api_url+"subjects_http_api.php",
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
        url: base_api_url+"subjects_http_api.php",
        method: "POST",
        data:{"method":"view", "table":"subjects", "data":{"col_name":column, "col_value":value}}
    }).then((result) =>{
        $scope.subject = result.data.subject;
    }, function(error){
        //$scope.berror = error.statusText;
        show_alert(error.statusText, "2000", "danger");
    });
}

function update_subject($scope, $http, pb){
    $http({
        url: base_api_url+"subjects_http_api.php",
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

function delete_subject($scope, $http, column, value){
    $http({
        url: base_api_url+"subjects_http_api.php",
        method: "POST",
        data:{"method":"delete", "table":"subjects", "data":{"col_name":column, "col_value":value}}    }).then((result) =>{
        //$scope.berror = result.data.msg;
        show_alert(result.data.msg, "2000", "success");
    }, function(error){
        //$scope.berror = error.statusText;
        show_alert(error.statusText, "2000", "danger");
    });
}

