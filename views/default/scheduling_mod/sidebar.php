<?php
$options = array(
	'type' => 'object',
	'subtype' => 'scheduling_poll',
	'full_view' => false,
);

$container_guid = get_input('container_guid');

if ($container_guid) {
	$options['container_guid'] = $container_guid;
}

$content = elgg_list_entities($options);
echo elgg_view_module('aside', elgg_echo('scheduling:sidebar:title'), $content);