<div class="row">
	<div class="col-sm-12">
		<education-form :educations-init="{{isset($user->educationals) ? $user->educationals : '[]'}}"
		:teacher-id="{{ $user->id }}"></education-form>
	</div>
</div>