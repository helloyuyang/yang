<?php
/* Smarty version 3.1.29, created on 2016-12-28 01:16:16
  from "D:\wamp\Apache24\htdocs\Project\1224login\application\home\view\question\detail.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5862a1e0e9cd66_51203687',
  'file_dependency' => 
  array (
    'd4a2ae76c87f8710bef3992f963ae6f573e307a7' => 
    array (
      0 => 'D:\\wamp\\Apache24\\htdocs\\Project\\1224login\\application\\home\\view\\question\\detail.html',
      1 => 1482858931,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common/layout.html' => 1,
  ),
),false)) {
function content_5862a1e0e9cd66_51203687 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'D:\\wamp\\Apache24\\htdocs\\Project\\1224login\\framework\\vendor\\smarty\\plugins\\modifier.date_format.php';
$_smarty_tpl->ext->_inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->ext->_inheritance->processBlock($_smarty_tpl, 0, "content", array (
  0 => 'block_71185862a1e0c23fc1_95086990',
  1 => false,
  3 => 0,
  2 => 0,
));
$_smarty_tpl->ext->_inheritance->endChild($_smarty_tpl);
$_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:common/layout.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'content'}  file:question/detail.html */
function block_71185862a1e0c23fc1_95086990($_smarty_tpl, $_blockParentStack) {
?>

<div class="aw-container-wrap">
	<div class="container">
		<div class="row">
			<div class="aw-content-wrap clearfix">
				<div class="col-sm-12 col-md-9 aw-main-content">
					<!-- 话题推荐bar -->
					<!-- 话题推荐bar -->
					<!-- 话题bar -->
					<div data-id="12" data-type="question" id="question_topic_editor" class="aw-mod aw-topic-bar">
						<div class="tag-bar clearfix">
							<span data-id="2" class="topic-tag">
								<a class="text" href="topic.html">
									<?php echo $_smarty_tpl->tpl_vars['question']->value['cat_name'];?>

								</a>
							</span>

						</div>
					</div>
					<!-- end 话题bar -->
					<div class="aw-mod aw-question-detail aw-item">
						<div class="mod-head">
							<h1><?php echo $_smarty_tpl->tpl_vars['question']->value['question_title'];?>
</h1>

						</div>
						<div class="mod-body">
							<div class="content markitup-box"></div>
						</div>
						<div class="mod-footer">
							<div class="meta">
								<span class="text-color-999">
								<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['question']->value['pub_time'],"%Y-%m-%d %H:%M:%S");?>

								</span>

								<a href="publish.html" class="text-color-999">
									<i class="icon icon-edit"></i>
									编辑
								</a>

								<div class="pull-right more-operate">
									<a data-toggle="dropdown" class="text-color-999 dropdown-toggle">
										<i class="icon icon-share"></i>
										分享
									</a>
								</div>
							</div>
						</div>

					</div>

					<div class="aw-mod aw-question-comment">
						<div class="mod-head">
							<ul class="nav nav-tabs aw-nav-tabs active">
								<li>
									<a href="question.html">
										时间
										<i class="icon icon-up"></i>
									</a>
								</li>

								<h2 class="hidden-xs"><?php echo $_smarty_tpl->tpl_vars['answer_count']->value;?>
 个回复</h2>
							</ul>
						</div>
						<div class="mod-body aw-feed-list">
							<?php
$_from = $_smarty_tpl->tpl_vars['answers']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_row_0_saved_item = isset($_smarty_tpl->tpl_vars['row']) ? $_smarty_tpl->tpl_vars['row'] : false;
$_smarty_tpl->tpl_vars['row'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['row']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
$__foreach_row_0_saved_local_item = $_smarty_tpl->tpl_vars['row'];
?>
							<div id="answer_list_3" force_fold="0" uninterested_count="0" class="aw-item">
								<div class="mod-head">
									<a name="answer_3" class="anchor"></a>
									<!-- 用户头像 -->
									<a data-id="3" href="people.html" class="aw-user-img aw-border-radius-5">
										<img alt="" src="<?php echo PUBLIC_PATH;?>
common/avatar-mid-img.png"></a>
									<!-- end 用户头像 -->
									<div class="title">
										<p>
											<a data-id="3" href="people.html" class="aw-user-name">
												<?php echo $_smarty_tpl->tpl_vars['row']->value['username'];?>

											</a>
											-
											<span class="text-color-999">一句话介绍</span>
										</p>
									</div>
								</div>
								<div class="mod-body clearfix">
									<!-- 评论内容 -->
									<div class="markitup-box">
										<?php echo $_smarty_tpl->tpl_vars['row']->value['answer_content'];?>

									</div>

									<!-- end 评论内容 -->
								</div>
								<div class="mod-footer">
									<!-- 社交操作 -->
									<div class="meta clearfix">
										<span class="text-color-999 pull-right">
											<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['row']->value['reply_time'],"%Y-%m-%d %H:%M:%S");?>

										</span>
										<!-- 投票栏 -->
										<span class="operate">
											<a onclick="AWS.User.agree_vote(this, 'itbull', 3);" class="agree  ">
												<i data-original-title="赞同回复" class="icon icon-agree" data-toggle="tooltip" title="" data-placement="right"></i> <b class="count">0</b>
											</a>
											<a onclick="AWS.User.disagree_vote(this, 'itbull', 3)" class="disagree ">
												<i data-original-title="对回复持反对意见" class="icon icon-disagree" data-toggle="tooltip" title="" data-placement="right"></i>
											</a>
										</span>
										<!-- end 投票栏 -->

									</div>
									<!-- end 社交操作 -->
								</div>
							</div>
							<?php
