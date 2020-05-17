<?php
/**
 * Minimalist for Typecho.
 * &nbsp;
 * The simplicity of life is actually the simplicity of desire.
 * &nbsp;
 * The world is too complicated, so many people gradually fall in love with "simpleness".
 * @package Writing
 * @author Cyclists
 * @version 2.0
 * @link https://inwao.com
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('header.php');
 ?>

<div class="col-mb-12 col-8" id="main" role="main">
	<?php while($this->next()): ?>
        <article class="post" itemscope itemtype="http://schema.org/BlogPosting">
			<h2 class="post-title" itemprop="name headline"><a itemtype="url" href="<?php $this->permalink() ?>"><?php $this->sticky();$this->title() ?><?php if (isset($this->fields->top)): ?>
<?php else: ?></a></h2>
			<ul class="post-meta">
				<li itemprop="author" itemscope itemtype="http://schema.org/Person"><?php _e('Author: '); ?><a itemprop="name" href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author(); ?></a></li>
				<li><?php _e('Time: '); ?><time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date('F j, Y'); ?></time></li>
				<li><?php _e('Sort: '); ?><?php $this->category(','); ?></li>
				<li itemprop="interactionCount"><a itemprop="discussionUrl" href="<?php $this->permalink() ?>#comments"><?php $this->commentsNum('', '1 comment', '%d comment'); ?></a></li>
			</ul>
            <div class="post-content" itemprop="articleBody">
			&#12288;&#12288;
    	    <?php if(preg_match('/<!--more-->/',$this->content)||mb_strlen($this->content, 'utf-8') < 220)
            {
                $this->content('阅读全文>>');
            }
            else
            {    
                    $c=mb_substr($this->content, 0, 220, 'utf-8');
                    $c=preg_replace("/<[img|IMG].*?src=[\'\"](.*?(?:[\.gif|\.jpg|\.jpeg|\.png|\.tiff|\.bmp]))[\'|\"].*?[\/]?>/","",$c);
                    if(preg_match('/<pre>/',$c))
                    {
                       echo $c,'</code></pre>','...';;
                    }
                    else
                    {
                       echo $c.'...';
                    }
                    echo '</br><p class="more"><a href="',$this->permalink(),'" title="',$this->title(),'">阅读全文>></a></p>';
            }
        ?>	
			
            </div>
<?php endif; ?>
        </article>
	<?php endwhile; ?>
    <?php $this->pageNav('&laquo; 前一页', '后一页 &raquo;', 1, '...',array('wrapClass' => 'page-navigator ajaxload')); ?>
</div><!-- end #main-->

<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>