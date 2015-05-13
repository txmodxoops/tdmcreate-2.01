<{include file="admin:system/admin_navigation.tpl"}>
<{include file="admin:system/admin_tips.tpl"}>
<{include file="admin:system/admin_buttons.tpl"}>
<{if $building_directory|default:false}>
    <table class="outer tablesorter">
		<thead>
			<tr class="head">
				<th width="80%"><{translate key='L_BUILDING_FILES'}></th>
				<th width="10%"><{translate key='L_BUILDING_SUCCESS'}></th>
				<th width="10%"><{translate key='L_BUILDING_FAILED'}></th>
			</tr>
		</thead>
		<tbody>
			<tr class="even">
				<{if $base_architecture}>
					<td style="padding-left: 30px;"><{$smarty.const._AM_TDMCREATE_OK_ARCHITECTURE}></td>
					<td class="center"><img src="<{xoModuleIcons16 'on.png'}>" alt="<{$smarty.const._AM_TDMCREATE_OK_ARCHITECTURE}>" /></td>
					<td>&nbsp;</td>
				<{else}>
					<td style="padding-left: 30px;"><{$smarty.const._AM_TDMCREATE_NOTOK_ARCHITECTURE}></td>
					<td>&nbsp;</td>
					<td class="center"><img src="<{xoModuleIcons16 'off.png'}>" alt="<{$smarty.const._AM_TDMCREATE_NOTOK_ARCHITECTURE}>" /></td>
				<{/if}>
			</tr>
			<{foreach item=build from=$builds}>
			<tr class="<{cycle values='odd, even'}>">
				<{if $created}>
					<td style="padding-left: 30px;"><{$build.list}></td>
					<td class="center"><img src="<{xoModuleIcons16 'on.png'}>" alt="<{xoModuleIcons16 'on.png'}>" /></td>
					<td>&nbsp;</td>
				<{else}>
					<td style="padding-left: 30px;"><{$build.list}></td>
					<td>&nbsp;</td>
					<td class="center"><img src="<{xoModuleIcons16 'off.png'}>" alt="<{xoModuleIcons16 'off.png'}>" /></td>
				<{/if}>
			</tr>
			<{/foreach}>
			<tr class="<{cycle values='even, odd'}>">
				<td class="center" colspan="3"><{$building_directory}></td>
			<tr>
		</tbody>
	</table><br />
<{else}>
	<{$form|default:''}>
<{/if}>