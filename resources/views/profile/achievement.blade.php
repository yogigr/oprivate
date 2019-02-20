<div class="row">
		<div class="col-sm-12">
			<achievement-form :achievements-init="{{ isset($user->achievements) ? $user->achievements : '[]' }}"
			:teacher-id="{{ $user->id }}"></achievement-form>	
		</div>
	</div>