$_smarty_tpl->tpl_vars['row'] = $__foreach_row_0_saved_local_item;
}
if ($__foreach_row_0_saved_item) {
$_smarty_tpl->tpl_vars['row'] = $__foreach_row_0_saved_item;
}
?>
						</div>
						<div class="mod-footer">
							<div id="load_uninterested_answers" class="aw-load-more-content hide">
								<span onclick="AWS.alert('被折叠的回复是被你或者被大多数用户认为没有帮助的回复');" tabindex="-1" href="javascript:;" class="text-color-999 aw-alert-box text-color-999">为什么被折叠?</span>
								<a class="aw-load-more-content" href="javascript:;">
									<span class="hide_answers_count">0</span>
									个回复被折叠
								</a>
							</div>

							<div id="uninterested_answers_list" class="hide aw-feed-list"></div>
						</div>

					</div>
					<!-- end 问题详细模块 -->

					<div class="aw-mod aw-replay-box question">
						<a name="answer_form"></a>
						<form class="question_answer_form" id="answer_form" method="post" 
						action="http://localhost/project/1224login/index.php?m=home&c=question&a=reply">
							
							<div class="mod-head">
								<p>
									<label class="pull-right">
										<input type="checkbox" name="anonymous" value="1">匿名回复</label>
									<label class="pull-right"></label>
								
								</p>
							</div>
							<div class="mod-body">
								<div class="aw-mod aw-editor-box">
									<textarea 
									name="answer_content" rows="10" class="form-control" 
									style="border:1px solid #ccc">
									</textarea>
								</div>
								<!-- 回复编辑器 -->
								<div class="aw-mod aw-replay-box question">
									<a name="answer_form"></a>
									<p align="center">
										<input type="hidden" name="question_id" 
										value="<?php echo $_smarty_tpl->tpl_vars['question']->value['question_id'];?>
">
										<input type="submit" value="发表回复" class="btn btn-success">
									</p>
								</div>
								<!-- end 回复编辑器 -->
							</div>
						</form>
					</div>

					<!-- 回复编辑器 -->
					<?php if (!isset($_SESSION['user'])) {?>
					<div class="aw-mod aw-replay-box question">
						<a name="answer_form"></a>
						<p align="center">
							要回复问题请先
							<a href="http://localhost/wecenter/?/account/login/">登录</a>
							或
							<a href="http://localhost/wecenter/?/account/register/">注册</a>
						</p>
					</div>
					<?php }?>
					<!-- end 回复编辑器 -->
				</div>
				<!-- 侧边栏 -->
				<div class="col-md-3 aw-side-bar hidden-xs hidden-sm">
					<!-- 发起人 -->
					<div class="aw-mod">
						<div class="mod-head">
							<h3>发起人</h3>
						</div>
						<div class="mod-body">
							<dl>
								<dt class="pull-left aw-border-radius-5">
									<a href="http://localhost/wecenter/?/people/itbull">
										<img src="http://localhost/wecenter/uploads/avatar/000/00/00/01_avatar_mid.jpg" alt="itbull"></a>
								</dt>
								<dd class="pull-left">
									<a data-id="1" href="http://localhost/wecenter/?/people/itbull" class="aw-user-name">
										<?php echo $_smarty_tpl->tpl_vars['question']->value['username'];?>

									</a>
									<p></p>
								</dd>
							</dl>
						</div>
					</div>
					<!-- end 发起人 -->

					<!-- 问题状态 -->
					<div class="aw-mod question-status">
						<div class="mod-head">
							<h3>问题状态</h3>
						</div>
						<div class="mod-body">
							<ul>								
								<li>
									浏览:
									<span class="aw-text-color-blue">
										<?php echo (($tmp = @$_smarty_tpl->tpl_vars['question']->value['view_num'])===null||$tmp==='' ? 1 : $tmp);?>

									</span>
								</li>
								<li>
									关注:
									<span class="aw-text-color-blue">
										<?php echo (($tmp = @$_smarty_tpl->tpl_vars['question']->value['focus_num'])===null||$tmp==='' ? 1 : $tmp);?>

									</span>
									人
								</li>								
							</ul>
						</div>
					</div>
					<!-- end 问题状态 -->
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
