var app = angular.module('app', ['ngRoute']);

app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/orders', {
                templateUrl: 'js/templates/admin/orders.html',
                controller: AdminOrdersCtrl
            }).
            when('/products', {
                templateUrl: 'js/templates/admin/products.html',
                controller: AdminProductsCtrl
            }).
            otherwise({
                redirectTo: '/products'
            });
    }]);

function ProductsCtrl($scope, $http) {

    $http.get('api.php/products').success(function (data) {
        $scope.products = data;
    });

    $scope.createOrder = function () {
        var order = $scope.order;
        order.product_id = $scope.product.id;
        $http.post('api.php/orders', order).success(function () {
            $scope.successMessage = 'Your order has been placed successfully.';
        }).error(function() {
                $scope.errorMessage = 'Error Occurred. Unable to place your order.';
            });
        $('.modal').modal('hide');
    };

    $scope.showOrderForm = function (product) {
        $scope.order = {};
        $scope.product = product;
        $('.modal').modal('show');
    };
}

function AdminProductsCtrl($scope, $http) {

    $http.get('api.php/admin/products').success(function (data) {
        $scope.products = data;
    });

    $scope.showForm = function (product) {
        $scope.currentProduct = product || {};
        $('.modal').modal('show');
    };

    $scope.save = function () {
        if ($scope.currentProduct.id) {
            $http.put('api.php/admin/products/' + $scope.currentProduct.id, $scope.currentProduct).success(function () {
                $scope.successMessage = "Product successfully updated";
            }).error(function () {
                    $scope.errorMessage = "Error occurred. Cannot update product.";
                });
        } else {
            $http.post('api.php/admin/products', $scope.currentProduct).success(function () {
                $scope.products.push($scope.currentProduct);
                $scope.successMessage = "Product successfully created";
            }).error(function () {
                    $scope.errorMessage = "Error occurred. Cannot create product.";
                });
        }

        $('.modal').modal('hide');
    };

    $scope.delete = function (index) {
        var product = $scope.products[index];
        $http.delete('api.php/admin/products/' + product.id).success(function () {
            $scope.products.splice(index, 1);
            $scope.successMessage = "Product successfully removed";
        }).error(function () {
                $scope.errorMessage = "Error occurred. Cannot remove product.";
            });
    };
}

function AdminOrdersCtrl($scope, $http) {

    $http.get('api.php/admin/orders').success(function (data) {
        $scope.orders = data;
    });

    $scope.showForm = function (order) {
        $scope.currentOrder = order || {};
        $('.modal').modal('show');
    };

    $scope.save = function () {
        if ($scope.currentOrder.id) {
            $http.put('api.php/admin/orders/' + $scope.currentOrder.id, $scope.currentOrder).success(function () {
                $scope.successMessage = "Order successfully updated";
            }).error(function () {
                    $scope.errorMessage = "Error occurred. Cannot update order.";
                });
        }
        $('.modal').modal('hide');
    };

    $scope.delete = function (index) {
        var order = $scope.orders[index];
        $http.delete('api.php/admin/orders/' + order.id).success(function () {
            $scope.orders.splice(index, 1);
            $scope.successMessage = "Order successfully removed";
        }).error(function () {
                $scope.errorMessage = "Error occurred. Cannot remove order.";
            });
    };
}

var INTEGER_REGEXP = /^\-?\d+$/;
app.directive('integer', function () {
    return {
        require: 'ngModel',
        link: function (scope, elm, attrs, ctrl) {
            ctrl.$parsers.unshift(function (viewValue) {
                if (INTEGER_REGEXP.test(viewValue)) {
                    // it is valid
                    ctrl.$setValidity('integer', true);
                    return viewValue;
                } else {
                    // it is invalid, return undefined (no model update)
                    ctrl.$setValidity('integer', false);
                    return undefined;
                }
            });
        }
    };
});