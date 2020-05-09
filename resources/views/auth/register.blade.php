@extends('layouts.app')

@section('content')
<style type="text/css">
	.captcha{
		    text-align: center;
            padding: 0 0 0 70px;
    width: 100%;
	}
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" autocomplete="off" id="">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>
                                <span class="text-danger">
                                        <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">
                                <span class="text-danger">
                                        <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">
                                <span class="text-danger">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="captcha"  class="col-md-4 col-form-label text-md-right">Recaptcha</label>
                            <div class="col-md-6">
                              {!! NoCaptcha::renderJs() !!}
                              {!! NoCaptcha::display() !!}
                            </div>
                            <span class="text-danger captcha"><strong>{{ $errors->first('g-recaptcha-response') }}</strong></span>

                            
                          </div>

                          <div class="col-xs-12 col-sm-12 col-md-12">
                   
                </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

	 $.validator.addMethod('reCaptchaMethod', function (value, element, param) {
            if (grecaptcha.getResponse() == ''){
                return false;
            } else {
                // I would like also to check server side if the recaptcha response is good
                return true
            }
        }, 'You must complete the antispam verification');

    $('#register').validate({
        rules:{
            name:{
                required:true
            },
            email:{
                required:true,
                email:true,
            },
            password:{
                required:true,
                minlength:6,
            },
            password_confirmation:{
                equalTo:"#password",
            },
            recaptcha_response_field: {
                                              required: true,
                                              remote: "json.php"
                                   },
           
        },
        messages:{
            name:{
                required:"Name is required"
            },
            email:{
                required:"E-Mail is required",
                email:"E-Mail Address is not validate",
            },
            password:{
                required:"Password is required",
                minlength:"Password must be bigger then 6 chars"
            },
            hiddenRecaptcha:{
            	required:"adasdds",
            }
           
        },
        submitHandler: function(form) {
    if (grecaptcha.getResponse()) {
        form.submit();
    } else {
        $('.captcha').html('Please confirm captcha to proceed')
    }
}
    });
</script>
@endsection
