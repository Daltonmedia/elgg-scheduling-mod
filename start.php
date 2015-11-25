<?php
/*
Daltonmedia.be
Dries de Krom
*/
elgg_register_event_handler('init', 'system', 'scheduling_mod_init'); 

function scheduling_mod_init() {
       
    elgg_extend_view('forms/scheduling/save', 'forms/scheduling/invite',1);
    elgg_register_plugin_hook_handler('action','scheduling/save', 'add_scheduler_invites');
    elgg_unregister_menu_item('owner_block', 'scheduling');
    elgg_register_page_handler('schedule', 'scheduling_mod_page_handler');
    
    //menu 
    elgg_unregister_menu_item('site','scheduling');
    elgg_register_menu_item('site', array(
	'name' => 'scheduling',
	'text' => elgg_echo('scheduling'),
	'href' => 'schedule',
	));

	
}

function add_scheduler_invites() {
    
$guid = get_input('guid');
$entity = get_entity($guid);
$invites = (array) get_input('invited', array());
if ($invites){
foreach ($invites as $invite){
    $invited = get_entity($invite);
    $owner = $entity->getOwnerEntity();
    $subject = elgg_echo('scheduling:invitation:notification:subject', array(), $invited->language);
    $summary = elgg_echo('scheduling:invitation:notification:summary', array($owner->name), $invited->language);
    $body = elgg_echo('scheduling:invitation:notification:body', array(
        $invited->name,
        $owner->name,
        $entity->getURL(),
    ), $invited->language);

    $params = array(
        'object' => $entity,
        'action' => 'create',
        'summary' => $summary
    );
    add_entity_relationship($guid,'invited_to_schedule',$invite);
    notify_user($invite, $owner, $subject, $body, $params);
    }
}
}

function scheduling_mod_page_handler($page) {
	//elgg_load_library('scheduling');

	if (!isset($page[0])) {
		$page[0] = 'owner';
	}

	elgg_push_breadcrumb(elgg_echo('scheduling'));

	$base_path = elgg_get_plugins_path() . 'elgg-scheduling-mod/pages/';

	switch ($page[0]) {
		default:
			$page_path = 'base.php';
			break;
	}

	include_once($base_path . $page_path);

	return true;
}
