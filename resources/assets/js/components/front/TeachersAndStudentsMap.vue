<template>
	<div id="map"></div>
</template>
<script>
	export default {
		props: ['teachers', 'students'],
		methods: {
			loadMap: function(){
				var map = new mapboxgl.Map({
					container: 'map', // container id
					style: 'mapbox://styles/mapbox/dark-v9', // stylesheet location
					center: [107.5731162, -6.9034443], // starting position [lng, lat] -6.8665407,106.4835766
					zoom: 7 // starting zoom
				});

				map.scrollZoom.disable();
				map.doubleClickZoom.disable();
				map.dragPan.disable();
			}
		},
		mounted: function(){
			this.loadMap()
		}
	}
</script>
<style scoped>
	body { margin:0; padding:0; }
	#map { position:absolute; top:0; bottom:0; width:100%; }
</style>