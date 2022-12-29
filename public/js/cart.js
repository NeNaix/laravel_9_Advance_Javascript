$(document).ready(function() {
  $("#order").on('click', function(e) {
    if ($('.show-cart').html().length > 0) {

      e.preventDefault(); 
      console.log(JSON.parse(localStorage.getItem('shoppingCart')));
      $.ajax({
        type: "POST",
        url: "api/trans",
        data: {
          "data" : JSON.parse(localStorage.getItem('shoppingCart')),
        },
        enctype:"multipart/form-data",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),"Authorization":'Bearer ' + localStorage.getItem('token')},
        dataType: "json",
        success: function(data){
          window.open(window.location.protocol + "//" + window.location.host +"/"+data.pdf);
          shoppingCart.clearCart();
          displayCart();
          $("#transaction_table").DataTable().destroy();
          $("#transaction_table").DataTable({
            responsive: true,
            ajax: {
              url: "api/trans",
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),"Authorization":'Bearer ' + localStorage.getItem('token')},
              dataSrc: "",
            },
            dom: '<"top"<"left-col"B><"center-col"l><"right-col"f>>rtip',
            buttons: [{
              extend: 'pdf',
              className: 'btn btn-success glyphicon glyphicon-file'
            },
            {
              extend: 'excel',
              className: 'btn btn-success glyphicon glyphicon-list-alt'
            },
            ],
            columns: [

            {
              data: "id",
            },
            {
              className: 'dt-control',
              orderable: false,
              data: null,
              defaultContent: 'show',
            },
            {
              data: "created_at",
            },
            {
              data: "status",
            },
            {
              data: null,
              render: function (data, type, row) {
                return `<a href='#' data-bs-toggle='modal' data-bs-target='#mdl_del_transaction' id='delbtn' data-id="`+ data.id + `"><i class='fa fa-trash' aria-hidden='true' style='font-size:24px;color:maroon;' ></a></i>`;
              },
            },
            ],
          });

        },
        error: function(error) {
          console.log(error);

        }

      });

    }

  });

  var shoppingCart = (function() {
    // =============================
    // Private methods and propeties
    // =============================
    cart = [];
    
    // Constructor
    function Item(id,name, price, count) {
      this.name = name;
      this.price = price;
      this.count = count;
      this.id = id;
    }
    
    // Save cart
    function saveCart() {
      $.LoadingOverlay("hide");
      localStorage.setItem('shoppingCart', JSON.stringify(cart));
      
    }
    
      // Load cart
    function loadCart() {
      cart = JSON.parse(localStorage.getItem('shoppingCart'));
    }
    if (localStorage.getItem("shoppingCart") != null) {
      loadCart();
    }
    

    // =============================
    // Public methods and propeties
    // =============================
    var obj = {};
    
    // Add to cart
    obj.addItemToCart = function(id,name, price, count) {
      for(var item in cart) {
        if(cart[item].id === id) {
          cart[item].count ++;
          saveCart();
          return;
        }
      }
      var item = new Item(id,name, price, count);
      cart.push(item);
      saveCart();
    }
    // Set count from item
    obj.setCountForItem = function(name, count) {
      for(var i in cart) {
        if (cart[i].name === name) {
          cart[i].count = count;
          break;
        }
      }
    };
    // Remove item from cart
    obj.removeItemFromCart = function(id) {
      for(var item in cart) {
        if(cart[item].id === id) {
          cart[item].count --;
          if(cart[item].count === 0) {
            cart.splice(item, 1);
          }
          break;
        }
      }
      saveCart();
    }

    // Remove all items from cart
    obj.removeItemFromCartAll = function(id) {
      for(var item in cart) {
        if(cart[item].id === id) {
          console.log('success');
          cart.splice(item, 1);
          break;
        }
      }
      saveCart();
    }

    // Clear cart
    obj.clearCart = function() {
      cart = [];
      saveCart();
    }

    // Count cart 
    obj.totalCount = function() {
      var totalCount = 0;
      for(var item in cart) {
        totalCount += cart[item].count;
      }
      return totalCount;
    }

    // Total cart
    obj.totalCart = function() {
      var totalCart = 0;
      for(var item in cart) {
        totalCart += cart[item].price * cart[item].count;
      }
      return Number(totalCart.toFixed(2));
    }

    // List cart
    obj.listCart = function() {
      var cartCopy = [];
      for(i in cart) {
        item = cart[i];
        itemCopy = {};
        for(p in item) {
          itemCopy[p] = item[p];

        }
        itemCopy.total = Number(item.price * item.count).toFixed(2);
        cartCopy.push(itemCopy)
      }
      return cartCopy;
    }

    // cart : Array
    // Item : Object/Class
    // addItemToCart : Function
    // removeItemFromCart : Function
    // removeItemFromCartAll : Function
    // clearCart : Function
    // countCart : Function
    // totalCart : Function
    // listCart : Function
    // saveCart : Function
    // loadCart : Function
    return obj;
  })();


  // *****************************************
  // Triggers / Events
  // ***************************************** 
  // Add item

  $(document).on('click', 'button[class^="add-to-cart"]', function(e) {
    e.preventDefault();
    $.LoadingOverlay("show");
    var name = $(this).data('name');
    var price = Number($(this).data('price'));
    var id = Number($(this).data('id'));
    shoppingCart.addItemToCart(id ,name, price, 1);
    displayCart();
  });

  // $("#add-to-cart").on('click', function(e) {
  //   

  // Clear items
  $('.clear-cart').click(function() {
    shoppingCart.clearCart();
    displayCart();
  });


  function displayCart() {
    var cartArray = shoppingCart.listCart();
    var output = "";
    for(var i in cartArray) {
      output += "<tr>"
      + "<td><b>" + cartArray[i].name + "</b></td>" 
      + "<td> ₱ " + cartArray[i].price + ".00</td>"
      + "<td><div class='input-group'><button class='minus-item input-group-addon btn btn-primary' data-id='" + cartArray[i].id + "' data-name=" + cartArray[i].name + ">-</button>"
      + "<input type='number' class='item-count form-control'  data-name='" + cartArray[i].name + "' value='" + cartArray[i].count + "'>"
      + "<button class='plus-item btn btn-primary input-group-addon' data-id='" + cartArray[i].id + "' data-name=" + cartArray[i].name + ">+</button></div></td>"

      + " = " 
      + "<td>" + cartArray[i].total + "</td>"
      + "<td><button class='delete-item btn btn-danger' data-id='" + cartArray[i].id + "' data-name=" + cartArray[i].name + ">X</button></td>"
      +  "</tr>";
    }
    $('.show-cart').html(output);
    $('.total-cart').html(shoppingCart.totalCart());
    $('.total-count').html(shoppingCart.totalCount());
  }

  // Delete item button

  // $('.show-cart').on("click", ".delete-item", function(event) {
  // $('.delete-item').click(function() {
  $(document).on('click', 'button[class^="delete-item"]', function(e) {
    var id = Number($(this).data('id'));
    shoppingCart.removeItemFromCartAll(id);
    displayCart();
  })


  // -1
  // $('.show-cart').on("click", ".minus-item", function(event) {
   // $('.delete-item').click(function() {
  $(document).on('click', 'button[class^="minus-item"]', function(e) {
    var id = Number($(this).data('id'));
    shoppingCart.removeItemFromCart(id);
    displayCart();
  })
  // +1
  $(document).on('click', 'button[class^="plus-item"]', function(e) {
    var id = Number($(this).data('id'));
    shoppingCart.addItemToCart(id);
    displayCart();
  })

  // Item count input
  $('.show-cart').on("change", ".item-count", function(event) {
   var name = $(this).data('name');
   var count = Number($(this).val());
   shoppingCart.setCountForItem(name, count);
   displayCart();
 });

  displayCart();

});