<template>
	<div class="row">
		<div class="col-sm-3">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Filter Pencarian</h4>
				</div>
				<div class="card-body border-bottom">
					<div class="form-group">
						<input type="text" class="form-control" v-model="name" placeholder="Nama Guru">
					</div>
					<div class="form-group">
						<select class="custom-select" v-model="gender">
							<option value="">Jenis Kelamin</option>
							<option value="m">Laki-laki</option>
							<option value="f">Perempuan</option>
						</select>
					</div>
					<div class="form-group">
						<label>Umur</label>
						<div class="row">
							<div class="col">
								<input type="number" v-model="min_age" class="form-control" placeholder="Min">
							</div>
							<div class="col">
								<input type="number" v-model="max_age" class="form-control" placeholder="Max">
							</div>
						</div>
					</div>
					<div class="form-group">
						<select class="custom-select" v-model="course_id">
							<option value="">Pilih Mata Pelajaran</option>
							<option v-for="course in courses" :value="course.id">
								{{ course.name }} {{ course.level.short_name }}
							</option>
						</select>
					</div>
				</div>
				<div class="card-body border-bottom">
					<h5>Urut Berdasarkan</h5>
					<div class="form-group">
						<label>Harga</label>
						<div class="custom-control custom-radio mb-1">
							<input type="radio" id="highestPrice" v-model="order_by" value="highest_price" class="custom-control-input">
							<label class="custom-control-label" for="highestPrice">Harga Tertinggi</label>
						</div>
						<div class="custom-control custom-radio">
							<input type="radio" id="lowestPrice" v-model="order_by" value="lowest_price" class="custom-control-input">
							<label class="custom-control-label" for="lowestPrice">Harga Terendah</label>
						</div>
					</div>
					<div class="form-group">
						<label>Rating</label>
						<div class="custom-control custom-radio mb-1">
							<input type="radio" id="highestRate" v-model="order_by" value="highest_rate" class="custom-control-input">
							<label class="custom-control-label" for="highestRate">Rating Tertinggi</label>
						</div>
						<div class="custom-control custom-radio">
							<input type="radio" id="lowestRate" v-model="order_by" value="lowest_rate" class="custom-control-input">
							<label class="custom-control-label" for="lowestRate">Rating Terendah</label>
						</div>
					</div>
					<div class="form-group">
						<button type="button" class="btn btn-primary btn-block"
						@click="searchTeacher()">
							<i class="fa fa-search"></i>
							Cari Guru
						</button>
					</div>
				</div>	
			</div>
		</div>
		<div class="col-sm-9">
			
			<div v-if="loading" class="row justify-content-center my-5">
				<i class="fa fa-spinner fa-spin fa-2x"></i>
			</div>

			<div v-else class="row">
				<template v-if="teachers.length > 0">
					<div v-for="t in teachers" class="col-sm-4">
						<div class="card text-center mb-2">
							<div class="card-body">
								<div class="row justify-content-center mb-3">
									<div class="col-sm-6">
										<img :src="t.profile.image == null ? '/image/no-image.jpg' : 
										(t.role_id == 2 ? '/storage/teacher/'+t.profile.image : '/storage/student/'+t.profile.image)"
										class="img-fluid rounded-circle">
									</div>
								</div>
								<h5>{{ t.name }}</h5>
								<div v-html="t.print_rate_star" class="mb-2"></div>
								<h5><span class="badge badge-success">Rp {{ t.price }}/Pertemuan</span></h5>
								<p class="font-italic">{{ t.course ? t.course.name : '' }} <br> 
								{{ t.course ? t.course.level.name : '' }}</p>
								<a :href="'/profile/'+t.id" class="btn btn-primary">
									Lihat Detail
								</a>
							</div>
						</div>
					</div>
				</template>
				<template v-else>
					<div class="col">
						<div class="card card-body">
							Tidak ditemukan
						</div>
					</div>
				</template>
			</div>
			
		</div>
	</div>
</template>
<script>
	export default {
		data: function(){
			return {
				teachers: [],
				courses: [],
				name: '',
				gender: '',
				min_age: '',
				max_age: '',
				course_id: '',
				order_by: '',
				loading: false
			}
		},

		methods: {
			getCourses: function(){
				axios.get('/api/courses')
				.then(response => {
					this.courses = response.data
				}).catch(error => {
					console.log(error.response.data.errors)
				})
			},
			getTeachers: function(){
				this.loading = true
				axios.get('/api/teachers')
				.then(response => {
					this.loading = false
					this.teachers = response.data
				}).catch(error => {
					this.loading = false
					console.log(error.response.data.errors)
				})
			},
			searchTeacher: function(){
				this.teachers = []
				this.loading = true
				axios.get('search-teacher?name='+this.name+'&gender='+this.gender+'&min_age='+this.min_age+'&max_age='+this.max_age+'&course_id='+this.course_id+'&order_by='+this.order_by)
				.then(response => {
					this.loading = false
					this.teachers = response.data
				}).catch(error => {
					this.loading = false
					console.log(error);
				})

			}
		},

		mounted: function(){
			this.getTeachers()
			this.getCourses();
		}
	}
</script>