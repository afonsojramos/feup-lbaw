@extends('layouts.app')

@section('title', "Vecto: " . $post->title)

@section('content')
<div class="container">
	<div class="jumbotron pt-3">
		<article>
			<div class="container">
				<div class="row pb-3 bg-faded">
					<div class="text-center col-sm col-lg-2">
						<i class="fas fa-user-circle"></i> <a href="/user/{{ $post->user->username}}">{{ $post->user->username}}</a>
					</div>
					<div class="text-center col-sm col-lg-8">
						<i class="fas fa-map-marker-alt"></i>  <a href="{{ url("search?faculty=" .$post->faculty_to->id) }}">{{ $post->faculty_to->name}}</a>
					</div>
					<div class="text-center col-sm col-lg-2">
						<i class="fas fa-calendar-alt"></i> <a href="{{ url("search?year=" .$post->school_year) }}">{{ $post->school_year}}/{{ $post->school_year + 1}}</a>
					</div>
				</div>
				<div>
					<img src="https://i.imgur.com/KfROBYv.jpg" alt>
					<div class="top-left"><h1>{{ $post->title }}</h1></div>
				</div>
				@include("partials.errors")
				<div class="row">
					<div class="mt-lg-5 pl-lg-0 mb-4 mb-lg-0 text-center col-xs-12 col-lg-2 col-xl-2 col-sm-12">
						<p id="post-votes">
							{{ $post->votes }}
						</p>
						@if(Auth::check())
							<?php $voted = App\Vote::user_voted(Auth::user()->id, $post->id) ?>
							<button type="button" data-toggle="button" class="btn btn-primary {{count($voted->get())>0?"voted":""}}" id = "btn_upvote" post_id="{{$post->id}}" title-0="vote for this post" title-1="remove vote">
								<i class="fas fa-arrow-up"></i>
							</button>
						@endif
					</div>
					<div class="article-text text-justify col-lg-10 col-sm-12 col-xl-10">
						{!! $post->content !!}
						<hr>
						<div class="post-utilities small text-secondary">
							@if(Auth::check())
							<a class="text-secondary" href="{{ url("flag/post/$post->id") }}">
								<i class="fas fa-flag"></i>
								<span>Flag</span>
							</a>
							@endif
							<a class="text-secondary" onclick="copyToClipboard('{{ url("post/$post->id") }}')" href="#">
								<i class="fas fa-share-alt"></i>
								<span>Share</span>
							</a>
							@if($post->isOwner())
							<a class="text-secondary" href="{{ url("post/$post->id/edit") }}">
								<i class="fas fa-edit"></i>
								<span>Edit</span>
							</a>
							@endif
							@if($post->isOwner() || Auth::user()->isAdmin())
							<a class="text-secondary" href="{{ url("post/$post->id/delete") }}">
								<i class="fas fa-trash"></i>
								<span>Delete</span>
							</a>
							@endif
						</div>
					</div>
					
				</div>
				<hr>
				<div class="article-comments">
				@php ($cmCount = count($post->comments()->get()))
				<h2 id="commentCount" data-cc="{{ $cmCount }}">
					@if($cmCount>1)
						{{ $cmCount }} comments:
					@elseif($cmCount==1)
						1 comment:
					@else
						No comments yet.
					@endif
					</h2>
					@each('partials.comment', $post->comments()->get(), 'cm')
					
					@if(Auth::check())
					<br>
					<hr>
					<div class="container add-comment">
						<h3>Add a comment!</h3>
						<div id="addCmError" class="alert alert-danger">
							An error occurred! Please reload the page and try again.
						</div>
						<div class="alert alert-info">
							Please, remember our posting rules: be civilized and respect others!
						</div>
						<form id="newComment" method="POST" action="/api/post/{{ $post->id }}/comment">
							<textarea name="content" class="form-control" id="postContent" required></textarea>
							{{ csrf_field() }}
							<input type="submit" class="btn btn-primary float-right mt-2" id="postSubmit" value="Submit"/>
						</form>
					</div>
					@endif
				</div>
			</div>
		</article>
	</div>
</div>
@endsection


@section("scripts")
@parent {{-- append to the end multiple times in case of multiple scripts --}}
<script src="{{ asset('js/pages/view-post.js') }}" ></script>
@endsection