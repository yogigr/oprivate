<template>
   <div>
       <div class="col-sm-6">
            <div :class="{'form-group': true, 'has-error': provinceHasError}">
                <label>Provinsi</label>
                <select class="form-control" name="province_id" v-model="province_id" @change="getCities(province_id)">
                    <option value>Pilih Provinsi</option>
                    <option v-for="province in provinces" :value="province.id">{{ province.name }}</option>
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div :class="{'form-group': true, 'has-error': cityHasError}">
                <label>Kota/Kabupaten</label>
                <select class="form-control" name="city_id" v-model="city_id">
                    <option value>Pilih Kota/Kabupaten</option>
                    <option v-for="city in cities" :value="city.id">{{ city.type + ' ' + city.name }}</option>
                </select>
            </div>
        </div>
   </div>
</template>

<script>
    export default {
        props: ['errors', 'provinceValue', 'cityValue'],
        data: function(){
            return {
                provinces: [],
                cities: [],
                province_id: this.provinceValue,
                city_id: this.cityValue
            }
        },
        computed: {
            provinceHasError: function(){
                if (this.errors.province_id == undefined) {
                    return false
                }
                return true
            },
            cityHasError: function(){
                if (this.errors.city_id == undefined) {
                    return false
                }
                return true
            }
        }, 

        methods: {
            getProvinces: function(){
                axios.get('/api/provinces')
                .then(response => {
                    this.provinces = response.data
                }).catch(error => {
                    console.log(response.data.error)
                })
            },

            getCities: function(province_id){
                axios.get('/api/cities/'+province_id)
                .then(response => {
                    this.cities = response.data
                }).catch(error => {
                    console.log(response.data.error)
                })
            }
        },

        mounted: function(){
            this.getProvinces();
            if (this.province_id != '') {
                this.getCities(this.province_id)
            }
        }
    }
</script>
