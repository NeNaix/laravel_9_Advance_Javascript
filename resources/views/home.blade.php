@extends('layout.dash')

@section('content')
<div id="main_page" align="center" >
  <section class="content-header">
    <h1>
      VAPOR : GAMES FOR CONSOLE AND PC
    </h1>
    <ol class="breadcrumb">
      <li class="divider"><i class="fa fa-dashboard"></i></i> Home</li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
    <div class="row justify-content-center">
      <div class="col-lg-12">
        <div class="card" style="color:black;" align="center">
            <div class="card-header" align="center">all about games</div>
            <div class="card-body">
              <div class="row g-6">
                <div class="col-6">
                <canvas id="c1"></canvas></div>
                <div class="col-6">
                <canvas id="c2"></canvas></div>
              </div>
              <br/>
              
                <div class="col-4">
                <canvas id="c3"></canvas>
              </div>
              
         </div>
        </div>
     </div>
    </div>
    <div class="row">

      <div class="form-group">
        <label class="control-label col-sm-4" for="email"><b>Search a Game</b></label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="search" id="search_game" placeholder="search here">
        </div>
   
      </div>
       <hr>
    </div>
    <div class="container-fluid testimonial-group">
  <div class="row text-center" id="sdata">

  </div>
</div>
<hr>
  <section class="content">
    <div class="col-lg-10 col-sm-12 col-12 main-section" style="background-color: transparent;">
      <div class="row" align="center" id="game_infi" >
      </div>
      <div class="no-data text-center mb-4" style="display:none">
        <h4>No data - last page</h4>
      </div>
    </div></section>
  </div>


  @include('content.games')
  @include('content.genre')
  @include('content.customer')
  @include('content.employee')
  @include('content.login_register')
  @include('content.transaction') 
  @endsection