<?php
class wordpress extends Module
{
	public function pitchReport()
	{	
		global $smarty;	
		$result = $this->getPostByCategory(PITCH_REPORT, 1);
		$smarty->assign('pitchreport', substr($result[0], 0, 1000));
		return $this->display(__FILE__, 'pitch-report.tpl');
	}
	
	private function getPost($id)
	{
		$con = $this->wordpressConnect();
		$sql = 'SELECT * FROM zeal_posts WHERE post_type=\'post\' AND post_status=\'publish\' AND ID = '.$id;
		$result = mysql_fetch_array(mysql_query($sql, $con));
		return $result;
	}
	
	public function weatherReport()
	{	
		global $smarty;
		$result = $this->getPostByCategory(WEATHER_REPORT, 1);
		$smarty->assign('weatherreport', substr($result[0], 0, 800));
		return $this->display(__FILE__, 'weather-report.tpl');
	}
	
	public function panditSays()
	{	
		global $smarty;
		$result = $this->getPostByCategory(PAANDIT_SAYS, 1);
		$smarty->assign('panditsays', substr($result[0], 0, 500));
		return $this->display(__FILE__, 'pandit-says.tpl');
	}
	
	private function getPostByCategory($id, $limit)
	{
		$con = $this->wordpressConnect();
		$sql = 'SELECT p.post_content AS post_content, p.ID AS id, zp.guid AS thumb, p.post_title FROM zeal_terms t
				INNER JOIN zeal_term_taxonomy tt ON tt.term_taxonomy_id = t.term_id
				INNER JOIN zeal_term_relationships tr ON tr.term_taxonomy_id = tt.term_taxonomy_id
				INNER JOIN zeal_posts p ON p.ID = tr.object_id AND p.post_type=\'post\' AND p.post_status = \'publish\' 
				LEFT OUTER JOIN zeal_postmeta zpm ON zpm.post_id = p.ID AND zpm.meta_key = \'_thumbnail_id\' 
				LEFT OUTER JOIN zeal_posts zp ON zp.ID = zpm.meta_value AND zp.post_type = \'attachment\'
				WHERE t.term_id = '.$id.' ORDER BY p.post_date DESC LIMIT '.$limit;
		$resultResource = mysql_query($sql, $con);
		$post = array();
		$count = 1;
		while($result = mysql_fetch_array($resultResource))
		{
			$post[$count]['content'] = $result['post_content'];
			$post[$count]['id'] = $result['id'];
			$post[$count]['title'] = $result['post_title'];
			$post[$count]['thumb'] = $result['thumb'];
			$count++;
		}
		return $post;
	}
	
	public function prosCorner()
	{	
		global $smarty;	
		$post = $this->getPostByCategory(PROS_CORNER, 2);
		$smarty->assign('proscorner', $post);
		return $this->display(__FILE__, 'pros-corner.tpl');
	}
	
	public function injuryCauses()
	{	
		global $smarty;	
		$post = $this->getPostByCategory(INJURY_CAUSES, 2);
		$smarty->assign('injurycauses', $post);
		return $this->display(__FILE__, 'injury-causes.tpl');
	}
	
	public function getNews()
	{	
		global $smarty;	
		$post = $this->getPostByCategory(NEWS, 3);
		$smarty->assign('news', $post);
		$smarty->assign('catid', NEWS);
		return $this->display(__FILE__, 'news.tpl');
	}
	
	public function getBlogs()
	{	
		global $smarty;	
		$post = $this->getPostByCategory(BLOG, 3);
		$smarty->assign('blogs', $post);
		$smarty->assign('catid', BLOG);
		return $this->display(__FILE__, 'blogs.tpl');
	}
	
	public function starPlayers()
	{	
		global $smarty;	
		$post = $this->getPostByCategory(STAR_PLAYERS, 2);
		$smarty->assign('starplayers', $post);
		return $this->display(__FILE__, 'star-players.tpl');
	}
	
	public function homeResearch()
	{
		global $smarty;	
		//$starPlayer = $this->getPostByCategory(STAR_PLAYERS, 3);
		//$pitchCondition = $this->getPostByCategory(PITCH_REPORT, 1);
		//$weatherReport = $this->getPostByCategory(WEATHER_REPORT, 1);
		//$prosCorners = $this->getPostByCategory(PROS_CORNER, 3);
		$news = $this->getPostByCategory(NEWS, 4);
		//$discussions = $this->getPostByCategory(3, 4);
		$blogs = $this->getPostByCategory(BLOG, 4);
		$smarty->assign('PREVIOUSMATCH', Module::execHook('blocklivescore','previousMatch'));
		$smarty->assign(array(
			//'starPlayers' => $starPlayer,
			//'pitchCondition' => $pitchCondition[1]['content'],
			//'weatherReport' => $weatherReport[1]['content'],
			//'prosCorners' => $prosCorners,
			'news' => $news,
			'blogs' => $blogs
		));
		return $this->display(__FILE__, 'index-content.tpl');
	}
	
	public function wordpressConnect()
	{
		$con = mysql_connect(_WP_DB_SERVER_, _WP_DB_USER_, _WP_DB_PASSWD_, true);
		mysql_select_db(_WP_DB_NAME_, $con);
		return $con;
	}
	
}