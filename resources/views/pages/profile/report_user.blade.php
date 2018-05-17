@extends('layouts.app')

@section('title', 'Vecto: Flag Profile')


@section("styles")
@parent {{-- append to the end multiple times in case of multiple styles --}}
<link href="{{ asset('css/froala_editor.pkgd.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/froala_style.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/codemirror.min.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="container">
	<div class="jumbotron">
		<h1>Report profile</h1>
		<h4>We are sorry this profile is offensive or inapropriate. Please tell us the reason why you are reporting it!</h4>
        <form action="{{ url("flag/user/$user_id") }}" method="POST">
		 	{{ csrf_field() }}
			@include("partials.errors")
			<div class="form-group">
				<label for="postReason">Your reason</label>
				<textarea class="form-control" id="postReason" name="reason" required>{{ old("reason") }}</textarea>
			</div>
            <div class="form-row">
				<div class="form-group col-lg-9 col-md-8 col-sm-6"></div>
				<div class="form-group col-lg-3 col-md-4 col-sm-6">
					<label for="postSubmit">Submit your report!</label>
					<input type="submit" class="btn btn-primary form-control" id="reportSubmit" value="Submit" />
				</div>
			</div>
		</form>
    </div>
</div>

@endsection

@section("scripts")
@parent {{-- append to the end multiple times in case of multiple scripts --}}
<script type="text/javascript" src="{{ asset('js/external/codemirror.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('js/external/froala_editor.pkgd.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('js/pages/post.js') }}" ></script>
@endsection