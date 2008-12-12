<?php
// put these function somewhere in your application
function smarty_resource_db_source ($tpl_name, &$tpl_source, &$smarty_obj)
{
    // do database call here to fetch your template,
    // populating $tpl_source
    $sql = 'select * from templates where path="' . $tpl_name . '" and module="' . $smarty_obj->compile_id . '" order by `timestamp` desc limit 1';
    $r = Database::singleton()->query_fetch($sql);
    $tpl_source = $r['data'];
    return true;
}

function smarty_resource_db_timestamp($tpl_name, &$tpl_timestamp, &$smarty_obj)
{
	$sql = 'select * from templates where path="' . $tpl_name . '" and module="' . $smarty_obj->compile_id . '" order by `timestamp` desc limit 1';
	$r = Database::singleton()->query_fetch($sql);
    $tpl_timestamp = strtotime($r['timestamp']);
    return true;
}

function smarty_resource_db_secure($tpl_name, &$smarty_obj)
{
    // assume all templates are secure
    return true;
}

function smarty_resource_db_trusted($tpl_name, &$smarty_obj)
{
    // not used for templates
}
?> 