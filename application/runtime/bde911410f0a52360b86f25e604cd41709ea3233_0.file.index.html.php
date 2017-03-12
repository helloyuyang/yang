<?php
/* Smarty version 3.1.29, created on 2016-12-25 15:43:50
  from "D:\wamp\Apache24\htdocs\Project\1223\application\home\view\index.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_585f78b6b0d239_69162598',
  'file_dependency' => 
  array (
    'bde911410f0a52360b86f25e604cd41709ea3233' => 
    array (
      0 => 'D:\\wamp\\Apache24\\htdocs\\Project\\1223\\application\\home\\view\\index.html',
      1 => 1482645190,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common/layout.html' => 1,
  ),
),false)) {
function content_585f78b6b0d239_69162598 ($_smarty_tpl) {
$_smarty_tpl->ext->_inheritance->init($_smarty_tpl, true);
?>
<!-- 继承父类的html -->

<?php 
$_smarty_tpl->ext->_inheritance->processBlock($_smarty_tpl, 0, "content", array (
  0 => 'block_11877585f78b6aa3aa8_44394789',
  1 => false,
  3 => 0,
  2 => 0,
));
?>

<?php $_smarty_tpl->ext->_inheritance->endChild($_smarty_tpl);
$_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:common/layout.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'content'}  file:index.html */
function block_11877585f78b6aa3aa8_44394789($_smarty_tpl, $_blockParentStack) {
?>

<div class="aw-container-wrap">
	<div class="container category">
		<div class="row">
			<div class="col-sm-12">
			<?php
$_from = $_smarty_tpl->tpl_vars['cat_list']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_v_0_saved_item = isset($_smarty_tpl->tpl_vars['v']) ? $_smarty_tpl->tpl_vars['v'] : false;
$_smarty_tpl->tpl_vars['v'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['v']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
$__foreach_v_0_saved_local_item = $_smarty_tpl->tpl_vars['v'];
?>
				<dl>
					<dt>
						<img alt="默认分类" src="<?php echo THUMB_PATH;?>
category/<?php echo $_smarty_tpl->tpl_vars['v']->value['cat_logo'];?>
"></dt>
					<dd>
						<p class="title">
							<a href="category.html"><?php echo $_smarty_tpl->tpl_vars['v']->value['cat_name'];?>
</a>
						</p>
						
					</dd>
				</dl>
			<?php
$_smarty_tpl->tpl_vars['v'] = $__foreach_v_0_saved_local_item;
}
if ($__foreach_v_0_saved_item) {
$_smarty_tpl->tpl_vars['v'] = $__foreach_v_0_saved_item;
}
?>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="aw-content-wrap clearfix">
				<div class="col-sm-12 col-md-9 aw-main-content">
					<!-- end 新消息通知 -->
					<!-- tab切换 -->
					<ul class="nav nav-tabs aw-nav-tabs active hidden-xs">
						<li>
							<a href="">等待回复</a>
						</li>
						<li>
							<a id="sort_control_hot" href="">热门</a>
						</li>
						<li>
							<a href="">推荐</a>
						</li>
						<li class="active">
							<a href="">最新</a>
						</li>

						<h2 class="hidden-xs">
							<i class="icon icon-list"></i>
							发现
						</h2>
					</ul>
					<!-- end tab切换 -->

					<div class="aw-mod aw-explore-list">
						<div class="mod-body">
							<div class="aw-common-list">
								<div data-topic-id="2," class="aw-item active">
									<a rel="nofollow" href="people.html" data-id="1" class="aw-user-name hidden-xs">
										<img alt="" src="<?php echo PUBLIC_PATH;?>
common/avatar-max-img.png"></a>
									<div class="aw-question-content">
										<h4>
											<a href="question.html">PHP可以做什么</a>
										</h4>
										<a class="pull-right text-color-999" href="answer.html">回复</a>

										<p>
											<a href="category.html" class="aw-question-tags">PHP</a>
											•
											<a class="aw-user-name" href="people.html">itbull</a>
											<span class="text-color-999">发起了问题 • 1 人关注 • 0 个回复 • 1 次浏览 • 3 天前</span>
											<span class="text-color-999 related-topic hide">• 来自相关话题</span>
										</p>

									</div>
								</div>
								<div data-topic-id="" class="aw-item active">
									<a rel="nofollow" href="people.html" data-id="1" class="aw-user-name hidden-xs">
										<img alt="" src="<?php echo PUBLIC_PATH;?>
common/avatar-max-img.png"></a>
									<div class="aw-question-content">
										<h4>
											<a href="question.html">PHP的英文是什么</a>
										</h4>
										<a class="pull-right text-color-999" href="answer.html">回复</a>

										<p>
											<a href="category.html" class="aw-question-tags">PHP</a>
											•
											<a class="aw-user-name" href="people.html">itbull</a>
											<span class="text-color-999">发起了问题 • 1 人关注 • 0 个回复 • 1 次浏览 • 3 天前</span>
											<span class="text-color-999 related-topic hide">• 来自相关话题</span>
										</p>

									</div>
								</div>
								<div data-topic-id="" class="aw-item active">
									<a rel="nofollow" href="people.html" data-id="1" class="aw-user-name hidden-xs">
										<img alt="" src="<?php echo PUBLIC_PATH;?>
common/avatar-max-img.png"></a>
									<div class="aw-question-content">
										<h4>
											<a href="question.html">战国七雄是哪几个</a>
										</h4>
										<a class="pull-right text-color-999" href="answer.html">回复</a>

										<p>
											<a href="category.html" class="aw-question-tags">PHP</a>
											•
											<a class="aw-user-name" href="people.html">itbull</a>
											<span class="text-color-999">发起了问题 • 1 人关注 • 0 个回复 • 1 次浏览 • 3 天前</span>
											<span class="text-color-999 related-topic hide">• 来自相关话题</span>
										</p>

									</div>
								</div>
							</div>
						</div>
						<div class="mod-footer">
							<div class="page-control">
								<ul class="pagination pull-right">
									<li class="active">
										<a href="javascript:;">1</a>
									</li>
									<li>
										<a href="?/sort_type-new__day-0__is_recommend-0__page-2">2</a>
									</li>
									<li>
										<a href="?/sort_type-new__day-0__is_recommend-0__page-2">&gt;</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>

				<!-- 侧边栏 -->
				<div class="col-sm-12 col-md-3 aw-side-bar hidden-xs hidden-sm">
					<div class="aw-mod aw-text-align-justify">
						<div class="mod-head">
							<a class="pull-right" href="topic_index.html">更多 &gt;</a>
							<h3>热门话题</h3>
						</div>
						<div class="mod-body">
							<dl>
								<dt class="pull-left aw-border-radius-5">
									<a href="topic.html">
										<img src="<?php echo PUBLIC_PATH;?>
common/topic-mid-img.png" alt=""></a>
								</dt>
								<dd class="pull-left">
									<p class="clearfix">
										<span class="topic-tag">
											<a data-id="2" class="text" href="topic.html">php</a>
										</span>
									</p>
									<p> <b>3</b>
										个问题, <b>1</b>
										人关注
									</p>
								</dd>
							</dl>
							<dl>
								<dt class="pull-left aw-border-radius-5">
									<a href="topic.html">
										<img src="<?php echo PUBLIC_PATH;?>
common/topic-mid-img.png" alt=""></a>
								</dt>
								<dd class="pull-left">
									<p class="clearfix">
										<span class="topic-tag">
											<a data-id="3" class="text" href="topic.html">引力波</a>
										</span>
									</p>
									<p>
										<b>1</b>
										个问题,
										<b>1</b>
										人关注
									</p>
								</dd>
							</dl>
							<dl>
								<dt class="pull-left aw-border-radius-5">
									<a href="topic.html">
										<img src="<?php echo PUBLIC_PATH;?>
common/topic-mid-img.png" alt=""></a>
								</dt>
								<dd class="pull-left">
									<p class="clearfix">
										<span class="topic-tag">
											<a data-id="4" class="text" href="topic.html">引力</a>
										</span>
									</p>
									<p>
										<b>1</b>
										个问题,
										<b>1</b>
										人关注
									</p>
								</dd>
							</dl>
						</div>
					</div>
					<div class="aw-mod aw-text-align-justify">
						<div class="mod-head">
							<a class="pull-right" href="?/people/">更多 &gt;</a>
							<h3>热门用户</h3>
						</div>
						<div class="mod-body">

							<dl>
								<dt class="pull-left aw-border-radius-5">
									<a href="people.html">
										<img src="<?php echo PUBLIC_PATH;?>
common/avatar-mid-img.png" alt=""></a>
								</dt>
								<dd class="pull-left">
									<a class="aw-user-name" data-id="2" href="people.html">bull</a>
									<p class="signature"></p>
									<p>
										<b>1</b>
										个问题,
										<b>0</b>
										次赞同
									</p>
								</dd>
							</dl>
						</div>
					</div>
				</div>
				<!-- end 侧边栏 -->
			</div>
		</div>
	</div>
</div>
<?php
}
/* {/block 'content'} */
}
