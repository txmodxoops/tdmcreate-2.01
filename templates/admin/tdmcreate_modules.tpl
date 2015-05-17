<{include file="admin:tdmcreate/tdmcreate_header.tpl"}>
<{if $modules_count|default:false}>	
	<table class="outer tablesorter">
		<thead>
			<tr>
				<th class="txtcenter"><{translate key='ID'}></th>
				<th class="txtcenter"><{translate key='NAME'}></th>
				<th class="txtcenter"><{translate key='VERSION'}></th>
				<th class="txtcenter"><{translate key='IMAGE'}></th>
				<th class="txtcenter"><{translate key='RELEASE'}></th>
				<th class="txtcenter"><{translate key='STATUS'}></th>
				<th class="txtcenter"><{translate key='ADMIN'}></th>
				<th class="txtcenter"><{translate key='USER'}></th>
				<th class="txtcenter"><{translate key='BLOCKS'}></th>
				<th class="txtcenter"><{translate key='SEARCH'}></th>
				<th class="txtcenter"><{translate key='COMMENTS'}></th>
				<th class="txtcenter"><{translate key='NOTIFICATIONS'}></th>
				<th class="txtcenter"><{translate key='PERMISSIONS'}></th>
				<th class="txtcenter"><{translate key='ACTION'}></th>
			</tr>
		</thead>
		<tbody>
			<{foreach item=module from=$modules}>
				<tr id="module<{$module.id}>" class="modules">
					<td class='center bold'><{$module.id}></td>
					<td class='center bold green'><{$module.name}></td>
					<td class='center'><{$module.version}></td>
					<td class='center'><img src="<{$module.image}>" /></td>
					<td class='center'><{$module.release}></td>
					<td class='center'><{$module.status}></td>
					<td class='xo-actions center'><img id="loading_img_admin<{$module.id}>" src="<{$modPathIcon16}>/spinner.gif" style="display:none;" title="<{translate key='LOADING'}>" alt="<{translate key='LOADING'}>" /><img class="cursorpointer" id="img_admin<{$module.id}>" onclick="Xoops.changeStatus('modules.php', { op: 'display', mod_id: <{$module.id}> }, 'img_admin<{$module.id}>', 'modules.php' )" src="<{if $module.admin}><{xoAdminIcons 'success.png'}><{else}><{xoAdminIcons 'cancel.png'}><{/if}>" alt="<{if $module.name}><{xoAdminIcons 'success.png'}><{else}><{xoAdminIcons 'cancel.png'}><{/if}>" alt="<{if $module.name}><{translate key='NO'}><{else}><{translate key='YES'}><{/if}>" title="<{if $module.name}><{translate key='NO'}><{else}><{translate key='YES'}><{/if}>" />
                    </td>
                    <td class='xo-actions center'><img id="loading_img_user<{$module.id}>" src="<{$modPathIcon16}>/spinner.gif" style="display:none;" title="<{translate key='LOADING'}>" alt="<{translate key='LOADING'}>" /><img class="cursorpointer" id="img_user<{$module.id}>" onclick="Xoops.changeStatus('modules.php', { op: 'display', mod_id: <{$module.id}> }, 'img_user<{$module.id}>', 'modules.php' )" src="<{if $module.user}><{xoAdminIcons 'success.png'}><{else}><{xoAdminIcons 'cancel.png'}><{/if}>" alt="<{if $module.name}><{translate key='NO'}><{else}><{translate key='YES'}><{/if}>" title="<{if $module.name}><{translate key='NO'}><{else}><{translate key='YES'}><{/if}>" />
                    </td>
                    <td class='xo-actions center'><img id="loading_img_blocks<{$module.id}>" src="<{$modPathIcon16}>/spinner.gif" style="display:none;" title="<{translate key='LOADING'}>" alt="<{translate key='LOADING'}>" /><img class="cursorpointer" id="img_blocks<{$module.id}>" onclick="Xoops.changeStatus('modules.php', { op: 'display', mod_id: <{$module.id}> }, 'img_blocks<{$module.id}>', 'modules.php' )" src="<{if $module.blocks}><{xoAdminIcons 'success.png'}><{else}><{xoAdminIcons 'cancel.png'}><{/if}>" alt="<{if $module.name}><{translate key='NO'}><{else}><{translate key='YES'}><{/if}>" title="<{if $module.name}><{translate key='NO'}><{else}><{translate key='YES'}><{/if}>" />
                    </td>                    
                    <td class='xo-actions center'><img id="loading_img_search<{$module.id}>" src="<{$modPathIcon16}>/spinner.gif" style="display:none;" title="<{translate key='LOADING'}>" alt="<{translate key='LOADING'}>" /><img class="cursorpointer" id="img_search<{$module.id}>" onclick="Xoops.changeStatus('modules.php', { op: 'display', mod_id: <{$module.id}> }, 'img_search<{$module.id}>', 'modules.php' )" src="<{if $module.search}><{xoAdminIcons 'success.png'}><{else}><{xoAdminIcons 'cancel.png'}><{/if}>" alt="<{if $module.name}><{translate key='NO'}><{else}><{translate key='YES'}><{/if}>" title="<{if $module.name}><{translate key='NO'}><{else}><{translate key='YES'}><{/if}>" />
                    </td>
                    <td class='xo-actions center'><img id="loading_img_comments<{$module.id}>" src="<{$modPathIcon16}>/spinner.gif" style="display:none;" title="<{translate key='LOADING'}>" alt="<{translate key='LOADING'}>" /><img class="cursorpointer" id="img_comments<{$module.id}>" onclick="Xoops.changeStatus('modules.php', { op: 'display', mod_id: <{$module.id}> }, 'img_comments<{$module.id}>', 'modules.php' )" src="<{if $module.comments}><{xoAdminIcons 'success.png'}><{else}><{xoAdminIcons 'cancel.png'}><{/if}>" alt="<{if $module.name}><{translate key='NO'}><{else}><{translate key='YES'}><{/if}>" title="<{if $module.name}><{translate key='NO'}><{else}><{translate key='YES'}><{/if}>" />
                    </td>
                    <td class='xo-actions center'><img id="loading_img_notifications<{$module.id}>" src="<{$modPathIcon16}>/spinner.gif" style="display:none;" title="<{translate key='LOADING'}>" alt="<{translate key='LOADING'}>" /><img class="cursorpointer" id="img_notifications<{$module.id}>" onclick="Xoops.changeStatus('modules.php', { op: 'display', mod_id: <{$module.id}> }, 'img_notifications<{$module.id}>', 'modules.php' )" src="<{if $module.notifications}><{xoAdminIcons 'success.png'}><{else}><{xoAdminIcons 'cancel.png'}><{/if}>" alt="<{if $module.name}><{translate key='NO'}><{else}><{translate key='YES'}><{/if}>" title="<{if $module.name}><{translate key='NO'}><{else}><{translate key='YES'}><{/if}>" />
                    </td>
                    <td class='xo-actions center'><img id="loading_img_permissions<{$module.id}>" src="<{$modPathIcon16}>/spinner.gif" style="display:none;" title="<{translate key='LOADING'}>" alt="<{translate key='LOADING'}>" /><img class="cursorpointer" id="img_permissions<{$module.id}>" onclick="Xoops.changeStatus('modules.php', { op: 'display', mod_id: <{$module.id}> }, 'img_permissions<{$module.id}>', 'modules.php' )" src="<{if $module.permissions}><{xoAdminIcons 'success.png'}><{else}><{xoAdminIcons 'cancel.png'}><{/if}>" alt="<{if $module.name}><{translate key='NO'}><{else}><{translate key='YES'}><{/if}>" title="<{if $module.name}><{translate key='NO'}><{else}><{translate key='YES'}><{/if}>" />
					</td>
					<td class="xo-actions txtcenter width6">
						<a href="modules.php?op=edit&amp;mod_id=<{$module.id}>" title="<{translate key='A_EDIT'}>">
							<img src="<{xoAdminIcons 'edit.png'}>" alt="<{translate key='A_EDIT'}>" /></a>
						<a href="modules.php?op=delete&amp;mod_id=<{$module.id}>" title="<{translate key='A_DELETE'}>">
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