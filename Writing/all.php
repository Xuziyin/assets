<?php
/**
* 文章归档
*
* @package custom
*/
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<?php
/*通过后端实现按指定条数分页*/
$db = $this->db;
$options = $this->options;
$cut = '50';//每页几篇
$x = 2;//分页间隔
$url = $this->permalink;
$page = 1;
$type = 'post' ;

$total = $db->fetchObject($db->select(array('COUNT(cid)' => 'num'))->from('table.contents')->where('table.contents.type = ?', 'post')->where('table.contents.status = ?', 'publish'))->num;
$total_page = ceil($total/$cut);
if( !empty($_GET["ipage"])){ $page = intval($_GET["ipage"]); }
if( $page>$total_page){$page = $total_page;}
$links = $db->fetchAll($db->select()->from('table.contents')
	->where('table.contents.type = ?', 'post') //只取文章
	->where('table.contents.status = ?', 'publish') //只取已发表
		->page($page, $cut)
		->order('table.contents.created', Typecho_Db::SORT_DESC) //最新排前面
);
?>

<?php $this->need('header.php'); ?>

<div class="col-mb-12 col-8" id="main" role="main">
	<article class="post" itemscope itemtype="http://schema.org/BlogPosting">
		<h1 class="post-title" itemprop="name headline"><a itemtype="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h1>
		<div class="post-content" itemprop="articleBody">
			<ul id="content-list"style="display:block; list-style-type:none; line-height:30px">
				<?php foreach($links as $link): ?>
				<li id="content-<?php _e($link['cid']);?>">◇ 
				<?php
					$routeExists = (NULL != Typecho_Router::get($type));
					$pathinfo = $routeExists ? Typecho_Router::url($type, $link) : '#';
					$permalink = Typecho_Common::url($pathinfo, $options->index);
				?>	
					<a href="<?php _e($permalink);?>"><?php _e($link['title']);?></a>
				</li>
				<?php endforeach;?>
			</ul>
	
		</div>
	</article>

	<ol class="page-navigator">
		<?php
			$frist_page = '<li><a href="'.$url.'?ipage=1">首页</a></li>';
		    $last_page = '<li><a href="'.$url.'?ipage='.$total_page.'">末页</a></li>';
			$now_page=$page;
			$prev_page=$page-1;
			$next_page=$page+1;
			$now_output='<li class="current"><a href="'.$url.'?ipage='.$now_page.'">'.$now_page.'</a></li>';
			$next_output='<li><a href="'.$url.'?ipage='.$next_page.'">下一页</a></li>';
			$perv_output='<li><a href="'.$url.'?ipage='.$prev_page.'">上一页</a></li>';
			$more_page = '<li>...</li>';
			if($total_page==1) {
				echo $now_output;
			} else {
				if($now_page==1) {
					if($total_page-$x>$now_page) {
						echo $now_output;
						for($i=$next_page;$i<=$now_page+$x;$i++) {
							echo '<li><a href="'.$url.'?ipage='.$i.'">'.$i.'</a></li>';
						}
						echo $more_page;
					} else {
						echo $now_output;
						for($i=$next_page;$i<=$total_page;$i++) {
							echo '<li><a href="'.$url.'?ipage='.$i.'">'.$i.'</a></li>';
						}
					}
					echo $next_output;
					echo $last_page;
				} else if($now_page==$total_page) {
					echo $frist_page;
					echo $perv_output;
					if(1+$x<$now_page) {
						echo $more_page;
						for($i=$now_page-$x;$i<$now_page;$i++) {
							echo '<li><a href="'.$url.'?ipage='.$i.'">'.$i.'</a></li>';
						}
						echo $now_output;
					} else {
						for($i=1;$i<$now_page;$i++) {
							echo '<li><a href="'.$url.'?ipage='.$i.'">'.$i.'</a></li>';
						}
						echo $now_output;
					}
				} else {
					echo $frist_page;
					echo $perv_output;
					if(1+$x<$now_page) {
						echo $more_page;
						for($i=$now_page-$x;$i<$now_page;$i++) {
							echo '<li><a href="'.$url.'?ipage='.$i.'">'.$i.'</a></li>';
						}
					} else {
						for($i=1;$i<$now_page;$i++) {
							echo '<li><a href="'.$url.'?ipage='.$i.'">'.$i.'</a></li>';
						}
					}
					echo $now_output;
					if($total_page-$x>$now_page) {
						for($i=$next_page;$i<=$now_page+$x;$i++) {
							echo '<li><a href="'.$url.'?ipage='.$i.'">'.$i.'</a></li>';
						}
						echo $more_page;
					} else {
						for($i=$next_page;$i<=$total_page;$i++) {
							echo '<li><a href="'.$url.'?ipage='.$i.'">'.$i.'</a></li>';
						}
					}
					echo $next_output;
					echo $last_page;
				}
			}
		?>
	</ol>
</div><!-- end #main-->
<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>
