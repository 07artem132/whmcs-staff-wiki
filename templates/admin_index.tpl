<script type="text/javascript"
        src="/modules/addons/StaffWiki/templates/js/shared/dataTables.searchPane.min.js?v={$smarty.now}"></script>
<script type="text/javascript"
        src="/modules/addons/StaffWiki/templates/js/shared/easy-alert.js?v={$smarty.now}"></script>
<script type="text/javascript" src="/modules/addons/StaffWiki/templates/js/admin/admin.js?v={$smarty.now}"></script>
<script type="text/javascript" src="/modules/addons/StaffWiki/templates/js/shared/bootstrap-select.min.js"></script>
<script type="text/javascript" src="/modules/addons/StaffWiki/templates/js/shared/defaults-ru_RU.min.js"></script>
<div class="row pull-right" style="margin-top: 10px;margin-right: 4px;">
    <div class="btn-group">
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#advanced_filter"
                aria-expanded="false" aria-controls="advanced_filter">
            Расширенный фильтр
        </button>
    </div>
    <div class="btn-group">
        <a href="{$modulelink}&action=add" type="button" class="btn btn-success btn-sm ">
            Добавить статью
        </a>
    </div>
</div>
<div class="col-md-12 collapse" id="advanced_filter">
    <select name="CategoryFilter" class="selectpicker" data-width="420px" data-actions-box="true"
            data-header="Выберите категории для отображения"
            title="Категория" multiple data-live-search="true">
        {foreach $categories as $category}
            <option value="{$category->title}">{$category->title}</option>
        {/foreach}    </select>
    <select name="articlesFilter" class="selectpicker" data-width="420px" data-actions-box="true"
            data-header="Выберите авторов для отображения"
            title="Создатель" multiple data-live-search="true">
        {foreach $creators as $creator}
            <option value="{$creator}">{$creator}</option>
        {/foreach}
    </select>
</div>
<div class="col-md-12">
    <div id="tableBackground" class="tablebg">
        <table id="articles-list" width="100%" class="datatable no-margin ">
            <thead>
            <tr>
                <th>
                    Название
                </th>
                <th class="never">
                    Текст
                </th>
                <th>
                    Категория
                </th>
                <th>
                    Создатель
                </th>
                <th>
                    Редактор
                </th>
                <th>
                    Создана
                </th>
                <th>
                    Отредактирована
                </th>
                    <th style="width: 2%;"></th>
                    <th style="width: 2%;"></th>
            </tr>
            </thead>
            <tbody>
            {foreach $articles as $article}
                <tr>
                    <td data-id="{$article->id}" style="cursor: pointer">
                        {$article->title}
                    </td>
                    <td style="display: none">
                        {$article->text|escape:'htmlall'}
                    </td>
                    <td title="{$article->category->description}">
                        {$article->category->title}
                    </td>
                    <td>
                        {$article->creator_id}
                    </td>
                    <td>
                        {$article->editor_id}
                    </td>
                    <td>
                        {$article->created_at->format('Y-m-d')}
                    </td>
                    <td>
                        {$article->updated_at->format('Y-m-d')}
                    </td>

                    <td>
                        {if $allow_edit eq true}
                            <a href="{$modulelink}&action=edit&id={$article->id}">
                                <img src="images/edit.gif" border="0">
                            </a>
                        {/if}
                    </td>
                    <td>
                        {if $allow_edit eq true}
                            <a href="{$modulelink}&action=delete&id={$article->id}">
                                <img src="images/delete.gif" border="0">
                            </a>
                        {/if}
                    </td>

                </tr>
            {/foreach}
            </tbody>
        </table>
    </div>
</div>

