<script type="text/javascript" src="/modules/addons/StaffWiki/templates/js/admin/admin.js?v={$smarty.now}"></script>
<script type="text/javascript"
        src="/modules/addons/StaffWiki/templates/js/shared/easy-alert.js?v={$smarty.now}"></script>

{if $allow_edit eq true}
    <form role="form" id="settings" class="label-form">
        <fieldset>
            <br/>
            <div class="row">
                <div class="col-md-3 text-center title">
                    <label>Редактирование разрешено для:</label>
                </div>
                <div class="col-md-2">
                    {foreach $admins as $admin}
                        <div class="checkbox">
                            <input name="admin_id_{$admin->id}" data-id="{$admin->id}" id="admin_id_{$admin->id}"
                                   type="checkbox"
                                   {if $admin->id|array_key_exists:$admins_activated}CHECKED{/if}>
                            <label for="admin_id_{$admin->id}">{$admin->username}</label>
                        </div>
                    {/foreach}
                </div>
            </div>
        </fieldset>
    </form>
{/if}