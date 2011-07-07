<div class="container content sitemap">
	<div class="row border">
		<div class="twelvecol">
			<h1>Sitemap</h1>
			<ul>
			<?php
			foreach($links as $link) {
				if (isset($link['link']) && isset($link['title'])) {
					echo '<li>'.anchor($link['link'], $link['title']).'</li>';
				} elseif (isset($link['category'])) {
					foreach($link['category'] as $cat){
						echo '<li class="sub-1">'.anchor($cat[0]['link'], $cat[0]['title']).'</li>';
						if (isset($cat['posts'])) {
							foreach($cat['posts'] as $post) {
								echo '<li class="sub-2">'.anchor($post['link'], $post['title']).'</li>';
							}
						}
					}
				}
			}
			?>
			</ul>
		</div>
	</div>
</div>