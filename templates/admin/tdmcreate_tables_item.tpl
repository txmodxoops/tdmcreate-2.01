<table class='width100'>  
    <tbody class="table-list">
        <{foreach item=table from=$module.tables}>
            <{if $table.id > 0}>
                <tr id="torder_<{$table.id}>" order="<{$table.order}>" class="tables <{cycle values='even,odd'}>">
                    <td class='cell cell-width1'>&#91;<{$table.lid}>&#93;&nbsp;<img class="move" src="<{$modPathIcon16}>/drag.png" alt="<{$table.name}>" /></td>
                    <td class='cell cell-width2 name'><{$table.name}></td>
                    <td class='cell cell-width3'><img src="<{$table.image}>" alt="<{$table.name}>" /></td>
                    <td class='cell cell-width4'><{$table.nbfields}></td>
                    <td class='xo-actions cell cell-width5'><img id="loading_img_table_admin<{$table.id}>" src="<{xoAppUrl 'media/xoops/images/spinner.gif'}>" style="display:none;" title="<{translate key='LOADING'}>" alt="<{translate key='LOADING'}>" /><img class="cursorpointer" id="img_table_admin<{$table.id}>" onclick="Xoops.changeStatus('tables.php', { op: 'display_tables', table_id: <{$table.id}> }, 'img_table_admin<{$table.id}>', 'tables.php' )" src="<{if $table.admin}><{xoAdminIcons 'success.png'}><{else}><{xoAdminIcons 'cancel.png'}><{/if}>" alt="<{if $table.admin}><{translate key='NO'}><{else}><{translate key='YES'}><{/if}>" title="<{if $table.admin}><{translate key='NO'}><{else}><{translate key='YES'}><{/if}>" />
                    </td>
                    <td class='xo-actions cell cell-width6'><img id="loading_img_table_user<{$table.id}>" src="<{xoAppUrl 'media/xoops/images/spinner.gif'}>" style="display:none;" title="<{translate key='LOADING'}>" alt="<{translate key='LOADING'}>" /><img class="cursorpointer" id="img_table_user<{$table.id}>" onclick="Xoops.changeStatus('tables.php', { op: 'display_tables', table_id: <{$table.id}> }, 'img_table_user<{$table.id}>', 'tables.php' )" src="<{if $table.user}><{xoAdminIcons 'success.png'}><{else}><{xoAdminIcons 'cancel.png'}><{/if}>" alt="<{if $table.name}><{translate key='NO'}><{else}><{translate key='YES'}><{/if}>" title="<{if $table.name}><{translate key='NO'}><{else}><{translate key='YES'}><{/if}>" />
                    </td>
                    <td class='xo-actions cell cell-width7'><img id="loading_img_table_blocks<{$table.id}>" src="<{xoAppUrl 'media/xoops/images/spinner.gif'}>" style="display:none;" title="<{translate key='LOADING'}>" alt="<{translate key='LOADING'}>" /><img class="cursorpointer" id="img_table_blocks<{$table.id}>" onclick="Xoops.changeStatus('tables.php', { op: 'display_tables', table_id: <{$table.id}> }, 'img_table_blocks<{$table.id}>', 'tables.php' )" src="<{if $table.blocks}><{xoAdminIcons 'success.png'}><{else}><{xoAdminIcons 'cancel.png'}><{/if}>" alt="<{if $table.name}><{translate key='NO'}><{else}><{translate key='YES'}><{/if}>" title="<{if $table.name}><{translate key='NO'}><{else}><{translate key='YES'}><{/if}>" />
                    </td>
                    <td class='xo-actions cell cell-width8'><img id="loading_img_table_submenu<{$table.id}>" src="<{xoAppUrl 'media/xoops/images/spinner.gif'}>" style="display:none;" title="<{translate key='LOADING'}>" alt="<{translate key='LOADING'}>" /><img class="cursorpointer" id="img_table_submenu<{$table.id}>" onclick="Xoops.changeStatus('tables.php', { op: 'display_tables', table_id: <{$table.id}> }, 'img_table_submenu<{$table.id}>', 'tables.php' )" src="<{if $table.submenu}><{xoAdminIcons 'success.png'}><{else}><{xoAdminIcons 'cancel.png'}><{/if}>" alt="<{if $table.name}><{translate key='NO'}><{else}><{translate key='YES'}><{/if}>" title="<{if $table.name}><{translate key='NO'}><{else}><{translate key='YES'}><{/if}>" />
                    </td>
                    <td class='xo-actions cell cell-width9'><img id="loading_img_table_search<{$table.id}>" src="<{xoAppUrl 'media/xoops/images/spinner.gif'}>" style="display:none;" title="<{translate key='LOADING'}>" alt="<{translate key='LOADING'}>" /><img class="cursorpointer" id="img_table_search<{$table.id}>" onclick="Xoops.changeStatus('tables.php', { op: 'display_tables', table_id: <{$table.id}> }, 'img_table_search<{$table.id}>', 'tables.php' )" src="<{if $table.search}><{xoAdminIcons 'success.png'}><{else}><{xoAdminIcons 'cancel.png'}><{/if}>" alt="<{if $table.name}><{translate key='NO'}><{else}><{translate key='YES'}><{/if}>" title="<{if $table.name}><{translate key='NO'}><{else}><{translate key='YES'}><{/if}>" />
                    </td>
                    <td class='xo-actions cell cell-width10'><img id="loading_img_table_comments<{$table.id}>" src="<{xoAppUrl 'media/xoops/images/spinner.gif'}>" style="display:none;" title="<{translate key='LOADING'}>" alt="<{translate key='LOADING'}>" /><img class="cursorpointer" id="img_table_comments<{$table.id}>" onclick="Xoops.changeStatus('tables.php', { op: 'display_tables', table_id: <{$table.id}> }, 'img_table_comments<{$table.id}>', 'tables.php' )" src="<{if $table.comments}><{xoAdminIcons 'success.png'}><{else}><{xoAdminIcons 'cancel.png'}><{/if}>" alt="<{if $table.name}><{translate key='NO'}><{else}><{translate key='YES'}><{/if}>" title="<{if $table.name}><{translate key='NO'}><{else}><{translate key='YES'}><{/if}>" />
                    </td>
                    <td class='xo-actions cell cell-width11'><img id="loading_img_table_notifications<{$table.id}>" src="<{xoAppUrl 'media/xoops/images/spinner.gif'}>" style="display:none;" title="<{translate key='LOADING'}>" alt="<{translate key='LOADING'}>" /><img class="cursorpointer" id="img_table_notifications<{$table.id}>" onclick="Xoops.changeStatus('tables.php', { op: 'display_tables', table_id: <{$table.id}> }, 'img_table_notifications<{$table.id}>', 'tables.php' )" src="<{if $table.notifications}><{xoAdminIcons 'success.png'}><{else}><{xoAdminIcons 'cancel.png'}><{/if}>" alt="<{if $table.name}><{translate key='NO'}><{else}><{translate key='YES'}><{/if}>" title="<{if $table.name}><{translate key='NO'}><{else}><{translate key='YES'}><{/if}>" />
                    </td>
                    <td class='xo-actions cell cell-width12'><img id="loading_img_table_permissions<{$table.id}>" src="<{xoAppUrl 'media/xoops/images/spinner.gif'}>" style="display:none;" title="<{translate key='LOADING'}>" alt="<{translate key='LOADING'}>" /><img class="cursorpointer" id="img_table_permissions<{$table.id}>" onclick="Xoops.changeStatus('tables.php', { op: 'display_tables', table_id: <{$table.id}> }, 'img_table_permissions<{$table.id}>', 'tables.php' )" src="<{if $table.permissions}><{xoAdminIcons 'success.png'}><{else}><{xoAdminIcons 'cancel.png'}><{/if}>" alt="<{if $table.name}><{translate key='NO'}><{else}><{translate key='YES'}><{/if}>" title="<{if $table.name}><{translate key='NO'}><{else}><{translate key='YES'}><{/if}>" />
                    </td>
                    <td class='xo-actions cell cell-width13'>
						<a href="tables.php?op=edit&amp;table_mid=<{$table.mid}>&amp;table_id=<{$table.id}>" title="<{translate key='A_EDIT'}>">
                           <img src="<{xoModuleIcons16 'edit.png'}>" alt="<{translate key='A_EDIT'}>" />
                        </a>
                        <a href="fields.php?op=edit&amp;field_mid=<{$table.mid}>&amp;field_tid=<{$table.id}>" title="<{translate key='A_EDIT'}>">
                           <img src="<{xoModuleIcons16 'inserttable.png'}>" alt="<{translate key='A_EDIT'}>" />
                        </a>
                        <a href="tables.php?op=delete&amp;table_id=<{$table.id}>" title="<{translate key='A_DELETE'}>">
                           <img src="<{xoModuleIcons16 'delete.png'}>" alt="<{translate key='A_DELETE'}>" />
                        </a>
                    </td>
                </tr>
            <{/if}>
        <{/foreach}>
    </tbody>
</table>