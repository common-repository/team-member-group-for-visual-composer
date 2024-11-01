<?php
			$output  = '
			<style type="text/css">
			
			@media screen and (max-width: 1600px) and (min-width: 960px) {
					 .vc-team-style-1 .my-vc-team-member img, .vc-team-style-2 .my-vc-team-member img, .vc-team-style-3 .my-vc-team-member img, .vc-team-style-4 .my-vc-team-member img, .vc-team-style-6 .my-vc-team-member img, .vc-team-style-7 .my-vc-team-member img, .vc-team-style-10 .my-vc-team-member img {
						  height: 285px;
						}
				}
			@media screen and (max-width: 959px) and (min-width: 768px) {
					.vc-team-style-1 .my-vc-team-member img, .vc-team-style-2 .my-vc-team-member img, .vc-team-style-3 .my-vc-team-member img, .vc-team-style-4 .my-vc-team-member img, .vc-team-style-6 .my-vc-team-member img, .vc-team-style-7 .my-vc-team-member img, .vc-team-style-10 .my-vc-team-member img {
						  height:250px;
						}
				}	
			
			
			
				'.$custom_css.'			
				.vc-team-style-3 .my-vc-team-detail ul li a:hover {
				    background-color: ' . $tmitem_bg_color . ';
				}
				.vc-team-style-2 .my-member-social li a:hover {
					color: #FFF;
					background-color: '.$tmitem_bg_color.';
					/* border: #16a085 1px solid; */
				}
			</style>
			
			';