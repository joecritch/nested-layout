<?php include('nested-layout.php'); ?>

<?php $outer = layout('my-outer-layout', array('title' => 'This is my outer layout')) ?>
	<?php $inner = layout('my-inner-layout', array('title' => 'And this is my inner layout')) ?>
		<?php partial('my-partial', array('text' => 'And this is my partial!')) ?>
	<?php $inner->end() ?>
<?php $outer->end() ?>