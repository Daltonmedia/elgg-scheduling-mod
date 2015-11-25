<style>
    .invitor {
        padding-right:15px;
    }
</style>
<?php
$entity = elgg_extract('entity', $vars);
//echo elgg_view_title($vars['entity']->title, array('class'=>'elgg-main elgg-head'));



// No idea how to get the count from elgg_list_entities_from_relationship, so I count them here to see if we have any
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

$form .= <<<FORM
    <div class='elgg-col elgg-col-1of2'>
        <div class='invitor'>
		<label>$invitation_label</label>
		$invitation_input
        </div>
	</div>
FORM;
echo $form;
if ($count){
$invited_entities = elgg_list_entities_from_relationship(array(
		'relationship' => 'invited_to_schedule',
		'relationship_guid' => $entity->guid,
		'inverse_relationship' => false,
	));
$invited_label = elgg_echo('scheduling:invited',array($count));

$invitationblock = <<<HTML
    <div class='elgg-col elgg-col-1of2'>
        <div class='invited'>
		<label>$invited_label</label>
		$invited_entities
        </div>
	</div>
HTML;
echo $invitationblock;
}

//echo elgg_view_title(elgg_echo('scheduling:invite:title'));


