<template>
	<div>
		<div id="map"></div>
	</div>
</template>
<script>
	export default {
		props: ['user'],
		data: function(){
			return {
				userLat: null,
				userLong: null,
				isLoadingMap: false
			}
		},
		watch: {
			isLoadingMap: function(val){
				if (val == true) {
					this.loadMap();
				}
			}
		},
		methods: {
			locateUser: function(){
            	var self = this
        		navigator.geolocation.getCurrentPosition(
        			function(pos){
        				self.userLat = pos.coords.latitude
        				self.userLong = pos.coords.longitude
        				self.isLoadingMap = true
        			}, 
        			function(err){
        				console.log(err)
        			},
        		);
            },
			loadMap: function(){
				var map = new mapboxgl.Map({
					container: 'map',
					style: 'mapbox://styles/mapbox/streets-v11',
					center: [this.userLong, this.userLat], // starting position [lng, lat]
					zoom: 9
				});

				map.addControl(new mapboxgl.FullscreenControl());
				
				var directions = new MapboxDirections({
				    accessToken: mapboxgl.accessToken
				});
				map.addControl(directions, 'top-left');

				directions.setOrigin([this.userLong, this.userLat]);
				directions.setDestination([this.user.lat_long.longitude, this.user.lat_long.latitude]);
			}
		},
		mounted: function(){
			this.locateUser()
		}
	}
</script>
<style scoped>
	body { margin:0; padding:0; }
	#map { width:100%; height: 400px}
</style>