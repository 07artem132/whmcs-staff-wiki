<div class="row pull-right" style="margin-top: 10px;margin-right: 4px;">
    <div class="btn-group   ">
        {if $allow_edit eq true}
            <a href="{$modulelink}&action=edit&id={$article->id}"
               type="button"
               class="btn btn-success btn-sm "
               data-target="#dialog_addRecord"
               onclick="">
                Редактировать
            </a>
            <a href="{$modulelink}&action=delete&id={$article->id}"
               type="button"
               class="btn btn-danger btn-sm "
               data-target="#dialog_addRecord"
               onclick="">
                Удалить
            </a>
        {/if}
    </div>
</div>
<div class="col-md-12 " style="padding-top: 20px;">
    {$article->text|unescape:"html"}
</div>


