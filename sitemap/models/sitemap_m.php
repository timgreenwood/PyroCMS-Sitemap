<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * The sitemap module enables users to view html and xml sitemaps for the content on their site.
 *
 * @author 		Tim Greenwood
 * @package 	PyroCMS
 * @subpackage 	Sitemap Module
 * @category 	Modules
 * @license 	Apache License v2.0
 */
class Sitemap_m extends MY_Model {

	function getLinks()
	{
		// which navigation groups to use
		$navigation_groups = array(1);
		
		$links = array();
		$this->db->select('l.*')->from('navigation_links as l')->where_in('navigation_group_id',$navigation_groups)->order_by('position');
		$navigation = $this->db->get()->result();
		if (count($navigation)) {
			foreach($navigation as $link) {
				switch($link->link_type) {
					case 'module':
						// if it is a blog link then we need to get the blog categories
						if (strtolower($link->module_name) == 'blog') {
							$blog_links = $this->getBlogLinks();
							$links[] = array('title'=>$link->title,'link'=>site_url($link->module_name));
							$links['Blog'] = $blog_links;
						}
					break;
					case 'uri':
						$links[] = array('title'=>$link->title,'link'=>site_url($link->uri));
					break;
					case 'page':
						if ($link_url = $this->getPageUrl($link->page_id)) {
							$links[] = array('title'=>$link->title,'link'=>site_url($link_url));
						}
					break;
					default:
					break;
				}
			}
		}
		return $links;
	}
	
	function getPageUrl($id)
	{
		$this->db->select('slug')->from('pages')->where('id',$id);
		$page = $this->db->get()->result();
		if (count($page)) {
			return $page[0]->slug;
		} else {
			return false;
		}
	}
	
	function getBlogLinks()
	{
		$blog = array();
		$this->db->select('c.*')->from('blog_categories as c')->order_by('title');
		$blog_cats = $this->db->get()->result();
		if (count($blog_cats)) {
			foreach($blog_cats as $cat) {
				$this_cat = array();
				$this_cat[] = array('title'=>$cat->title,'link'=>site_url('blog/category/'.$cat->title));
				// get articles from this category
				$this->db->select('b.*')->from('blog as b')->where('category_id',$cat->id)->where('status','live');
				$blog_cat_posts = $this->db->get()->result();
				$cat_posts = array();
				if (count($blog_cat_posts)) {
					foreach($blog_cat_posts as $post) {
						$cat_posts[] = array('title'=>$post->title,'link'=>site_url('blog/' .date('Y/m', $post->created_on) .'/'. $post->slug));
					}
				}
				if ($cat_posts) {
					$this_cat['posts'] = $cat_posts;
				}
				$blog['category'][$cat->title] = $this_cat;
			}
		}
		return $blog;
	}
}