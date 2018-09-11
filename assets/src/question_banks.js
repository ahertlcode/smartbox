//javascript file for question_banks using angularjs for data-binding.
var base_api_url = "http://localhost:8085/mathchamp/api/";
var user = local_store({}, "mathchamp-user", "get");
var app = angular.module('question_banksView', []);

app.controller ('question_banksCtrl', function($scope, $http) {

    this.question_bank = {user:user, id:'', question:'', answer:'', status:'', exam_id:'', school_id:''};
    this.update = {col_name:'', col_value:''};

    $scope.question_bank_save = function() {
        if (this.update == undefined) {
            var pb = {"method":"save", "table":"question_banks", "data":this.question_bank};
            save_question_bank($scope, $http, pb);
        } else {
            var data = Object.assign(this.question_bank, this.update);
            var pu = {"method":"update", "table":"question_banks", "data":data};
            update_question_bank($scope, $http, pu);
        }
    };

    $scope.question_bank_view_single = function(coln, colv){
        show_selected($scope, $http, coln, colv);
    };

    $scope.do_question_bank_update = function(colname, colvalue){
        $scope.update = {"col_name":colname, "col_value":colvalue};
        show_selected($scope, $http, colname, colvalue);
    };

    $scope.question_bank_delete = function(coln, colv){
        delete_question_bank($scope, $http, coln, colv);
    };

    $http({
        url: base_api_url+"question_banks_http_api.php",
        method: "POST",
        data:{"method":"view", "table":"question_banks"}
    }).then((result) =>{
        $scope.question_banks = result.data;
    }, function(error){
        //$scope.berror = error.statusText;
        show_alert(error.statusText, "2000", "danger");
    });

});

function save_question_bank($scope, $http, pb){
    $http({
        url: base_api_url+"question_banks_http_api.php",
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
        url: base_api_url+"question_banks_http_api.php",
        method: "POST",
        data:{"method":"view", "table":"question_banks", "data":{"col_name":column, "col_value":value}}
    }).then((result) =>{
        $scope.question_bank = result.data.question_bank;
    }, function(error){
        //$scope.berror = error.statusText;
        show_alert(error.statusText, "2000", "danger");
    });
}

function update_question_bank($scope, $http, pb){
    $http({
        url: base_api_url+"question_banks_http_api.php",
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

function delete_question_bank($scope, $http, column, value){
    $http({
        url: base_api_url+"question_banks_http_api.php",
        method: "POST",
        data:{"method":"delete", "table":"question_banks", "data":{"col_name":column, "col_value":value}}    }).then((result) =>{
        //$scope.berror = result.data.msg;
        show_alert(result.data.msg, "2000", "success");
    }, function(error){
        //$scope.berror = error.statusText;
        show_alert(error.statusText, "2000", "danger");
    });
}

