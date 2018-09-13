@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" id="register-form">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"  autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" >

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" >

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <select class="chosen" name="area" id="area">
                                    <option value="-1">Выберите область</option>
                                    @foreach( $areas as $area)
                                        <option value="{{$area->id}}">{{$area->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <select name="city" id="city" >
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <select class="chosen" name="region" id="region" >
                                </select>
                            </div>
                        </div>

                        <div id="massageError">
                            <div id="errorList"></div>
                        </div>

                        <div id="exit_user"></div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" id="submit">
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

<script href="{{ asset('/js/chosen.jquery.js') }}" rel="stylesheet"></script>
<script>

    $(function() {
            $('#city').hide();
            $('#region').hide();
            $('#register-form').submit(function (e) {

                var name = $('#name').val();
                var email = $('#email').val();
                var password = $('#password').val();
                var area = $('#area').val();
                var city = $('#city').val();
                var region = $('#region').val();
                var password_confirm = $('#password-confirm').val();
                var fail = [];


                $('#massageError').empty();
                $('#exit_user').empty();
                $.ajax({
                    url:'{{ route('email') }}',
                    type:'GET',
                    data: {
                        '_token':" {{ csrf_token() }}",
                        'email':email,
                    },
                    success:function (data) {
                        if(data['response'] != 'not exit'){
                            $('#massageError').append('<div class="errorList" id="unique">email уже существует , ваши данные: </div>');
                            $.each(data[0], function (key,value) {
                                $('#exit_user').append('<div>'+key+':'+value+'</div>')
                            })
                        }

                    }
                });
                if (name.length === 0 ) {
                    fail.push("введите ФИО");
                };

                if (email.length === 0 ) {
                    fail.push("введите email");
                }

                else if(email.split('@').length -1 == 0 || email.split('.').length - 1 == 0){
                    fail.push("вы ввели не корректный email");
                };

                if (password.length  === 0 ) {
                    fail.push("введите пароль");
                };

                if (password_confirm.length  === 0 ) {
                    fail.push("повторите пароль");
                };

                if (area  == -1 ) {
                    fail.push("укажите область");
                };
                if (city  == -1 ) {
                    fail.push("укажите город");
                };

                if (region == -1 ) {
                    fail.push("укажите район");
                };

                if(fail.length != 0){
                    fail.forEach(function (item) {
                        $('#massageError').append ('<div class="errorList">'+item +'</div>');
                    });
                    return false;
                };
            });

            $('#area').change(function () {
                var area = $('#area').val();
                $('#city').show();
                $.ajax({
                    url:'{{ route('city') }}',
                    type:'GET',
                    data: {
                        '_token':" {{ csrf_token() }}",
                        'area':area,
                    },
                    success: function (data) {
                        $('#city').empty();
                        $('#region').hide();
                        $('#city').append('<option value="-1">Выбрвть город</option>');
                        $.each(data, function (key,value) {
                            $('#city').append('<option value="'+value['id']+'">'+value['title']+'</option>');
                        })
                    }
                });
            });

            $('#city').change(function () {
               var city = $('#city').val();
               $('#region').show();
               $.ajax({
                   url:'{{ route('region') }}',
                   type:'GET',
                   data: {
                       '_token':" {{ csrf_token() }}",
                       'city':city,
                   },
                   success:function (data) {
                       $('#region').empty();
                       $('#region').append('<option value="-1">Выбрать район</option>')
                       $.each(data, function (key,value) {
                            $('#region').append('<option value="'+value['id']+'">'+value['title']+'</option>')
                       })
                   }
               });
            });
    });
</script>
@endsection
