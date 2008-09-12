<?php 

$c = Page::getByID($_REQUEST['cID']);
$cp = new Permissions($c);
$bt = BlockType::getByID($_REQUEST['btID']);
$a = Area::get($c, $_REQUEST['arHandle']);
if (!is_object($a)) {
	exit;
}
$ap = new Permissions($a);
$canContinue = ($_REQUEST['btask'] == 'alias') ? $ap->canAddBlocks() : $ap->canAddBlock($bt);

if (!$canContinue) {
	exit;
}
	
$c->loadVersionObject('RECENT');
require_once(DIR_FILES_ELEMENTS_CORE . '/dialog_header.php');

if ($ap->canAddBlock($bt)) {

	$bv = new BlockView();
	$bv->render($bt, 'add', array(
		'a' => $a,
		'cp' => $cp,
		'ap' => $ap
	));

}
require_once(DIR_FILES_ELEMENTS_CORE . '/dialog_footer.php'); ?>