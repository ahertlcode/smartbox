//javascript file for exam_types using angularjs for data-binding.
var base_api_url = "http://localhost:8085/mathchamp/api/";
var user = local_store({}, "mathchamp-user", "get");
var app = angular.module('exam_typesView', []);

app.controller ('exam_typesCtrl', function($scope, $http) {

    this.exam_type = {user:user, id:'', name:'', logo:'', dateadded:'', active:''};
    this.update = {col_name:'', col_value:''};

    $scope.exam_type_save = function() {
        if (this.update == undefined) {
            var pb = {"method":"save", "table":"exam_types", "data":this.exam_type};
            save_exam_type($scope, $http, pb);
            uploadFile();
        } else {
            var data = Object.assign(this.exam_type, this.update);
            var pu = {"method":"update", "table":"exam_types", "data":data};
            update_exam_type($scope, $http, pu);
            uploadFile();
        }
    };

    $scope.exam_type_view_single = function(coln, colv){
        show_selected($scope, $http, coln, colv);
    };

    $scope.do_exam_type_update = function(colname, colvalue){
        $scope.update = {"col_name":colname, "col_value":colvalue};
        show_selected($scope, $http, colname, colvalue);
    };

    $scope.exam_type_delete = function(coln, colv){
        delete_exam_type($scope, $http, coln, colv);
    };

    $scope.placelogo = function (obj){
        var fil = obj.value.replace("C:\\fakepath\\", "");
        $scope.exam_type = {"logo": fil};
        alert($("#dlogo").val());
    };

    $http({
        url: base_api_url+"exam_types_http_api.php",
        method: "POST",
        data:{"method":"view", "table":"exam_types"}
    }).then((result) =>{
        $scope.exam_types = result.data;
    }, function(error){
        //$scope.berror = error.statusText;
        show_alert(error.statusText, "2000", "danger");
    });

});

function save_exam_type($scope, $http, pb){
    $http({
        url: base_api_url+"exam_types_http_api.php",
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
        url: base_api_url+"exam_types_http_api.php",
        method: "POST",
        data:{"method":"view", "table":"exam_types", "data":{"col_name":column, "col_value":value}}
    }).then((result) =>{
        $scope.exam_type = result.data.exam_type;
    }, function(error){
        //$scope.berror = error.statusText;
        show_alert(error.statusText, "2000", "danger");
    });
}

function update_exam_type($scope, $http, pb){
    $http({
        url: base_api_url+"exam_types_http_api.php",
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

function delete_exam_type($scope, $http, column, value){
    $http({
        url: base_api_url+"exam_types_http_api.php",
        method: "POST",
        data:{"method":"delete", "table":"exam_types", "data":{"col_name":column, "col_value":value}}    }).then((result) =>{
        //$scope.berror = result.data.msg;
        show_alert(result.data.msg, "2000", "success");
    }, function(error){
        //$scope.berror = error.statusText;
        show_alert(error.statusText, "2000", "danger");
    });
}