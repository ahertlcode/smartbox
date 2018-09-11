//javascript file for payments using angularjs for data-binding.
var base_api_url = "http://localhost:8085/mathchamp/api/";
var user = local_store({}, "mathchamp-user", "get");
var app = angular.module('paymentsView', []);

app.controller ('paymentsCtrl', function($scope, $http) {

    this.payment = {user:user, id:'', username:'', pay_ref:'', pay_date:'', used:''};
    this.update = {col_name:'', col_value:''};

    $scope.payment_save = function() {
        if (this.update == undefined) {
            var pb = {"method":"save", "table":"payments", "data":this.payment};
            save_payment($scope, $http, pb);
        } else {
            var data = Object.assign(this.payment, this.update);
            var pu = {"method":"update", "table":"payments", "data":data};
            update_payment($scope, $http, pu);
        }
    };

    $scope.payment_view_single = function(coln, colv){
        show_selected($scope, $http, coln, colv);
    };

    $scope.do_payment_update = function(colname, colvalue){
        $scope.update = {"col_name":colname, "col_value":colvalue};
        show_selected($scope, $http, colname, colvalue);
    };

    $scope.payment_delete = function(coln, colv){
        delete_payment($scope, $http, coln, colv);
    };

    $http({
        url: base_api_url+"payments_http_api.php",
        method: "POST",
        data:{"method":"view", "table":"payments"}
    }).then((result) =>{
        $scope.payments = result.data;
    }, function(error){
        //$scope.berror = error.statusText;
        show_alert(error.statusText, "2000", "danger");
    });

});

function save_payment($scope, $http, pb){
    $http({
        url: base_api_url+"payments_http_api.php",
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
        url: base_api_url+"payments_http_api.php",
        method: "POST",
        data:{"method":"view", "table":"payments", "data":{"col_name":column, "col_value":value}}
    }).then((result) =>{
        $scope.payment = result.data.payment;
    }, function(error){
        //$scope.berror = error.statusText;
        show_alert(error.statusText, "2000", "danger");
    });
}

function update_payment($scope, $http, pb){
    $http({
        url: base_api_url+"payments_http_api.php",
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

function delete_payment($scope, $http, column, value){
    $http({
        url: base_api_url+"payments_http_api.php",
        method: "POST",
        data:{"method":"delete", "table":"payments", "data":{"col_name":column, "col_value":value}}    }).then((result) =>{
        //$scope.berror = result.data.msg;
        show_alert(result.data.msg, "2000", "success");
    }, function(error){
        //$scope.berror = error.statusText;
        show_alert(error.statusText, "2000", "danger");
    });
}

