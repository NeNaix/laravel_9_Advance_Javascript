<!DOCTYPE>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="{{url('cart.css')}}">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"/>
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css"/>
  <link rel="stylesheet" type="text/css"
  href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-html5-2.2.3/b-print-2.2.3/r-2.3.0/sl-1.4.0/datatables.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

</head>
<style type="text/css">
  .error {
      color:#a12525;
   }
   /* The heart of the matter */
.testimonial-group > .row {
  display: block;
  overflow-x: auto;
  white-space: nowrap;
}
.testimonial-group > .row > .col-4 {
  display: inline-block;
  height: 500px;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  padding-top: 50px;
  font-size: 20px;
  font-weight: bold;
}
canvas{


}
</style>
<body class="skin-blue-black">
  <div class="wrapper">
    <header class="main-header col-lg-12">
      <span class="logo-mid" style="padding-left: 2px;"><img src="{{url('storage/images/logo.png')}}" style="border-radius: 50%;"/> VAPOR </span>
      <div class="fa fa-bars" id="menu_bar"></div>
      <div class="fa " id="menu_bar"> <a href="{{url('/')}}" style="color:white;"> home</a></div>
      <!--<div class="fa fa-search" id="search_bar"></div> -->

      {{-- <div class="fa fa-gears" id="settings_bar"></div> --}}
{{--       @if(Auth::check())
        Auth::user()->lname
        @endif --}}

        <div class="user-profile2 btn-success" data-bs-toggle="modal"
        data-bs-target="#cart" style="padding-top:20px;height: 100%;display:none;" id="cart_show"> <span
        class="total-count " style="font-weight: bold;background-color:yellow;color: black;border-radius:
        50%;padding-left: 6px;"></span> Show<i class="fa fa-shopping-cart"></i></div> 
        

        <div class="user-profile2" style="padding-top:20px;height: 100%;" id="register_div" data-bs-toggle="modal" data-bs-target="#reg_customer" >Register?</div>
        <div class="user-profile2" style="padding-top:20px;height: 100%;"  data-bs-toggle="modal" data-bs-target="#login" id="login_div">Login</div>

        

        <div class="user-profile" style="display:none;">
          <span class="username" style="padding-top:10px;"></span>
          <div class="mini-user"><img src="{{url('storage/images/user.png')}}" width="30px" id="user_img" style="border-radius: 50%;"/></div>        
        </div>


        <div class="profile-hover" style="color:black;">

          <div class="user-profile-icon"><img src="{{url('storage/images/user.png')}}" width="50px" style="border-radius: 50%;"/></div>
          <div></br>
            <span style="font-size: 15px;" class="username" ></span></br>
            <span style="font-size: 20px;" class="role" ></span></br>
            <h1><button type="submit" style="min-width:100%;background-color: skyblue;" id="logout">Logout</button></h1>
          </div>
        </div>

      </header>    
      <div class="leftMenu">
        <ul class="leftMenuList">
          <li class=" tooltip_nav point01" >

            <i class="fa fa-dashboard" aria-hidden="true" style="color:#29C02B;"></i>
            <span>Dashboard</span>
            <p>Dashboard</p>

          </li>
          <li class="tooltip_nav point02" style="display:none;">

            <i class="fa fa-gamepad" aria-hidden="true" style="color:#29C02B;"></i>
            <span>Games</span>
            <p>Games</p>

          </li>

          <li class="tooltip_nav point03" style="display:none;">

            <i class="fa fa-filter" aria-hidden="true" style="color:#29C02B;"></i>  
            <span>Genre</span>
            <p>Genre</p>

          </li>
          <li class="tooltip_nav point04" style="display:none;">

            <i class="fa fa-user" aria-hidden="true" style="color:#29C02B;"></i>  
            <span>Employee</span>
            <p>Employee</p>

          </li>
          <li class="tooltip_nav point05" style="display:none;">

            <i class="fa fa-users" aria-hidden="true" style="color:#29C02B;"></i>  
            <span>Customers</span>
            <p>Customers</p>

          </li>
          <li class="tooltip_nav point06" style="display:none;">

            <i class="fa fa-usd" aria-hidden="true" style="color:#29C02B;"></i>
            <span>Transaction</span>
            <p>Transaction</p>

          </li>
        </ul>
      </div>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
      @yield('content')
    </div>

