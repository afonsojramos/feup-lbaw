@extends('layouts.app')

@section('title', 'Vecto: View profile')

@section("opengraph")
<meta property="og:type" content="profile" />
<meta property="og:profile:first_name" content="{{$user->name}}" />
<meta property="og:profile:username" content="{{$user->username}}" />
@endsection

@section('content')

<div class="container">
    <div class="row profile">
        <div class="col-md-3">

            <div class="bg-light rounded mb-3 tp-2 bp-2 profile-sidebar">
                <!-- SIDEBAR USERPIC -->
                <div class="text-center">
                    <img src="{{File::exists("images/users/icons/$user->id.png") ? URL::asset("images/users/icons/$user->id.png") : URL::asset("images/profile.png")}}" class="imgProfile rounded" alt="Profile Pic">
                </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle text-center mt-2">
                    <div class="profile-usertitle-name">
                        {{$user->name}}
                    </div>
                    <div class="profile-usertitle-username">
                        {{$user->username}}
                    </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR BUTTONS -->
                <div class="profile-userbuttons text-center">
                    <button id="follow" type="button" class="btn btn-dark btn-sm mt-1 ajax-link" data-toggle="tooltip" data-placement="bottom" title="Following this user will show all the posts they make on your feed page." onclick="followUser('{{$user->id}}')">{{ User::isFollower($user->id) ? "Follow" : "Unfollow" }}</button>
                </div>
                @if(Auth::check())
                <div class="profile-userbuttons mt-3">
                    <?php $flag = App\Flag_user::getFlag(Auth::user()->id, $user->id) ?>
                    <a class="Sidebar_header" id="Flag" style="cursor:pointer;" onclick="handleFlagUser('{{$flag}}','{{$user->id}}');">
						<i class="fas fa-flag"></i>
						<span id="FlagSpanUsr">{{is_null($flag) ? 'Flag' : 'Remove Flag'}}</span>
					</a>
                </div>
                @endif

                <!-- END SIDEBAR BUTTONS -->
            </div>

            <div class="following-sidebar mb-2">
                <h2 class="Sidebar_header" data-toggle="modal" data-target="#showAllUsersModal">
                    Following
                </h2>
                <div class="followingListExpander">
                    <ul class="AboutListItem list-unstyled">
                        @php $followers = User::getUserFollowers($user->id) @endphp
                        @each('pages.profile.list-followers', $followers, 'user')
                        @if(count($followers) == 0)
                            <p>
                            <span>Looks like this user hasn't followed anyone <i class="far fa-frown"></i></span>
					    @endif
                    </ul>
                </div>
            </div>
        </div>


        <div class="col-md-9">
            <div class="container">
                <div class="jumbotron">
                    <div class="btn-group btn-group-toggle" data-toggle="buttons" id="view-options">
                        <label class="btn btn-secondary active">
                            <input type="radio" name="options" value="option1" checked > About Me </input>
                        </label>
                        <label class="btn btn-secondary">
                            <input type="radio" name="options" value="option2"> Posts </input>
                        </label>
                        <label class="btn btn-secondary">
                            <input type="radio" name="options" value="option3"> Comments </input>
                        </label>
                        <label class="btn btn-secondary">
                            <input type="radio" name="options" value="option4"> Upvotes </input>
                        </label>
                    </div>
                    <br>
                    <br>
                    <section class="jqueryOptions option1">
                        <div class="feed-content">{!! $user->description !!}</div>
                    </section>

                    <section class="jqueryOptions option2 d-none">
                        <div class="feed-content">
                            @php $posts = Post::view_posts($user->id) @endphp
                            @each('pages.post.list-item', $posts, 'post')
                            @if(count($posts) == 0)
                                <p>
                                <span>Looks like this user doesn't have any post <i class="far fa-frown"></i></span>
                            @endif
                        </div>
                    </section>

                    <section class="jqueryOptions option3 d-none">
                        <div class="feed-content">
                            @php $comments = Post::view_posts_comments($user->id) @endphp
                            @each('pages.post.list-item', $comments, 'post')
                            @if(count($comments) == 0)
                                <p>
                                <span>Looks like this user hasn't commented yet <i class="far fa-frown"></i></span>
                            @endif
                        </div>
                    </section>

                    <section class="jqueryOptions option4 d-none">
                        <div class="feed-content">
                            @php $votes = Post::view_posts_votes($user->id) @endphp
                            @each('pages.post.list-item', $votes, 'post')
                            @if(count($votes) == 0)
                                <p>
                                <h4>Looks like this user hasn't upvoted any post <i class="far fa-frown"></i></h4>
                            @endif
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

@include("modals.list-followers")

<script src="{{ asset('js/pages/view-profile.js') }}" defer></script>
<script src="{{ asset('js/pages/admin/flags.js') }}" ></script>

@endsection