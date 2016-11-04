var TableDatatablesAjax = function() {
  var datatableAjax = function(){
    dt = $('#datatable_ajax');
    ajax_datatable = dt.DataTable({
      "processing": true,
      "serverSide": true,
      "searching" : false,
      "ajax": {
        'url' : '/admin/adviserArticle/ajaxIndex',
        "data": function ( d ) {
          d.department = $('.filter select[name="department"] option:selected').val();
          d.cnName = $('.filter input[name="cnName"]').val();
          d.enName = $('.filter input[name="enName"]').val();
          d.area = $('.filter select[name="area"] option:selected').val();
          d.phone = $('.filter input[name="phone"]').val();
          d.email = $('.filter input[name="email"]').val();

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
          "data": "department",
          "name" : "department",

        },
        {
          "data": "cnName",
          "name": "cnName",

        },
        {
          "data": "enName",
          "name": "enName",
        },
        {
          "data": "area",
          "name": "area",

        },
        {
          "data": "phone",
          "name": "phone",

        },
        {
          "data": "email",
          "name": "email",
        },
      ],
      "drawCallback": function( settings ) {
        ajax_datatable.$('.tooltips').tooltip( {
          placement : 'top',
          html : true
        });
      },
      "language": {
        url: '/admin/i18n'
      }
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