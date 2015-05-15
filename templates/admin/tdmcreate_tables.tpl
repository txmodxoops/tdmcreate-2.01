<{include file="admin:tdmcreate/tdmcreate_header.tpl"}>
<{if $modules_count|default:false}>	
	<table class="outer tablesorter">
		<thead>
			<tr>
				<th class='txtcenter'><{translate key="ID"}></th>
				<th class='txtcenter'><{translate key="NAME"}></th>
				<th class='txtcenter'><{translate key="IMAGE"}></th>
				<th class='txtcenter'><{translate key="FIELDS"}></th>
                <th class='txtcenter'><{translate key="BLOCKS"}></th>
				<th class='txtcenter'><{translate key="ADMIN"}></th>
				<th class='txtcenter'><{translate key="USER"}></th>
				<th class='txtcenter'><{translate key="SUBMENU"}></th>
				<th class='txtcenter'><{translate key="SEARCH"}></th>
				<th class='txtcenter'><{translate key="COMMENTS"}></th>
				<th class='txtcenter'><{translate key="NOTIFICATIONS"}></th>
				<th class="txtcenter"><{translate key='PERMISSIONS'}></th>
				<th class='txtcenter'><{translate key="ACTION"}></th>
			</tr>
		</thead>
		<tbody>
			<{foreach item=module from=$modules}>
				<{if $module.id > 0}>
                <tr id="module<{$module.id}>" class="modules toggleMain">
                    <td class='xo-actions center bold width5'>&#40;<{$module.id}>&#41;
                        <a href="#" title="Toggle"><img class="imageToggle" src="<{$modPathIcon16}>/toggle.png" alt="Toggle" /></a>
                    </td>
                    <td class='center bold green name'><{$module.name}></td>
                    <td class='center'><img src="<{$module.image}>" alt="" height="35" /></td>
                    <td class='center'><img src="<{$modPathIcon16}>/fields.png" alt="16" /></td>
                    <td class='center'><img id="loading_img_admin<{$module.id}>" src="<{$modPathIcon16}>/spinner.gif" style="display:none;" title="<{translate key='LOADING'}>" alt="<{translate key='LOADING'}>" /><img style="cursor:pointer;" class="tooltip" id="img_admin<{$module.id}>" onclick="Xoops.changeStatus('modules.php', { op: 'display_modules', mod_id: <{$module.id}> }, 'img_admin<{$module.id}>', 'modules.php' )" src="<{if $module.admin}><{xoAdminIcons 'success.png'}><{else}><{xoAdminIcons 'cancel.png'}><{/if}>" alt="<{if $module.name}><{translate key='NO'}><{else}><{translate key='YES'}><{/if}>" title="<{if $module.name}><{translate key='NO'}><{else}><{translate key='YES'}><{/if}>" />
                    </td>
                    <td class='xo-actions center'><img id="loading_img_user<{$module.id}>" src="<{$modPathIcon16}>/spinner.gif" style="display:none;" title="<{translate key='LOADING'}>" alt="<{translate key='LOADING'}>" /><img style="cursor:pointer;" class="tooltip" id="img_user<{$module.id}>" onclick="Xoops.changeStatus('modules.php', { op: 'display_modules', mod_id: <{$module.id}> }, 'img_user<{$module.id}>', 'modules.php' )" src="<{if $module.user}><{translate key='NO'}><{else}><{translate key='YES'}><{/if}>" title="<{if $module.name}><{translate key='NO'}><{else}><{translate key='YES'}><{/if}>" />
                    </td>
                    <td class='xo-actions center'><img id="loading_img_blocks<{$module.id}>" src="<{$modPathIcon16}>/spinner.gif" style="display:none;" title="<{translate key='LOADING'}>" alt="<{translate key='LOADING'}>" /><img style="cursor:pointer;" class="tooltip" id="img_blocks<{$module.id}>" onclick="Xoops.changeStatus('modules.php', { op: 'display_modules', mod_id: <{$module.id}> }, 'img_blocks<{$module.id}>', 'modules.php' )" src="<{if $module.blocks}><{translate key='NO'}><{else}><{translate key='YES'}><{/if}>" title="<{if $module.name}><{translate key='NO'}><{else}><{translate key='YES'}><{/if}>" />
                    </td>
                    <td class='xo-actions center'><img src="<{$modPathIcon16}>/submenu.png" alt="Submenu" title="Submenu" /></td>
                    <td class='xo-actions center'><img id="loading_img_search<{$module.id}>" src="<{$modPathIcon16}>/spinner.gif" style="display:none;" title="<{translate key='LOADING'}>" alt="<{translate key='LOADING'}>" /><img style="cursor:pointer;" class="tooltip" id="img_search<{$module.id}>" onclick="Xoops.changeStatus('modules.php', { op: 'display_modules', mod_id: <{$module.id}> }, 'img_search<{$module.id}>', 'modules.php' )" src="<{if $module.search}><{translate key='NO'}><{else}><{translate key='YES'}><{/if}>" title="<{if $module.name}><{translate key='NO'}><{else}><{translate key='YES'}><{/if}>" />
                    </td>
                    <td class='xo-actions center'><img id="loading_img_comments<{$module.id}>" src="<{$modPathIcon16}>/spinner.gif" style="display:none;" title="<{translate key='LOADING'}>" alt="<{translate key='LOADING'}>" /><img style="cursor:pointer;" class="tooltip" id="img_comments<{$module.id}>" onclick="Xoops.changeStatus('modules.php', { op: 'display_modules', mod_id: <{$module.id}> }, 'img_comments<{$module.id}>', 'modules.php' )" src="<{if $module.comments}><{translate key='NO'}><{else}><{translate key='YES'}><{/if}>" title="<{if $module.name}><{translate key='NO'}><{else}><{translate key='YES'}><{/if}>" />
                    </td>
                    <td class='xo-actions center'><img id="loading_img_notifications<{$module.id}>" src="<{$modPathIcon16}>/spinner.gif" style="display:none;" title="<{translate key='LOADING'}>" alt="<{translate key='LOADING'}>" /><img style="cursor:pointer;" class="tooltip" id="img_notifications<{$module.id}>" onclick="Xoops.changeStatus('modules.php', { op: 'display_modules', mod_id: <{$module.id}> }, 'img_notifications<{$module.id}>', 'modules.php' )" src="<{if $module.notifications}><{translate key='NO'}><{else}><{translate key='YES'}><{/if}>" title="<{if $module.name}><{translate key='NO'}><{else}><{translate key='YES'}><{/if}>" />
                    </td>
                    <td class='xo-actions center'><img id="loading_img_permissions<{$module.id}>" src="<{$modPathIcon16}>/spinner.gif" style="display:none;" title="<{translate key='LOADING'}>" alt="<{translate key='LOADING'}>" /><img style="cursor:pointer;" class="tooltip" id="img_permissions<{$module.id}>" onclick="Xoops.changeStatus('modules.php', { op: 'display_modules', mod_id: <{$module.id}> }, 'img_permissions<{$module.id}>', 'modules.php' )" src="<{if $module.permissions}><{translate key='NO'}><{else}><{translate key='YES'}><{/if}>" title="<{if $module.name}><{translate key='NO'}><{else}><{translate key='YES'}><{/if}>" />
                    </td>
					<td class='xo-actions txtcenter width6'>
						<a href='modules.php?op=edit&amp;mod_id=<{$module.id}>' title='<{translate key="A_EDIT"}>'>
							<img src="<{xoAdminIcons 'edit.png'}>" alt='<{translate key="A_EDIT"}>' /></a>
						<a href='modules.php?op=delete&amp;mod_id=<{$module.id}>' title='<{translate key="A_DELETE"}>'>
							<img src="<{xoAdminIcons 'delete.png'}>" alt='<{translate key="A_DELETE"}>' /></a>
					</td>
				</tr>
				<tr class="toggleChild">
                    <td class="sortable" colspan="13"><{include file="admin:tdmcreate/tdmcreate_tables_item.tpl" module=$module}></td>
                </tr>
				<{/if}>
			<{/foreach}>
		</tbody>
	</table><br />
	<{if $pagenav|default:false}>
		<{$pagenav}>	   
	<{/if}>
<{/if}>
<{if $error_message|default:false}>
<div class="alert alert-error">
    <strong><{$error_message}></strong>
</div>
<{/if}>
<{$form|default:''}>