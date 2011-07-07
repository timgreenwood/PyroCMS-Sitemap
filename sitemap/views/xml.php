<?php
header('Content-Type:text/xml');
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php
	foreach($links as $link) {
		if (isset($link['link'])) {
			echo "<url>\n<loc>".$link['link']."</loc>\n</url>\n";
		} elseif (isset($link['category'])) {
			foreach($link['category'] as $cat){
				echo "<url>\n<loc>".$cat[0]['link']."</loc>\n</url>\n";
				if (isset($cat['posts'])) {
					foreach($cat['posts'] as $post) {
						echo "<url>\n<loc>".$post['link']."</loc>\n</url>\n";
					}
				}
			}
		}
	}
?>
</urlset>
<?php exit; ?>