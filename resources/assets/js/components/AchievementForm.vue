<template>
	<div>
		<button type="button" class="btn btn-primary btn-sm" style="margin-bottom: 5px"
		@click="showModal">
			<i class="fa fa-plus"></i>
			Penghargaan
		</button>
		<div class="table-responsive">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th class="text-center">Tahun</th>
						<th class="text-center">Penghargaan</th>
						<th class="text-center">#</th>
					</tr>
				</thead>
				<tbody>
					<template v-if="achievements.length > 0">
						<tr v-for="(ach, index) in achievements">
							<td class="text-center">{{ ach.year }}</td>
							<td>{{ ach.name }}</td>
							<td class="text-center">
								<div class="btn-group">
									<button type="button" class="btn btn-success btn-xs"
									@click="showCertificate(ach.certificate_url)">
										<i class="fa fa-file-text-o"></i>
									</button>
									<button type="button" class="btn btn-warning btn-xs"
									@click="editAch(ach)">
										<i class="fa fa-edit"></i>
									</button>
									<button type="button" class="btn btn-danger btn-xs"
									@click="deleteAch(ach, index)">
										<i class="fa fa-trash"></i>
									</button>
								</div>
							</td>
						</tr>
					</template>
					<template v-else>
						<tr>
							<td colspan="3">Belum ada Penghargaan</td>
						</tr>
					</template>	
				</tbody>
			</table>
		</div>
		<div class="modal" tabindex="-1" role="dialog" id="AchModal">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Penghargaan</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<label>Nama Penghargaan</label>
									<input type="text" v-model="ach.name" class="form-control">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Tahun</label>
									<input type="text" v-model="ach.year" class="form-control">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Upload Sertifikat</label>
									<input type="file" accept="image/*" class="form-control" @change="onChangeImage">
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button v-if="edit" type="button" class="btn btn-primary" @click="updateAch">Update Changes</button>
						<button v-else type="button" class="btn btn-primary" @click='saveAch'>Save Changes</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<div class="modal" tabindex="-1" role="dialog" id="AchCertificateModal">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Sertifikat</h4>
					</div>
					<div class="modal-body">
						<img :src="selectedCertificate" class="img-responsive">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	</div>
</template>
<script>
	export default {
		props: ['achievementsInit', 'teacherId'],
		data: function(){
			return {
				achievements: this.achievementsInit,
				ach: {
					id: null,
					year:'',
					name: '',
					certificate_image: null
				},
				selectedCertificate: null,
				edit: false
			}
		},

		methods: {
			showModal: function(){
				this.ach.id = null
				this.ach.name = ''
				this.ach.year = ''
				this.ach.certificate_image = null
				this.edit = false
				$('#AchModal').modal('show')
			},
			onChangeImage: function(event){
				let files= event.target.files
				if (files.length) {this.ach.certificate_image = files[0]}
			},
			saveAch: function(){
				let dataObject = {
					achievement_name: this.ach.name,
					achievement_year: this.ach.year,
					achievement_certificate_image: this.ach.certificate_image
				}

				let data = new FormData()
				
				for (var key in dataObject) {
					data.append(key, dataObject[key])
				}

				let url = '/admin/teacher/' + this.teacherId + '/achievement'

				axios.post(url, data)
				.then(response => {
					$('#AchModal').modal('hide')
					this.notify(response.data.message, 'success')
					this.achievements.push(response.data.achievement)
				}).catch(error => {
					var errors = error.response.data.errors
					this.sendErrors(errors)
				})
			},
			updateAch: function(){
				let dataObject = {
					achievement_name: this.ach.name,
					achievement_year: this.ach.year,
					achievement_certificate_image: this.ach.certificate_image
				}

				let data = new FormData()
				
				for (var key in dataObject) {
					data.append(key, dataObject[key])
					data.append('_method', 'PATCH')
				}

				let url = '/admin/teacher/' + this.teacherId + '/achievement/' + this.ach.id

				axios.post(url, data)
				.then(response => {
					$('#AchModal').modal('hide')
					this.notify(response.data.message, 'success')
					var i = this.achievements.findIndex(function(e){return e.id == response.data.achievement.id})
					Vue.set(this.achievements, i, response.data.achievement)
				}).catch(error => {
					var errors = error.response.data.errors
					this.sendErrors(errors)
				})
			},
			showCertificate: function(url){
				this.selectedCertificate = url
				$('#AchCertificateModal').modal('show')
			},
			editAch: function(data){
				this.ach.id = data.id
				this.ach.name = data.name
				this.ach.year = data.year
				this.edit = true
				$('#AchModal').modal('show');
			},
			deleteAch: function(data, index){
				axios.delete('/admin/achievement/'+data.id)
				.then(response => {
					this.notify(response.data.message, 'success')
					this.achievements.splice(index, 1);
				}).catch(error => {
					var errors = error.response.data.errors
					this.sendErrors(errors)
				})
			}
		},

		watch: {
			achievementsInit: function(val){
				this.achievements = val
			}
		}
	}
</script>