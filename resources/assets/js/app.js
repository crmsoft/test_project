
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

/*require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/*
Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app'
});
*/

/*window.$ = window.jQuery = require( 'jquery' );
require('imports?define=>false!datatables.net')(window, window.$);
*/
require('./bootstrap');
window.$.fn.DataTable = require('datatables.net-bs4');
require('datatables.net-responsive-bs4');
require('datatables.net-responsive');

var mustache = require('mustache');

$(document).ready(function () {

    var $table_companies = $('table#js_companies_datatable')
        ,$table_employees = $('table#js_employees_datatable');

    if($table_companies.prop('id')) {
       create_table($table_companies,[
           {
               "data": "id"
           },
           {
               "data": function(row){
                   return row.logo ? '<img width="50" src="'+row.logo+'" alt="'+row.name+'"/>':''
               }
           },
           {"data": "name"},
           {"data": "email"},
           {"data": "fax"},
           {"data": "phone"},
           {"data": "address"},
           {"data": "website"},
           {"data": "created_at"}
       ]);
    }

    if($table_employees.prop('id')) {
        create_table($table_employees,[
            {"data": "id"},
            {"data": "first_name"},
            {"data": "last_name"},
            {"data": "company.name"},
            {"data": "email"},
            {"data": "phone"},
            {"data": "created_at"}
        ]);
    }
});

function create_table($table,columns){

    // prepare template
    var template = $("#"+$table.prop('id')+'_template').html();
    mustache.parse(template);

    // push actions btns...
    columns.push({"data": function (row) {
            return mustache.render(template, { id:row.id });
        }
    });

    $table.DataTable({
        rowId: 'id',
        paging: true,
        responsive: true,
        serverSide: true,
        ajax: {
            url: $table.data('ajax-url')
        },
        columns: columns
    });
}
//import 'datatables.net-dt/css/jquery.dataTables.css';