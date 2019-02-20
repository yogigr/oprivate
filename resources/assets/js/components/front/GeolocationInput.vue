<template>
	<div class="row">
		<div class="col-sm-8">
			<div id='map' style="width: 100%; height: 300px"></div>
		</div>
		<div class="col-sm-4">
			<div class="from-group">
				<label>Latitude</label>
				<input type="text" v-model="latitude" name="latitude" 
				:class="{'form-control': true, 'is-invalid': latHasError}" readonly>
			</div>
			<div class="form-group">
				<label>Longitude</label>
				<input type="text" v-model="longitude" name="longitude" 
				:class="{'form-control': true, 'is-invalid': longHasError}" readonly>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		props: ['errors', 'latInit', 'longInit'],
		data: function(){
			return {
				latitude: null,
				longitude: null,
				isLoadingMap: false
			}
		},

		computed: {
            latHasError: function(){
                if (this.errors.latitude == undefined) {
                    return false
                }
                return true
            },
            longHasError: function(){
                if (this.errors.longitude == undefined) {
                    return false
                }
                return true
            },
        },

        watch: {
        	isLoadingMap: function(){
        		this.generateMap()
        	}
        },

        methods: {
        	locateUser: function(){
            	var self = this
        		navigator.geolocation.getCurrentPosition(
        			function(pos){
        				self.latitude = pos.coords.latitude
        				self.longitude = pos.coords.longitude
        				self.isLoadingMap = true
        			}, 
        			function(err){
        				console.log(err)
        			},
        		);
            },

            getLatLong: function(){
            	if (this.latInit == null && this.longInit == null) {
        			this.locateUser()
	        	} else {
	        		this.latitude = this.latInit
	        		this.longitude = this.longInit
	        		this.isLoadingMap = true
	        	}
	        	
            },

            generateMap: function(){
            	var self = this
            	var map = new mapboxgl.Map({
				    container: 'map', // container id
				    style: 'mapbox://styles/mapbox/streets-v11', // stylesheet location
				    center: [self.longitude, self.latitude], // starting position [lng, lat]
				    zoom: 14, // starting zoom
				    
				});

				var geocoder = new MapboxGeocoder({
				    accessToken: mapboxgl.accessToken
				});

				map.addControl(geocoder);

				var canvas = map.getCanvasContainer();

				var geojson = {
				    "type": "FeatureCollection",
				    "features": [{
				        "type": "Feature",
				        "geometry": {
				            "type": "Point",
				            "coordinates": [self.longitude, self.latitude]
				        }
				    }]
				};

				function onMove(e) {
				    var coords = e.lngLat;
				    self.latitude = coords.lat;
				    self.longitude = coords.lng;
				    // Set a UI indicator for dragging.
				    canvas.style.cursor = 'grabbing';

				    // Update the Point feature in `geojson` coordinates
				    // and call setData to the source layer `point` on it.
				    geojson.features[0].geometry.coordinates = [coords.lng, coords.lat];
				    map.getSource('point').setData(geojson);
				}

				function onUp(e) {
				    var coords = e.lngLat;

				    // Unbind mouse/touch events
				    map.off('mousemove', onMove);
				    map.off('touchmove', onMove);
				}
				map.on('load', function() {

				    // Add a single point to the map
				    map.addSource('point', {
				        "type": "geojson",
				        "data": geojson
				    });

				    map.addLayer({
				        "id": "point",
				        "type": "circle",
				        "source": "point",
				        "paint": {
				            "circle-radius": 10,
				            "circle-color": "#3887be"
				        }
					});

				    // When the cursor enters a feature in the point layer, prepare for dragging.
			    	map.on('mouseenter', 'point', function() {
				        map.setPaintProperty('point', 'circle-color', '#3bb2d0');
				        canvas.style.cursor = 'move';
				    });

				    map.on('mouseleave', 'point', function() {
				        map.setPaintProperty('point', 'circle-color', '#3887be');
				        canvas.style.cursor = '';
				    });

				    map.on('mousedown', 'point', function(e) {
				        // Prevent the default map drag behavior.
				        e.preventDefault();

				        canvas.style.cursor = 'grab';

				        map.on('mousemove', onMove);
				        map.once('mouseup', onUp);
				    });

				    map.on('touchstart', 'point', function(e) {
				        if (e.points.length !== 1) return;

				        // Prevent the default map drag behavior.
				        e.preventDefault();

				        map.on('touchmove', onMove);
				        map.once('touchend', onUp);
				    });
				});

				// Listen for the `result` event from the MapboxGeocoder that is triggered when a user
			    // makes a selection and add a symbol that matches the result.
			    geocoder.on('result', function(ev) {
			        map.getSource('point').setData(ev.result.geometry);
			        var coords = ev.result.center;
			        self.latitude = coords[1];
				    self.longitude = coords[0];
			    });
            }
        },

        mounted: function(){
        	this.getLatLong()
        },
	}
</script>