<{include file="admin:tdmcreate/tdmcreate_header.tpl"}>
<{if $tables_count|default:false}>
	<table class="outer tablesorter">
		<thead>
			<tr>
				<th class='txtcenter'><{translate key="ID"}></th>
				<th class='txtcenter'><{translate key="NAME"}></th>
				<th class='txtcenter'><{translate key="FIELDS"}></th>
				<th class='txtcenter'><{translate key="IMAGE"}></th>
				<th class='txtcenter'><{translate key="ADMIN"}></th>
				<th class='txtcenter'><{translate key="USER"}></th>
				<th class='txtcenter'><{translate key="SUBMENU"}></th>
				<th class='txtcenter'><{translate key="SEARCH"}></th>
				<th class='txtcenter'><{translate key="COMMENTS"}></th>
				<th class='txtcenter'><{translate key="NOTIFICATIONS"}></th>
				<th class='txtcenter'><{translate key="ACTION"}></th>
			</tr>
		</thead>
		<tbody>
			<{foreach item=table from=$tables}>
				<{if $table.id > 0}>
                <tr id="table_<{$table.id}>" order="<{$table.order}>" class="tdmc-fields toggleMain">
                    <td class='center bold width5'>&#40;<{$table.lid}>&#41;
                        <a href="#" title="Toggle"><img class="imageToggle" src="<{$modPathIcon16}>/toggle.png" alt="Toggle" /></a>
                    </td>
                    <td class='center' style="text-decoration: underline;"><class='bold'><{$table.name}></td>
                    <td class='center'><img src="<{xoModuleIcons32}><{$table.image}>" title="<{$table.name}>" alt="<{$table.name}>" /></td>
                    <td class='center bold'><{$table.nbfields}></td>
                    <td class='center'><img src="<{$modPathIcon16}>/fields.png" /></td>
                    <td class='center'><img src="<{$modPathIcon16}>/fields.png" /></td>
                    <td class='center'><img src="<{$modPathIcon16}>/fields.png" /></td>
                    <td class='center'><img src="<{$modPathIcon16}>/fields.png" /></td>
                    <td class='center'><img src="<{$modPathIcon16}>/fields.png" /></td>
                    <td class='center'><img src="<{$modPathIcon16}>/fields.png" /></td>
                    <td class='center'><img src="<{$modPathIcon16}>/fields.png" /></td>
                    <td class='center'><img src="<{$modPathIcon16}>/fields.png" /></td>
                    <td class='center'><img src="<{$modPathIcon16}>/fields.png" /></td>
					<td class='xo-actions txtcenter width6'>
						<a href='tables.php?op=edit&amp;id=<{$table.id}>' title='<{translate key="A_EDIT"}>'>
							<img src="<{xoAdminIcons 'edit.png'}>" alt='<{translate key="A_EDIT"}>' /></a>
						<a href='fields.php?op=edit&amp;field_mid=<{$table.mid}>&amp;field_tid=<{$table.id}>' title='<{translate key="A_EDIT_FIELDS"}>'><img src="<{xoAdminIcons 'inserttable.png'}>" alt='<{translate key="A_EDIT_FIELDS"}>' /></a>
						<a href='tables.php?op=delete&amp;id=<{$table.id}>' title='<{translate key="A_DELETE"}>'>
							<img src="<{xoAdminIcons 'delete.png'}>" alt='<{translate key="A_DELETE"}>' /></a>
					</td>
				</tr>
				<tr class="toggleChild">
                    <td class="sortable" colspan="14"><{include file="admin:tdmcreate/tdmcreate_fields_item.tpl" table=$table}></td>
                </tr>
				<{/if}>
			<{/foreach}>
		</tbody>
	</table><br />
	<{if $pagenav|default:false}>
		<{$pagenav}>	   
	<{/if}>	
<{else}>    
	<{$form|default:''}>
<{/if}>
<{if $error_message|default:false}>
<div class="alert alert-error">
    <strong><{$error_message}></strong>
</div>
<{/if}>