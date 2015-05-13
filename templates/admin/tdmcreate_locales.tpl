<{include file="admin:system/admin_navigation.tpl"}>
<{include file="admin:system/admin_tips.tpl"}>
<{include file="admin:system/admin_buttons.tpl"}>
<{if $locales_count|default:false}>
	<table width="100%" cellspacing="1" class="outer">
		<thead>
			<tr>
				<th class="txtcenter"><{translate key='ID'}></th>
				<th class="txtcenter"><{translate key='LOCALE_MID'}></th>
				<th class="txtcenter"><{translate key='LOCALE_FILE_NAME'}></th>
				<th class="txtcenter"><{translate key='LOCALE_DEFINE'}></th>
				<th class="txtcenter"><{translate key='LOCALE_DESCRIPTION'}></th>
				<th class="txtcenter"><{translate key='ACTION'}></th>
			</tr>
		</thead>
		<tbody>
			<{foreach item=loc from=$locales}>
				<tr class="<{cycle values='even,odd'}>">
					<td class="txtcenter"><{$loc.id}></td>
					<td class="txtcenter"><{$loc.mid}></td>
					<td class="txtcenter"><{$loc.file}></td>					
					<td class="txtcenter"><{$loc.define}></td>
					<td class="txtcenter"><{$loc.description}></td>
					<td class="xo-actions txtcenter width6">
						<a href="locales.php?op=edit&amp;id=<{$loc.id}>" title="<{translate key='A_EDIT'}>">
							<img src="<{xoAdminIcons 'edit.png'}>" alt="<{translate key='A_EDIT'}>" /></a>
						<a href="locales.php?op=delete&amp;id=<{$loc.id}>" title="<{translate key='A_DELETE'}>">
							<img src="<{xoAdminIcons 'delete.png'}>" alt="<{translate key='A_DELETE'}>" /></a>
					</td>
				</tr>
			<{/foreach}>
		</tbody>
	</table><br />
	<{if $pagenav|default:false}>
		<{$pagenav}>	   
	<{/if}>	
<{/if}>
<!-- Display form (add,edit) -->
<{if $error_message|default:false}>
<div class="alert alert-error">
    <strong><{$error_message}></strong>
</div>
<{/if}>
<{$form|default:''}>