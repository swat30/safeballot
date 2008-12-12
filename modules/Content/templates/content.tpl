<div style="text-align: left">
<script type="text/javascript">genFlash('/flash/leftCol.swf?pagetitle={$content->getPageTitle()}', 615, 35, '', 'transparent');</script>
{if $content_perms==true}

{$content->getContent()}
{else}
<p> sorry, you need to Pay to see this section. </p>

{/if}
</div>