<div class="modal fade" id="login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="color:black;">
        <form id="login_form" enctype="multipart/form-data">
            <div class="modal-content" >
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="background-color:black;">                   
                   <div class="row">
                      <div class="col-md-6 offset-md-3">
                        <div class="card my-2">
                           <div class="card-header" style="background-image:url('https://media.tenor.com/3klZkDif0nsAAAAd/gaming-gif.gif'); background-position: center;background-repeat: no-repeat;background-size: cover;">
                               <div class="text-center">
                                  <img src="{{url('storage/images/logo.png')}}"
                                  width="200px"  alt="logo" style="border-radius: 50%;background-color: orange;padding: 10px;">
                              </div>
                          </div>
                          <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" aria-describedby="emailHelp"
                            placeholder="User Name">
                        </div>
                        <div class="mb-3">
                          <label for="password" class="form-label">Password</label>
                          <input type="password" class="form-control" name="password" placeholder="password">
                      </div>
                      <button type="submit" class="btn btn-primary submit" value="submit" id="btn_login" aria-label="Close">Login</button>
                  </div>

              </div>
          </div>

      </div>

  </div>
</form>
</div>
</div>

<div class="modal fade" id="reg_customer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="color:black;">
        <div class="modal-content" >
            <div class="modal-header">
                <ul class="nav nav-pills " id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Customer</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Employee</button>
  </li></ul>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color:black;">                   
               <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">

                        <div class="card-body">
                            


<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
<form  id="reg_customer_form" enctype="multipart/form-data">

                                <input type="hidden" name="role" value="customer">

                                <div class="row g-6">
                                  <label class="form-label">Customer Name</label>
                                    <div class="col-6">
                                        <label for="fname" class="visually-hidden">First Name</label>
                                        <input type="text" class="form-control" name="fname" placeholder="First Name" value="{{ old('fname') }}" required>
                                    </div>
                                    <div class="col-6">
                                        <label for="inputPassword2" class="visually-hidden">Last Name</label>
                                        <input type="text" class="form-control" name="lname" placeholder="Last Name" value="{{ old('lname') }}" required>
                                    </div>
                                </div>

                                <div class="row g-6">
                                     <div class="col-5">
                                          <label for="email" class="form-label">Email</label>
                                          <input type="email" class="form-control" name="email" placeholder="example@example.com" value="{{ old('email') }}" required>
                                          @error('email')
                                          <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                            <div class="col-7">
                                  <label for="addr" class="form-label">Address</label>
                                  <input type="text" class="form-control" name="address" placeholder="abocado st. sta manila ..." value="{{ old('addr') }}" required>
                                  @error('address')
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                    </div>

                    <div class="row g-6">

                        <div class="col-6">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>

                        <div class="col-6">
                            <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                            <input type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>
                    <div align="center">           
                        <button type="submit" class="btn btn-primary" id="btn_reg_customer" data-bs-dismiss="modal" aria-label="Close">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>
  </div>
  <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
<form  id="reg_employee_form" enctype="multipart/form-data">
    
                                <input type="hidden" name="role" value="employee">

                                <div class="row g-6">
                                  <label class="form-label">Employee Name</label>
                                    <div class="col-6">
                                        <label for="fname" class="visually-hidden">First Name</label>
                                        <input type="text" class="form-control" name="fname" placeholder="First Name" value="{{ old('fname') }}" required>
                                    </div>
                                    <div class="col-6">
                                        <label for="inputPassword2" class="visually-hidden">Last Name</label>
                                        <input type="text" class="form-control" name="lname" placeholder="Last Name" value="{{ old('lname') }}" required>
                                    </div>
                                </div>

                                <div class="row g-6">
                                     <div class="col-5">
                                          <label for="email" class="form-label">Email</label>
                                          <input type="email" class="form-control" name="email" placeholder="example@example.com" value="{{ old('email') }}" required>
                                          @error('email')
                                          <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                            <div class="col-7">
                                  <label for="address" class="form-label">Address</label>
                                  <input type="text" class="form-control" name="address" placeholder="abocado st. sta manila ..." value="{{ old('addr') }}" required>
                                  @error('address')
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                    </div>

                    <div class="row g-6">

                        <div class="col-6">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>

                        <div class="col-6">
                            <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                            <input type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>
                    <div align="center">           
                        <button type="submit" class="btn btn-primary" id="btn_reg_employee" data-bs-dismiss="modal" aria-label="Close">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>       
  </div>
</div>
                {{-- <form method="POST" id="reg_customer_form" enctype="multipart/form-data">
                                <input type="hidden" name="role" value="customer">

                                <div class="row g-6">
                                  <label class="form-label">Customer Name</label>
                                    <div class="col-6">
                                        <label for="fname" class="visually-hidden">First Name</label>
                                        <input type="text" class="form-control" name="fname" placeholder="First Name" value="{{ old('fname') }}" required>
                                    </div>
                                    <div class="col-6">
                                        <label for="inputPassword2" class="visually-hidden">Last Name</label>
                                        <input type="text" class="form-control" name="lname" placeholder="Last Name" value="{{ old('lname') }}" required>
                                    </div>
                                </div>

                                <div class="row g-6">
                                     <div class="col-5">
                                          <label for="email" class="form-label">Email</label>
                                          <input type="email" class="form-control" name="email" placeholder="example@example.com" value="{{ old('email') }}" required>
                                          @error('email')
                                          <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                            <div class="col-7">
                                  <label for="addr" class="form-label">Address</label>
                                  <input type="text" class="form-control" name="addr" placeholder="abocado st. sta manila ..." value="{{ old('addr') }}" required>
                                  @error('addr')
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                    </div>

                    <div class="row g-6">

                        <div class="col-6">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>

                        <div class="col-6">
                            <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                            <input type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>
                    <div align="center">           
                        <button type="submit" class="btn btn-primary" id="btn_reg_customer">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form> --}}
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>



