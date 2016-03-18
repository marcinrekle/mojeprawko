<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Zarezerwuj jazdę</h3>
	</div>
	<div class="panel-body">
		<ul class="nav nav-tabs">
			@foreach( $instructors as $instructor )
			<li @if ($instructor == $instructors->first() ) class="active" @endif >
				<a href="#tab_{{ $instructor->id }}" data-toggle="tab">{{ $instructor->user->name}}</a>
			</li>
			@endforeach
		</ul>
		<div class="tab-content">
			@foreach($instructors as $instructor )
			<div class="tab-pane @if ($instructor == $instructors->first() ) active @endif" id="tab_{{ $instructor->id }}">
				@include('student._drives', [$instructor]) 
			</div>
			@endforeach
		</div>
	</div>
</div>