<?php
/*
Daltonmedia.be
Dries de Krom
*/
elgg_register_event_handler('init', 'system', 'scheduling_mod_init'); 

function scheduling_mod_init() {
       
    elgg_extend_view('forms/scheduling/days', 'forms/scheduling/invite',1);
    elgg_register_plugin_hook_handler('action','scheduling/days', 'add_scheduler_invites');
    elgg_unregister_menu_item('owner_block', 'scheduling');
    elgg_register_ajax_view('scheduling/invited');
	
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