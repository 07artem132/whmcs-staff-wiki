<script type="text/javascript" src="/modules/addons/StaffWiki/templates/js/shared/bootstrap-select.min.js"></script>
<script type="text/javascript" src="/modules/addons/StaffWiki/templates/js/shared/defaults-ru_RU.min.js"></script>

<form method="post">
    <div class="col-md-12 " style="padding-top: 20px;">
        <table class="form" width="100%" border="0" cellspacing="2" cellpadding="3">
            <tbody>
            <tr>
                <td width="15%" class="fieldlabel">Название</td>
                <td class="fieldarea"><input type="text" name="title" value=""
                                             class="form-control"></td>
            </tr>
            <tr>
                <td class="fieldlabel">Категория</td>
                <td class="fieldarea">
                    <input id="category" name="category" onchange="applyDesk(this.value)" value="" class="form-control">
                </td>
            </tr>
            <tr>
                <td width="15%" class="fieldlabel">Описание категории</td>
                <td class="fieldarea">
                    <input type="text" name="desk" id="desk" value="" class="form-control">
                </td>
            </tr>

            <tr>
                <td class="fieldlabel">Приватность</td>
                <td class="fieldarea">
                    <select name="articlesFilter[]" class="selectpicker" data-width="420px" data-actions-box="true"
                            data-header="Просмотр будет разрешен выбранным пользователям"
                            title="Выберите администраторов которым разрешен доступ к статье" multiple
                            data-live-search="true">
                        {foreach $admins as $admin}
                            <option value="{$admin->id}" data-decs="{$admin->description}">{$admin->username}</option>
                        {/foreach}
                    </select>
                </td>
            </tr>
            </tbody>
        </table>
        <textarea name="article" rows="20" class="form-control tinymce"></textarea>
        <div class="btn-container">
            <input type="submit" value="Добавить статью" class="btn btn-primary">
        </div>
    </div>
</form>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function () {
        var availableCategory = [
            {foreach $categories as $category}
            "{$category->title}",
            {/foreach}
        ];
        $("#category").autocomplete({
            source: availableCategory
        });

    });

    function applyDesk(category) {
        var availableCategory = {
            {foreach $categories as $category}
            "{$category->title}": "{$category->description}",
            {/foreach}
        };

        if (availableCategory.hasOwnProperty(category)) {
            $("#desk").val(availableCategory[category])
        } else {
            $("#desk").val("")
        }
    }
</script>

{literal}
    <script type="text/javascript" src="/assets/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        var tinymceSettings = {
            selector: "textarea.tinymce",
            height: 500,
            theme: "modern",
            entity_encoding: "raw",
            plugins: "autosave print preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media template code codesample table charmap hr pagebreak nonbreaking anchor insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help",
            toolbar: [
                "formatselect,fontselect,fontsizeselect,|,bold,italic,strikethrough,underline,forecolor,backcolor,|,link,unlink,|,justifyleft,justifycenter,justifyright,justifyfull,|,search,replace,|,bullist,numlist,",
                "outdent,indent,blockquote,|,undo,redo,|,cut,copy,paste,pastetext,pasteword,|,table,|,hr,|,sub,sup,|,charmap,media,|,print,|,ltr,rtl,|,fullscreen,|,help,code,removeformat"
            ],
            image_advtab: true,
            content_css: [
                "//fonts.googleapis.com/css?family=Lato:300,300i,400,400i",
                "//www.tinymce.com/css/codepen.min.css"
            ],
            browser_spellcheck: true,
            convert_urls: false,
            relative_urls: false,
            forced_root_block: "p",
            media_poster: false,
            mobile: {
                theme: "mobile",
                plugins: ["autosave", "lists", "autolink"],
                toolbar: ["undo", "bold", "italic", "styleselect"]
            },
            menu: {
                file: {title: "File", items: "preview | print"},
                edit: {title: "Edit", items: "undo redo | cut copy paste pastetext | selectall | searchreplace"},
                view: {title: "View", items: "visualaid visualchars visualblocks | preview fullscreen"},
                insert: {title: "Insert", items: "image link media codesample | charmap hr"},
                format: {
                    title: "Format",
                    items: "bold italic strikethrough underline superscript subscript codeformat | blockformats align | removeformat"
                },
                table: {title: "Table", items: "inserttable tableprops deletetable | cell row column"},
                help: {title: "Help", items: "help | code"}
            }
        };

        $(document).ready(function () {
            tinymce.init(tinymceSettings).then(function (editors) {
                editorLoaded = true;
            });
        });

        var editorEnabled = true,
            editorLoaded = false;

        function toggleEditor() {
            if (editorEnabled === true) {
                tinymce.activeEditor.remove();
                editorEnabled = false;
            } else {
                tinymce.init(tinymceSettings);
                editorEnabled = true;
            }
        }

        function insertMergeField(mfield) {
            tinymce.activeEditor.insertContent('{$' + mfield + '}');
        }

    </script>
{/literal}
