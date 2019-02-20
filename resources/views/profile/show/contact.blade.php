<h3>Kontak</h3>
<table class="table">
	<tbody>
		<tr>
			<td>Nomor HP</td>
			<td>
				<a href="tel:{{ $user->contact->phone_number }}" class="text-dark" target="_blank">
					<i class="fa fa-mobile fa-2x"></i>
				</a>
			</td>
		</tr>
		<tr>
			<td>Media Sosial</td>
			<td>
				<a href="https://wa.me/{{ $user->contact->wa_number }}" target="_blank" class="text-success">
					<i class="fa fa-whatsapp fa-2x text-success"></i>
				</a>
				<a href="{{ $user->contact->facebook_url }}" target="_blank" class="text-primary">
					<i class="fa fa-facebook-square fa-2x text-primary"></i>
				</a>
				<a href="{{ $user->contact->instagram_url }}" target="_blank" class="text-primary">
					<i class="fa fa-instagram fa-2x text-danger"></i>
				</a>
			</td>
		</tr>
	</tbody>
</table>
