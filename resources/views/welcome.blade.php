@extends('layout.dash')

@section('content')
<div id="main_page" align="center">
  <section class="content-header">
          <h1>
            VAPOR : GAMES FOR CONSOLE AND PC
          </h1>
            <ol class="breadcrumb">
            <li class="divider"><i class="fa fa-dashboard"></i></i> Home</li>
            <li class="active">Dashboard</li>
          </ol>
        </section>
  <section class="content">
  <div class="col-lg-11 col-sm-12 col-12 main-section" style="background-color: transparent;">
  <div class="row" align="center" id="game_infi" >

      @foreach($games as $game)
          <div class="col-xs-18 col-sm-12 col-md-3" style="border:solid; ">
              <div class="thumbnail" style="padding: 5px;">
                  <div id="demo{{$game->id}}" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                      <?php $images = explode("|",$game->img); ?>
                      @if(count($images) > 1)
                          @foreach($images as $key => $item)
                              @if($key == 0 )
                              <div class="carousel-item active">
                                <img src="{{url($item)}}"  height="200" width="200" class="d-block">
                              </div>
                              @else
                              <div class="carousel-item">
                                <img src="{{url($item)}}"  height="200" width="200" class="d-block">
                              </div>
                              @endif
                          @endforeach
                      @else
                          <div class="carousel-item active">
                            <img src="{{url($images[0])}}"  height="200" width="200" class="d-block">
                          </div>
                      @endif
                    </div>
                    
                    <!-- Left and right controls/icons -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#demo{{$game->id}}" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon btn-success"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#demo{{$game->id}}" data-bs-slide="next">
                      <span class="carousel-control-next-icon btn-success"></span>
                    </button>
                  </div>


                  <div class="caption">
                      <h3>{{ $game->title }}</h3>
                      <h4>{{ $game->description }}</h4>
                      <p><strong>Price: </strong> {{ $game->price }}$</p>
                     
                          <!-- Button trigger modal -->
                          <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#game{{$game->id}}">
                            Give a Comment
                          </button>
                          <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#game_comment{{$game->id}}">
                            Read Comments
                          </button>

                           <!-- Modal -->
                          <div class="modal fade" id="game{{$game->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <form action="" method="POST" enctype="multipart/form-data">
                                    @method('POST')
                                    @csrf
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Comment in {{ $game->sname }}</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <input type="hidden" name="id" value="{{$game->id}}">
                                 <div class="mb-3">
                                    <label for="comment" class="form-label">Comments:</label>
                                    <textarea  type="text" class="form-control" name="comment" rows="4"></textarea>
                                  </div>
                                  
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                              </div>
                            </div>
                            </form>
                          </div>

                          <!-- Modal -->
                          {{-- <div class="modal fade" id="servcom{{$game->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Comment in {{ $game->sname }}</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                               
                                 @if(count($game->comments) < 1)
                                  <div class="modal-body" align="center">
                                  No Comment Submitted
                                 @else
                                  <div class="modal-body" align="left">
                                  @foreach($game->comments as $eachcomment)
                                          <br>
                                          {{$eachcomment->commentor}} : {{$eachcomment->comment}} .
                                          <br><hr>
                                  @endforeach
                                 @endif
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>--}}
                  </div>  
              </div>
          </div>
      @endforeach
  </div>
  </div></section>
</div>


@include('content.games')
@include('content.genre')
@include('content.customer')
@include('content.employee')
@include('content.login_register') 
@endsection