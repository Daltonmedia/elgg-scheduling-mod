<?php
$owner_guid = elgg_get_logged_in_user_guid();
$options = array(
	'type' => 'object',
	'subtype' => 'scheduling_poll',
	'full_view' => false,
    'owner_guid' => $owner_guid,
);


$content = elgg_list_entities($options);
echo elgg_view_module('aside', elgg_echo('scheduling:sidebar:title'), $content);