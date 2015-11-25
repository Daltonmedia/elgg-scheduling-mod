<?php
$entity = elgg_extract('entity', $vars);
echo elgg_view_title($vars['entity']->title);



/// No idea how to get the count from elgg_list_entities_from_relationship, so I count them here to see if we have any
$count = elgg_get_entities_from_relationship(array(
		'relationship' => 'invited_to_schedule',
		'relationship_guid' => $entity->guid,
		'inverse_relationship' => false,
        'count' => true,
	));

$invitation_label = elgg_echo('scheduling:invite');
$invitation_input = elgg_view('input/userpicker', array(
	'name' => 'invited',
));
if ($count){
$invited_entities = elgg_list_entities_from_relationship(array(
		'relationship' => 'invited_to_schedule',
		'relationship_guid' => $entity->guid,
		'inverse_relationship' => false,
	));
$invited_label = elgg_echo('scheduling:invited',array($count));

$invitationblock = <<<HTML
    <div>
		<label>$invited_label</label>
		$invited_entities
	</div>
HTML;
$form .= $invitationblock;

}

$form .= <<<FORM
	<div>
		<label>$invitation_label</label>
		$invitation_input
	</div>
FORM;
echo $form;

