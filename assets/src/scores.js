//javascript file for scores using angularjs for data-binding.
var base_api_url = "http://localhost:8085/mathchamp/api/";
var user = local_store({}, "mathchamp-user", "get");
var app = angular.module('scoresView', []);

app.controller ('scoresCtrl', function($scope, $http) {

    this.score = {user:user, id:'', username:'', score:'', sdate:''};
    this.update = {col_name:'', col_value:''};

    $scope.score_save = function() {
        if (this.update == undefined) {
            var pb = {"method":"save", "table":"scores", "data":this.score};
            save_score($scope, $http, pb);
        } else {
            var data = Object.assign(this.score, this.update);
            var pu = {"method":"update", "table":"scores", "data":data};
            update_score($scope, $http, pu);
        }
    };

    $scope.score_view_single = function(coln, colv){
        show_selected($scope, $http, coln, colv);
    };

    $scope.do_score_update = function(colname, colvalue){
        $scope.update = {"col_name":colname, "col_value":colvalue};
        show_selected($scope, $http, colname, colvalue);
    };

    $scope.score_delete = function(coln, colv){
        delete_score($scope, $http, coln, colv);
    };

    $http({
        url: base_api_url+"scores_http_api.php",
        method: "POST",
        data:{"method":"view", "table":"scores"}
    }).then((result) =>{
        $scope.scores = result.data;
    }, function(error){
        //$scope.berror = error.statusText;
        show_alert(error.statusText, "2000", "danger");
    });

});

function save_score($scope, $http, pb){
    $http({
        url: base_api_url+"scores_http_api.php",
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
        url: base_api_url+"scores_http_api.php",
        method: "POST",
        data:{"method":"view", "table":"scores", "data":{"col_name":column, "col_value":value}}
    }).then((result) =>{
        $scope.score = result.data.score;
    }, function(error){
        //$scope.berror = error.statusText;
        show_alert(error.statusText, "2000", "danger");
    });
}

function update_score($scope, $http, pb){
    $http({
        url: base_api_url+"scores_http_api.php",
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

function delete_score($scope, $http, column, value){
    $http({
        url: base_api_url+"scores_http_api.php",
        method: "POST",
        data:{"method":"delete", "table":"scores", "data":{"col_name":column, "col_value":value}}    }).then((result) =>{
        //$scope.berror = result.data.msg;
        show_alert(result.data.msg, "2000", "success");
    }, function(error){
        //$scope.berror = error.statusText;
        show_alert(error.statusText, "2000", "danger");
    });
}

