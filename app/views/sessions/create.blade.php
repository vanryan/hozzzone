@extends('base')

@section('title')
	用户登录
@stop

@section('content')
	{{ Form::open(['route'=>'sessions.store']) }}
	<div>
		{{ Form::label('email','Email:') }}
		{{ Form::email('email') }}
	</div>
	<br/>
	<div>
		{{ Form::label('password','Password:') }}
		{{ Form::password('password') }}
	</div>
	<div>
		{{ Form::submit('Sign in') }}
	</div>

	{{ Form::close()}}
@stop