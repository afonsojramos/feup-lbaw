<a class="anchor" id="c{{ $cm->id }}"></a>
<div data-cid="c{{ $cm->id }}" class="p-3 bg-light article-comment">
    <img src="{{File::exists("images/users/icons/".$cm->user->id.".png") ? URL::asset("images/users/icons/".$cm->user->id.".png") : URL::asset("images/profile.png")}}" alt="Profile Picture">
    <h3>{{ $cm->user->username }}</h3>
    <p>{{ $cm->content }}</p>
    <div class="flag-comment small text-secondary">
        @if($cm->isOwner() || (Auth::check() && Auth::user()->isAdmin()))
            <a class="text-secondary delete-comment ajax-link">
                <i class="fas fa-trash"></i>
                <span>Delete</span>
            </a>
        @endif
        @if($cm->isOwner())
            <a class="text-secondary edit-comment ajax-link">
                <i class="fas fa-pencil-alt"></i>
                <span>Edit</span>
            </a>            
        @else
            @if(Auth::check())
            <?php $flag = App\Flag_comment::getFlag(Auth::user()->id, $cm->id) ?>
							
			<a class="text-secondary flag-comment ajax-link" id="Flag" style="cursor:pointer;" onclick="handleFlagComment('{{$flag}}','{{$cm->id}}');">
				<i class="fas fa-flag"></i>
					<span id="FlagSpanCm">{{is_null($flag) ? 'Flag' : 'Remove Flag'}}</span>
            </a>
            @endif
        @endif
    </div>
</div>
