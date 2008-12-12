{if $user->hasPerm('viewcontentlayers')}
<h3>Page Layers</h3>

<p>{t}This interface allows you to manage your page content.{/t}</p>


{ajaxcall call="/modules/Content/AJAX_layers.php?section=active&parent_id=$parent_id" target="active"}
{ajaxcall call="/modules/Content/AJAX_layers.php?section=inactive&parent_id=$parent_id" target="inactive"}
{/if}