@extends('frontend.master')

@section('content')


<div class="col-md-10 col-md-offset-1">
    <div class="panel panel-default">
        <div class="panel-heading">Đăng nhập</div>
        <div class="panel-body">

            @if(session('thongbao'))
            <div class="alert alert-danger">

                {{session('thongbao')}}
            </div>

            @endif
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/dang-nhap') }}">
                {!! csrf_field() !!}
                <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">E-Mail<span>*</span></label>

                    <div class="col-md-6">
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Password<span>*</span></label>

                    <div class="col-md-6">
                        <input type="password" class="form-control" name="password">

                        @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>

                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="aa-browse-btn">
                            <i class="fa fa-btn fa-sign-in"></i>Đăng nhập
                        </button>

                        <a class="aa-browse-btn" href="{{ url('dang-ky') }}" type="button"> <i
                                class="fa fa-registered"></i>Đăng kí</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection