var TableDatatablesAjax = function() {
    var datatableAjax = function(){
        dt = $('#datatable_ajax');
        ajax_datatable = dt.DataTable({
            "processing": true,
            "serverSide": true,
            "searching" : false,
            "ajax": {
                'url' : '/admin/classArticle/ajaxIndex',
                "data": function ( d ) {
                    d.face_img = $('.filter input[name="face_img"]').val();
                    d.adviser_img = $('.filter input[name="adviser_img"]').val();
                    d.cid = $('.filter input[name="cid"]').val();
                    d.title = $('.filter select[name="title"] option:selected').val();
                    d.type = $('.filter input[name="type"]').val();
                    d.url = $('.filter input[name="url"]').val();
                    d.pre_class = $('.filter input[name="preClass"]').val();
                    d.description = $('.filter input[name="description"]').val();
                    d.content = $('.filter input[name="content"]').val();


                }
            },
            "pagingType": "bootstrap_full_number",
            "order" : [],
            "orderCellsTop": true,
            "dom" : "<'row'<'col-sm-3'l><'col-sm-6'<'customtoolbar'>><'col-sm-3'f>>" +"<'row'<'col-sm-12'tr>>" +"<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "columns": [
                {
                    "data": "id",
                    "name" : "id",
                },

                {
                    "data": "cid",
                    "name" : "cid",
                    "orderable" : false,
                },
                {
                    "data": "tid",
                    "name" : "tid",

                },
                {
                    "data": "title",
                    "name": "title",
                    "orderable" : false,
                },
                {
                    "data": "description",
                    "name": "description",
                    "orderable" : false,

                },
                {
                    "data": "type",
                    "name": "type",
                    "orderable" : true,

                },

                {
                    "data": "actionButton",
                    "name": "actionButton",
                    "type": "html",
                    "orderable" : false,
                },
            ],
            "drawCallback": function( settings ) {
                ajax_datatable.$('.tooltips').tooltip( {
                    placement : 'top',
                    html : true
                });
            },

        });

        dt.on('click', '.filter-submit', function(){
            ajax_datatable.ajax.reload();
        });

        dt.on('click', '.filter-cancel', function(){
            $('textarea.form-filter, select.form-filter, input.form-filter', dt).each(function() {
                $(this).val("");
            });

            $('select.form-filter').selectpicker('refresh');

            $('input.form-filter[type="checkbox"]', dt).each(function() {
                $(this).attr("checked", false);
            });
            ajax_datatable.ajax.reload();
        });

        $('.input-group.date').datepicker({
            autoclose: true
        });
        $(".bs-select").selectpicker({
            iconBase: "fa",
            tickIcon: "fa-check"
        });
    };

    return {
        init : datatableAjax
    }
}();