<?php
/* Smarty version 3.1.29, created on 2016-12-25 14:28:04
  from "D:\wamp\Apache24\htdocs\Project\1223\application\home\view\question\add.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_585f66f48f1fb2_99661470',
  'file_dependency' => 
  array (
    '97aeaa06e11d8cf31552aefdee7b47b2d2e3ab92' => 
    array (
      0 => 'D:\\wamp\\Apache24\\htdocs\\Project\\1223\\application\\home\\view\\question\\add.html',
      1 => 1482370575,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common/layout.html' => 1,
  ),
),false)) {
function content_585f66f48f1fb2_99661470 ($_smarty_tpl) {
$_smarty_tpl->ext->_inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->ext->_inheritance->processBlock($_smarty_tpl, 0, "content", array (
  0 => 'block_30267585f66f4878e12_86721882',
  1 => false,
  3 => 0,
  2 => 0,
));
$_smarty_tpl->ext->_inheritance->endChild($_smarty_tpl);
$_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:common/layout.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'content'}  file:question/add.html */
function block_30267585f66f4878e12_86721882($_smarty_tpl, $_blockParentStack) {
?>

<div class="aw-container-wrap">
		<div class="container aw-publish">
			<div class="row">
				<div class="aw-content-wrap clearfix">
					<div class="col-sm-12 col-md-9 aw-main-content">
						<!-- tab 切换 -->
						<ul class="nav nav-tabs aw-nav-tabs active">
																									<li><a href="http://localhost/wecenter/?/publish/article/">文章</a></li>
													<li class="active"><a href="http://localhost/wecenter/?/publish/">问题</a></li>
							<h2 class="hidden-xs"><i class="icon icon-ask"></i> 发起</h2>
						</ul>
						<!-- end tab 切换 -->
						<form id="question_form" method="post" action="?m=home&c=Question&a=addHandle">
								<div class="aw-mod aw-mod-publish">
								<div class="mod-body">
									<h3>问题标题:</h3>
									<!-- 问题标题 -->
									<div class="aw-publish-title">
										<div>
											<input type="text" class="form-control" value="" id="question_contents" name="question_title" placeholder="问题标题...">
											<select style="float:right;margin-top:-35px;height:35px;border-radius:5px" id="category_id" name="cat_id">
												<option value="0">- 顶级分类 -</option>
												<?php
$_from = $_smarty_tpl->tpl_vars['cat_list']->value;
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
													<option value="<?php echo $_smarty_tpl->tpl_vars['row']->value['cat_id'];?>
">
													<?php echo preg_replace('!^!m',str_repeat("&nbsp;&nbsp;&nbsp;",$_smarty_tpl->tpl_vars['row']->value['level']),$_smarty_tpl->tpl_vars['row']->value['cat_name']);?>

													</option>
												<?php
$_smarty_tpl->tpl_vars['row'] = $__foreach_row_0_saved_local_item;
}
if ($__foreach_row_0_saved_item) {
$_smarty_tpl->tpl_vars['row'] = $__foreach_row_0_saved_item;
}
?>
											</select>
										</div>
									</div>
									
									<!-- end 问题标题 -->
	
									<h3>问题补充 (选填):</h3>
									<div class="aw-mod aw-editor-box">
										<div class="mod-head">
											<textarea name="question_desc" class="form-control" rows="10"></textarea>
										</div>
									</div>
									<h3>添加话题:</h3>
									<div data-type="publish" class="aw-topic-bar active">
										<?php
$_from = $_smarty_tpl->tpl_vars['topics']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_topic_1_saved_item = isset($_smarty_tpl->tpl_vars['topic']) ? $_smarty_tpl->tpl_vars['topic'] : false;
$_smarty_tpl->tpl_vars['topic'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['topic']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['topic']->value) {
$_smarty_tpl->tpl_vars['topic']->_loop = true;
$__foreach_topic_1_saved_local_item = $_smarty_tpl->tpl_vars['topic'];
?>
										<label>
											<input type="checkbox" name="topic_id[]" value="<?php echo $_smarty_tpl->tpl_vars['topic']->value['topic_id'];?>
">
											<?php echo $_smarty_tpl->tpl_vars['topic']->value['topic_title'];?>

										</label>
										<?php
$_smarty_tpl->tpl_vars['topic'] = $__foreach_topic_1_saved_local_item;
}
if ($__foreach_topic_1_saved_item) {
$_smarty_tpl->tpl_vars['topic'] = $__foreach_topic_1_saved_item;
}
?>
									</div>
									
																																</div>
								<div class="mod-footer clearfix">
																	<span class="aw-anonymity">
																												<label><input type="checkbox" name="anonymous" value="1" class="pull-left">
											匿名</label>
	
									</span>
									<input type="submit" id="publish_submit" class="btn btn-large btn-success btn-publish-submit" value="确认发起">
								</div>
							</div>
						</form>
					</div>
					<!-- 侧边栏 -->
					<div class="col-sm-12 col-md-3 aw-side-bar hidden-xs">
						<!-- 问题发起指南 -->
						<div class="aw-mod publish-help">
							<div class="mod-head">
								<h3>问题发起指南</h3>
							</div>
							<div class="mod-body">
								<p><b>• 问题标题:</b> 请用准确的语言描述您发布的问题思想</p>
								<p><b>• 问题补充:</b> 详细补充您的问题内容, 并提供一些相关的素材以供参与者更多的了解您所要问题的主题思想</p>
								<p><b>• 选择话题:</b> 选择一个或者多个合适的话题, 让您发布的问题得到更多有相同兴趣的人参与. 所有人可以在您发布问题之后添加和编辑该问题所属的话题</p>
														</div>
						</div>
						<!-- end 问题发起指南 -->
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