<div class="modal fade" id="cart" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content" style="color:black;">
      <form id="cart_buy">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cart</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
        <table class=" table table-hover" >
          <th>Game Name</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Total</th>
          <th>Remove</th>
          <tbody class="show-cart">
            
          </tbody>
        </table>
        <div align="center" style="font-weight:bold;font-size: 24px;">Total price: ₱<span class="total-cart"></span>.00</div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="clear-cart btn btn-danger">Clear <i class="fa fa-shopping-cart"></i></button>
        <button type="button" class="btn btn-primary" id="order">Order now</button>
      </div>
        </form>
      </div>
    </div>
  </div>
</div> 


    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.js" type="text/javascript"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
    src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-html5-2.2.3/b-print-2.2.3/r-2.3.0/sl-1.4.0/datatables.min.js">
  </script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>

<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>



  <script type="text/javascript" src="{{url('js/validation.js')}}"></script>
  <script type="text/javascript" src="{{url('js/games.js')}}"></script>
  <script type="text/javascript" src="{{url('js/genre.js')}}"></script>
  <script type="text/javascript" src="{{url('js/customer.js')}}"></script>
  <script type="text/javascript" src="{{url('js/employee.js')}}"></script>
  <script type="text/javascript" src="{{url('js/login_register.js')}}"></script>
   <script type="text/javascript" src="{{url('js/transaction.js')}}"></script>
    <script type="text/javascript" src="{{url('js/chart.js')}}"></script>


  <script type="text/javascript">
    var pages = 1;
    var current_page = 0;
    var bool = false;
    var lastPage ;

    $(window).scroll(function (){
      var $check = $("#main_page").is(":visible");
      if( ($(window).scrollTop()+800) > $(document).height() && bool == false && $check == true ){
       bool = true;
       lazyLoad(pages)
       .then(() => {
        bool = false;
        pages++;

        if(pages - 1 == lastPage){
         // $('.no-data').show();
         current_page = 1;
         pages = 1;
       }

     })
     }

   })

    function lazyLoad(page){
      return new Promise((resolve,reject) => {
        $.ajax({
         url: 'api/vapor/home/games?page='+page,
         type:'GET',
         beforeSend:function() {
          $.LoadingOverlay("show");
        }, 
        success :function (response){
         $.LoadingOverlay("hide");
         let html = '';
         for(let i = 0; i < response.data.length;i++){
          html += `
          <div class="col-xs-18 col-sm-12 col-md-3" style="border:solid; ">
              <div class="thumbnail" style="padding: 5px;">
                  <div id="demo`+ response.data[i].id +`" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                          <div class="carousel-item active">
                            <img src="`+ response.data[i].img +`"  height="200" width="200" class="d-block">
                          </div>
                    </div>
                    
                    <!-- Left and right controls/icons -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon btn-success"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                      <span class="carousel-control-next-icon btn-success"></span>
                    </button>
                  </div>


                  <div class="caption">
                      <h3>Title : `+ response.data[i].title +`</h3>
                      <h4>Description:`+ response.data[i].description +`</h4>
                      <h4>Genre:`+ response.data[i].description +`</h4>
                      <p><strong>Price: </strong> `+ response.data[i].price +`$</p>

                          <button type="button" id="add-to-cart" class="add-to-cart btn btn-warning "
                          data-name="`+ response.data[i].title +`"
                          data-id="`+ response.data[i].id +`"
                          data-price="`+ response.data[i].price +`"
                          >
                            add-to-cart
                          </button>


                  </div>  
              </div>
          </div>
          `;
        }
        $('#game_infi').append(html);

        resolve();
      }

    });
      })
    }

    loadData(1);

    function loadData(page){
      $.LoadingOverlay("show");
      $.ajax({
       url: 'api/vapor/home/games?page='+page,
       type:'GET',
       beforeSend:function() {
         
       },
       success :function (response){
         $.LoadingOverlay("hide");
         lastPage = response.last_page;
         let html = '';
         for(let i = 0; i < response.data.length;i++){
          html += `
          <div class="col-xs-18 col-sm-12 col-md-3" style="border:solid; ">
              <div class="thumbnail" style="padding: 5px;">
                  <div id="demo`+ response.data[i].id +`" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                          <div class="carousel-item active">
                            <img src="`+ response.data[i].img +`"  height="200" width="200" class="d-block">
                          </div>
                    </div>
                    
                    <!-- Left and right controls/icons -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon btn-success"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                      <span class="carousel-control-next-icon btn-success"></span>
                    </button>
                  </div>


                  <div class="caption">
                      <h3>Title : `+ response.data[i].title +`</h3>
                      <h4>Description:`+ response.data[i].description +`</h4>
                      <h4>Genre:`+ response.data[i].description +`</h4>
                      <p><strong>Price: </strong> `+ response.data[i].price +`$</p>
                      
                          <button type="button" class="add-to-cart btn btn-warning "
                          data-name="`+ response.data[i].title +`"
                          data-id="`+ response.data[i].id +`"
                          data-price="`+ response.data[i].price +`"
                          >
                            add-to-cart
                          </button>


                  </div>  
              </div>
          </div>
          `;
        }
        $('#game_infi').append(html);
      }
    });
    }
  </script>
  <script type="text/javascript" src="{{url('js/cart.js')}}"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $(".point01").click(function(){
        $('#employee_page').hide('slow');
        $('#main_page').show();
        $('#game_page').hide('slow');
        $('#genre_page').hide('slow');
        $('#customer_page').hide('slow');
        $('#transaction_page').hide('slow');

      });
      $(".point02").click(function(){
        $('#employee_page').hide('slow');
        $('#customer_page').hide('slow');
        $('#main_page').hide();
        $('#game_page').show('slow');
        $('#genre_page').hide('slow');
         $('#transaction_page').hide('slow');

      });
      $(".point03").click(function(){
        $('#employee_page').hide('slow');
        $('#customer_page').hide('slow');
        $('#main_page').hide();
        $('#game_page').hide('slow');
        $('#genre_page').show('slow');
         $('#transaction_page').hide('slow');
      });

      $(".point04").click(function(){
        $('#employee_page').show('slow');
        $('#main_page').hide();
        $('#game_page').hide('slow');
        $('#genre_page').hide('slow');
        $('#customer_page').hide('slow');
         $('#transaction_page').hide('slow');

      });


      $(".point05").click(function(){
        $('#employee_page').hide('slow');
        $('#main_page').hide();
        $('#game_page').hide('slow');
        $('#genre_page').hide('slow');
        $('#customer_page').show('slow');
         $('#transaction_page').hide('slow');

      });

      $(".point06").click(function(){
        $('#transaction_page').show('slow');
        $('#employee_page').hide('slow');
        $('#main_page').hide();
        $('#game_page').hide('slow');
        $('#genre_page').hide('slow');
        $('#main_page').hide();

      });



      document.querySelector("#menu_bar").onclick = function () {
        var element = document.querySelector(".leftMenu");
        element.classList.toggle("openMenu");

        var closeAccordion = document.getElementsByClassName('dropdown');
        var i = 0;
        for (i = 0; i < closeAccordion.length; i++) {
          closeAccordion[i].classList.remove('active');
        }
      }

      var dropdown = document.getElementsByClassName('dropdown');
      var i = 0;
      for (i = 0; i < dropdown.length; i++) {
        dropdown[i].onclick = function () {
          this.classList.toggle('active');
        }
      }

      $("#menu_bar").click(function(){
        $(".main-header span:first").toggleClass("first border");
        $(".content-wrapper").toggleClass("content-wrapper-mid");
        $(".tooltip_nav p").toggleClass("hide");                   
      });


      jQuery(function($)
      {
        $("#settings_bar").click(function()
        {
          $(".navigation").toggleClass("open");
        })
      });

      $("#color01").click(function(){
        $("body").addClass("skin-green")
      });

    }); 

    $(document).ready(function(){
      $(".user-profile").on("click", function(e) {
        $(".profile-hover").toggle();
        $(".popup-overlay").toggle();

      });

      $(".popup-overlay").click(function(){
        $(".popup-overlay").toggle();
        $(".profile-hover").toggle();
      });

      $(".notification-icon").on("click", function(e) {
        $(".notification-hover").toggle();
        $(".popup-overlay-bell").toggle();

      });

      $(".popup-overlay-bell").click(function(){
        $(".popup-overlay-bell").toggle();
        $(".notification-hover").toggle();
      });
    }); 
  </script>
</body>


</html>

