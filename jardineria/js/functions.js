angular.module('App', [])
.controller('ctrl', ['$scope', '$http', function($scope, $http) {
  $scope.selectedClient = null;
  $scope.selectedProducts = [];
  $scope.clients = [];
  $scope.products = [];
  $scope.total;
  

  $scope.searchClients = function() {
    var search_value = $('#searching-clients').val();

    $http.post('php/clients.php', {searchingValue: search_value})
      .then(function(response) {
        $scope.clients = response.data;
      });
  };

  $scope.selectClient = function(client) {
    $scope.selectedClient = client;
    $('.modal-clients').modal('hide');
  };

  $scope.searchProducts = function() {
    var search_value = $('#searching-products').val();

    $http.post('php/products.php', {searchingValue: search_value})
      .then(function(response) {
        $scope.products = response.data;
      });
  };

  $scope.selectProduct = function(product) {
    product.Cantidad = 1;
    product.Precio = parseFloat(product.PrecioVenta);
    $scope.selectedProducts.push(product);
    $('.modal-products').modal('hide');
  };

  $scope.deleteProduct = function(index) {
    $scope.selectedProducts.splice(index, 1);
  };

 /* $scope.totalPrice = $scope.selectedProducts.reduce(function(previousProduct, nextProduct) {
    return previousProduct.Precio + nextProduct.Precio;
  }, 0);*/

  $scope.totalPrice = function(){
    var total = 0;
    for(var i = 0; i < $scope.selectedProducts.length; i++){
      var product = $scope.selectedProducts[i];
      parseInt(total += product.Precio * product.Cantidad);
    }
    return total;
  }
}]);