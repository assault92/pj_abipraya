<div id="portfoliowrap">
        <div class="portfolio-centered">
        	<h3>
        		<?php $field = 'name'; $alias = $field; ?>
				<?php echo set_value($field, $data->$field); ?>
        	</h3>
        	<div class="row">
        		<div class="col-md-8 col-md-offset-2">
        			<table class="table">
	            		<tr>
	            			<tr>
	            				<th class="text-left">Penginapan</th>
	            				<th class="text-left">Alamat</th>
	            				<th class="text-left">Peruntukan</th>
	            			</tr>
	            			<script type="text/javascript">
	            				var array_coordinate = [];
	            			</script>
	            			<?php foreach($q->result() as $item): ?>
	            			<tr>
	            				<td class="text-left"><?php echo $item->ledging; ?></td>
	            				<td class="text-left"><?php echo $item->address; ?></td>
	            				<td class="text-left">
	            					<?php 
	            						if ($item->for == "ao") {
	            							echo "Atlet / Official";
	            						} else {
	            							echo "TD / Panpel";
	            						}
	            					?>	
	            				</td>
	            			</tr>
	            			<script>
	            				<?php
	            					$coordinat=explode(',', $item->coordinate); 
	            				?>
					      		
	            				array_coordinate.push({0:<?php echo $coordinat[0];?>, 1:<?php echo $coordinat[1];?> })
						    </script>
	            			<?php endforeach; ?>
	            		</tr>
	            	</table>
	            	<style>
 						#map {
				        width: 100%;
				        height: 400px;
				     }
				    </style>
				    <body>
					    <h3>Peta Lokasi Penginapan</h3>
					    <div id="map"></div>
					    <script type="text/javascript">
					    	function initMap() {
					    		// console.log(array_coordinate);
					      		var myLatLng = {lat: -6.903274, lng: 107.5731162}
						        var mapDiv = document.getElementById('map');
						        var map = new google.maps.Map(mapDiv, {
						            center: myLatLng,
						            zoom: 9
						        });

						        for (var index in array_coordinate){
						        	// console.log(index);
						        	// console.log(array_coordinate[index]);
						        	// console.log(array_coordinate[index][0]);
						        	// console.log(array_coordinate[index][1]);

						        	var position = new google.maps.LatLng(array_coordinate[index][0], array_coordinate[index][1]);
							        // bounds.extend(position);
							        marker = new google.maps.Marker({
							            position: position,
							            map: map,
							            // title: markers[index][0]
							        });

							        google.maps.event.addListener(marker, 'click', function () {
									    map.panTo(marker.getPosition());
									    map.setCenter(marker.getPosition()); // sets center without animation
									    map.setZoom(15);
									});

						        }
						        

						       
						      	}
					    </script>
					    <script async defer
					        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQLSlM6BwXXeRlWdCELwdkgbzQu8um8dg&callback=initMap">
					    </script>
					</body>

        		</div>
        	</div>
		</div>
	</div>
<br/>
<br/>