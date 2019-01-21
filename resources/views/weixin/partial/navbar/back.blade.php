<header class="demos-header">
	<?php if($withBack != false): ?>
	<a class="title-back" href="javascript:history.back();"><i
		class="fa fa-chevron-left icon-in-list"></i></a>
	<?php endif; ?>
    <div class="demos-title"><?= $title ?? '标题'?></div>
</header>