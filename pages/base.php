<?php


$content= elgg_view('scheduling_mod/base');

elgg_register_title_button('scheduling','add');

$title = elgg_echo('scheduling');

$params = array(
	'title' => $title,
	'content' => $content,
	'filter' => '',
    'sidebar' => elgg_view('scheduling_mod/sidebar'),
);

$body = elgg_view_layout('content', $params);

echo elgg_view_page($title, $body);