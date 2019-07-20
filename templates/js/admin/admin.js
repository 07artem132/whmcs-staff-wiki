window.addEventListener("load", function () {
    var articles = jQuery("#articles-list").DataTable({
        columnDefs: [
            {
                orderable: false, targets: 0
            }, {
                orderable: false, targets: 1
            },
            {
                orderable: true, targets: 2
            },
            {
                orderable: true, targets: 3
            },
            {
                orderable: true, targets: 4
            },
            {
                orderable: true, targets: 5
            },
            {
                orderable: true, targets: 6
            },
            {
                orderable: false, targets: 7
            },
            {
                orderable: false, targets: 8
            },
        ],
        "order": [
            [
                6, "desc"
            ]
        ],
        "ordering": true,
        "dom": '<"listtable"fit>pl',
        "responsive": true,
        "oLanguage": {
            "sEmptyTable": "Записей не найдено",
            "sInfo": "Показано с _START_ по _END_ из _TOTAL_",
            "sInfoEmpty": "Показано с 0 по 0 из 0",
            "sInfoFiltered": "(отфильтровано из _MAX_ записей)",
            "sInfoPostFix": "",
            "sInfoThousands": ",",
            "sLengthMenu": "Показать _MENU_ записей",
            "sLoadingRecords": "Загрузка...",
            "sProcessing": "Обработка...",
            "sSearch": "",
            "sZeroRecords": "Записей не найдено",
            "oPaginate": {
                "sFirst": "Первая",
                "sLast": "Последняя",
                "sNext": "Вперед",
                "sPrevious": "Назад"
            }
        },
        "pageLength": 100,
        "lengthMenu": [
            [50, 100, 500, -1],
            [50, 100, 500, "Все"]
        ], "stateSave": false
    });

    $('#articles-list tr td:nth-child(1) ').click(function () {
        var id = $.trim($($(this).parent().find('td')[0]).attr('data-id'));
        if (String(window.location).indexOf("index") === -1) {
            window.location = window.location + '&action=view&id=' + id;
        } else {
            window.location = String(window.location).replace("index", "view") + '&id=' + id;
        }
    });
    jQuery(".dataTables_filter input").attr("placeholder", "Условие для поиска...");
    var selectpicker = $('.selectpicker');
    if (selectpicker.length !== 0) {
        selectpicker.selectpicker();
        selectpicker.on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
            var selector = $(e.target);
            var selected;
            if (selector.attr('name') === "CategoryFilter") {
                selected = $("select[name=CategoryFilter]").find("option:selected");
                if (selected.length === 0) {
                    articles.column(2).search("").draw();
                    return;
                }

                articles.column(2).search(("^" + Array.prototype.join.call(selected.map(function (b) {
                    return this.value;
                }), "|") + "$"), !0, !1).draw();
            }

            if (selector.attr('name') === "articlesFilter") {
                selected = $("select[name=articlesFilter]").find("option:selected");
                if (selected.length === 0) {
                    articles.column(3).search("").draw();
                    return;
                }
                articles.column(3).search(("^" + Array.prototype.join.call(selected.map(function (b) {
                    return this.value;
                }), "|") + "$"), !0, !1).draw();
            }
        });
    }
});

window.addEventListener("load", function () {
    $("input[name^=admin_id_]").change(function () {
        $.ajax({
            type: "POST",
            url: window.location.href,
            data: {
                id: $(this).attr('data-id'),
                status: this.checked
            },
            dataType: 'json',
            success: function (data) {
                if (data.status === 'error') {
                    this.fail(data);
                    return;
                }

                $.easyAlert({
                    message: data.message,  //default message to be displayed
                    alertType: 'success', //alert type (warning,info,danger,success)
                    time: 3000, //the time to hide the alert if previous boolean is set to true in ms
                    position: "t r", //preferred position
                    showAnimation: 'slide', //preferred show animation if jQuery ui is included
                    autoHide: true //set whether to automatically hide the alert after a period of time
                });
            },
            fail: function (data) {
                $.easyAlert({
                    message: data.message,  //default message to be displayed
                    alertType: 'danger', //alert type (warning,info,danger,success)
                    time: 3000, //the time to hide the alert if previous boolean is set to true in ms
                    position: "t r", //preferred position
                    showAnimation: 'slide', //preferred show animation if jQuery ui is included
                    autoHide: true //set whether to automatically hide the alert after a period of time
                });
            }
        });
    });
});
