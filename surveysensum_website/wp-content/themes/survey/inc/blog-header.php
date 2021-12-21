<?php function blogHeader(){ ?> 

	<script>
	jQuery(document).ready(function($){
	/* Header Scroll & Back to top*/
		jQuery(window).scroll(function() {
			if ($(this).scrollTop() > 1) {
				jQuery('body').addClass("headerSmall");
			} else {
				jQuery('body').removeClass("headerSmall");
			}		
		});
	}); 
	</script>

	<section class="blog-header" id="blog-header">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="blog-header-inner d-flex align-items-center">
						<h2 class="mb-0"><a href="https://www.surveysensum.com/blog/">The CX Insider</a></h2>
							
						<?php wp_nav_menu( array( 'theme_location' => 'Category-Menu', 'menu_class' => "list-inline categories mb-0" ) ); ?> 

						<div class="search-bar">
						
							<?php if(is_active_sidebar( 'blog_search')){ dynamic_sidebar( 'blog_search'); } ?>
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><defs><style>.a{fill:none;}.b{fill:#0052cc;}</style></defs>
								<path class="a" d="M0,0H24V24H0Z"/>
								<path class="b" d="M15.5,14h-.79l-.28-.27a6.518,6.518,0,1,0-.7.7l.27.28v.79l4.25,4.25a1.054,1.054,0,0,0,1.49-1.49Zm-6,0A4.5,4.5,0,1,1,14,9.5,4.494,4.494,0,0,1,9.5,14Z"/>
							</svg>
						</div>

					</div>
					
				</div>
			</div>
		</div>
	</section>

<?php } ?>