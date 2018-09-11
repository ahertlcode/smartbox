//javascript file for winners using angularjs for data-binding.
var base_api_url = "http://localhost:8085/mathchamp/api/";
var user = local_store({}, "mathchamp-user", "get");
var app = angular.module('winnersView', []);

app.controller ('winnersCtrl', function($scope, $http) {

    this.winner = {user:user, id:'', username:'', award_value:'', wdate:'', position:''};
    this.update = {col_name:'', col_value:''};

    $scope.winner_save = function() {
        if (this.update == undefined) {
            var pb = {"method":"save", "table":"winners", "data":this.winner};
            save_winner($scope, $http, pb);
        } else {
            var data = Object.assign(this.winner, this.update);
            var pu = {"method":"update", "table":"winners", "data":data};
            update_winner($scope, $http, pu);
        }
    };

    $scope.winner_view_single = function(coln, colv){
        show_selected($scope, $http, coln, colv);
    };

    $scope.do_winner_update = function(colname, colvalue){
        $scope.update = {"col_name":colname, "col_value":colvalue};
        show_selected($scope, $http, colname, colvalue);
    };

    $scope.winner_delete = function(coln, colv){
        delete_winner($scope, $http, coln, colv);
    };

    $http({
        url: base_api_url+"winners_http_api.php",
        method: "POST",
        data:{"method":"view", "table":"winners"}
    }).then((result) =>{
        $scope.winners = result.data;
    }, function(error){
        //$scope.berror = error.statusText;
        show_alert(error.statusText, "2000", "danger");
    });

});

function save_winner($scope, $http, pb){
    $http({
        url: base_api_url+"winners_http_api.php",
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
        url: base_api_url+"winners_http_api.php",
        method: "POST",
        data:{"method":"view", "table":"winners", "data":{"col_name":column, "col_value":value}}
    }).then((result) =>{
        $scope.winner = result.data.winner;
    }, function(error){
        //$scope.berror = error.statusText;
        show_alert(error.statusText, "2000", "danger");
    });
}

function update_winner($scope, $http, pb){
    $http({
        url: base_api_url+"winners_http_api.php",
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

function delete_winner($scope, $http, column, value){
    $http({
        url: base_api_url+"winners_http_api.php",
        method: "POST",
        data:{"method":"delete", "table":"winners", "data":{"col_name":column, "col_value":value}}    }).then((result) =>{
        //$scope.berror = result.data.msg;
        show_alert(result.data.msg, "2000", "success");
    }, function(error){
        //$scope.berror = error.statusText;
        show_alert(error.statusText, "2000", "danger");
    });
}

