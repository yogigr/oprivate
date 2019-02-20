<template>
	<div>
		<button type="button" class="btn btn-primary btn-sm" style="margin-bottom: 5px"
		@click="showModal">
			<i class="fa fa-plus"></i>
			Pendidikan
		</button>
		<div class="table-responsive">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th class="text-center">Tahun</th>
						<th class="text-center">Pendidikan</th>
						<th class="text-center">#</th>
					</tr>
				</thead>
				<tbody>
					<template v-if="educations.length > 0">
						<tr v-for="(ed, index) in educations">
							<td class="text-center">{{ ed.start_year }} - {{ ed.end_year }}</td>
							<td>{{ ed.name }}</td>
							<td class="text-center">
								<div class="btn-group">
									<button type="button" class="btn btn-success btn-sm"
									@click="showCertificate(ed.certificate_url)">
										<i class="fa fa-file-text-o"></i>
									</button>
									<button type="button" class="btn btn-warning btn-sm"
									@click="editEd(ed)">
										<i class="fa fa-edit"></i>
									</button>
									<button type="button" class="btn btn-danger btn-sm"
									@click="deleteEd(ed, index)">
										<i class="fa fa-trash"></i>
									</button>
								</div>
							</td>
						</tr>
					</template>
					<template v-else>
						<tr>
							<td colspan="3">Belum ada Riwayat</td>
						</tr>
					</template>	
				</tbody>
			</table>
		</div>
		<div class="modal" tabindex="-1" role="dialog" id="EdModal">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Riwayat Pendidikan</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          	<span aria-hidden="true">&times;</span>
				        </button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label>Dari Tahun</label>
									<input type="text" v-model="ed.start_year" class="form-control">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Sampai Tahun</label>
									<input type="text" v-model="ed.end_year" class="form-control">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Pendidikan</label>
									<input type="text" v-model="ed.name" class="form-control">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Upload Ijazah</label>
									<input type="file" accept="image/*" class="form-control" @change="onChangeImage">
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button v-if="edit" type="button" class="btn btn-primary" @click="updateEd">Update Changes</button>
						<button v-else type="button" class="btn btn-primary" @click='saveEd'>Save Changes</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<div class="modal" tabindex="-1" role="dialog" id="CertificateModal">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Ijazah</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          	<span aria-hidden="true">&times;</span>
				        </button>
					</div>
					<div class="modal-body">
						<img :src="selectedCertificate" class="img-fluid">
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
		props: ['educationsInit', 'teacherId'],
		data: function(){
			return {
				educations: this.educationsInit,
				ed: {
					id: null,
					start_year: '',
					end_year:'',
					name: '',
					certificate_image: null
				},
				selectedCertificate: null,
				edit: false
			}
		},

		methods: {
			showModal: function(){
				this.ed.id = null
				this.ed.name = ''
				this.ed.start_year = ''
				this.ed.end_year = ''
				this.ed.certificate_image = null
				this.edit = false
				$('#EdModal').modal('show')
			},
			onChangeImage: function(event){
				let files= event.target.files
				if (files.length) {this.ed.certificate_image = files[0]}
			},
			saveEd: function(){
				let dataObject = {
					education_name: this.ed.name,
					education_start_year: this.ed.start_year,
					education_end_year: this.ed.end_year,
					education_certificate_image: this.ed.certificate_image
				}

				let data = new FormData()
				
				for (var key in dataObject) {
					data.append(key, dataObject[key])
				}

				let url = '/teacher/profile/educational'

				axios.post(url, data)
				.then(response => {
					$('#EdModal').modal('hide')
					this.notify(response.data.message, 'success')
					this.educations.push(response.data.educational)
				}).catch(error => {
					var errors = error.response.data.errors
					this.sendErrors(errors)
				})
			},
			updateEd: function(){
				let dataObject = {
					education_name: this.ed.name,
					education_start_year: this.ed.start_year,
					education_end_year: this.ed.end_year,
					education_certificate_image: this.ed.certificate_image
				}

				let data = new FormData()
				
				for (var key in dataObject) {
					data.append(key, dataObject[key])
					data.append('_method', 'PATCH')
				}

				let url = '/teacher/profile/educational/' + this.ed.id

				axios.post(url, data)
				.then(response => {
					$('#EdModal').modal('hide')
					this.notify(response.data.message, 'success')
					var i = this.educations.findIndex(function(e){return e.id == response.data.educational.id})
					Vue.set(this.educations, i, response.data.educational)
				}).catch(error => {
					var errors = error.response.data.errors
					this.sendErrors(errors)
				})
			},
			showCertificate: function(url){
				this.selectedCertificate = url
				$('#CertificateModal').modal('show')
			},
			editEd: function(data){
				this.ed.id = data.id
				this.ed.name = data.name
				this.ed.start_year = data.start_year
				this.ed.end_year = data.end_year
				this.edit = true
				$('#EdModal').modal('show');
			},
			deleteEd: function(data, index){
				axios.delete('/teacher/educational/'+data.id)
				.then(response => {
					this.notify(response.data.message, 'success')
					this.educations.splice(index, 1);
				}).catch(error => {
					var errors = error.response.data.errors
					this.sendErrors(errors)
				})
			}
		},

		watch: {
			educationsInit: function(val){
				this.educations = val
			}
		}
	}
</script>