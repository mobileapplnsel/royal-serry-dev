// Admin Panel Javascript Operations.

// base url

function base_url() {

    var pathparts = location.pathname.split('/');

    if (location.host == 'localhost') {

        var url = location.origin + '/' + pathparts[1].trim('/') + '/'; // http://localhost/myproject/
        var url = "http://localhost/project/royal-serry-dev/";

    } else {

        var url = 'https://develop-rss.staqo.com/'; // http://stackoverflow.com

    }
   
    return url;

}



function select2Ajax(elm, table, field) {

    $('#' + elm).select2({

        placeholder: '-Select Area Postcode -',

        delay: 250,

        //tags: true,

        multiple: true,

        //tokenSeparators: [',', ' '],

        minimumInputLength: 3,

        minimumResultsForSearch: 1,

        ajax: {

            url: function(params) {

                return base_url() + 'branch/getallareaListbysearchkey?field=' + field + '&tbl_name=' + table;

            },

            dataType: "json",

            type: "GET",

            data: function(params) {

                return {

                    text: params.term

                };

            },

            processResults: function(data) {

                return {

                    results: $.map(data, function(obj) {

                        return {

                            id: obj.id,

                            text: obj.text

                        };

                    })

                };

            }

        }

    });

}





function getallBranchAjax(elm, table, field, from_branch_id, to_branch_id) {

	//alert(from_branch_id);alert(to_branch_id);

    $('#' + elm).select2({

        placeholder: '-Select Via Branch Name -',

        delay: 250,

        //tags: true,

        multiple: true,

        //tokenSeparators: [',', ' '],

        minimumInputLength: 3,

        minimumResultsForSearch: 1,

        ajax: {

            url: function(params) {

                return base_url() + 'branch/getallBranchListbysearchkey?field=' + field + '&tbl_name=' + table + '&from_branch_id=' + from_branch_id + '&to_branch_id=' + to_branch_id;

            },

            dataType: "json",

            type: "GET",

            data: function(params) {

                return {

                    text: params.term

                };

            },

            processResults: function(data) {

                return {

                    results: $.map(data, function(obj) {

                        return {

                            id: obj.id,

                            text: obj.text

                        };

                    })

                };

            }

        }

    });

}





function userAreaselect2Ajax(elm, table, field, user_id) {

    $('#' + elm).select2({

        placeholder: '-Select Area Postcode -',

        delay: 250,

        //tags: true,

        multiple: true,

        //tokenSeparators: [',', ' '],

        minimumInputLength: 3,

        minimumResultsForSearch: 1,

        ajax: {

            url: function(params) {

                return base_url() + 'users/getUserAreaListbyBranch?field=' + field + '&tbl_name=' + table + '&user_id=' + user_id;

            },

            dataType: "json",

            type: "GET",

            data: function(params) {

                return {

                    text: params.term

                };

            },

            processResults: function(data) {

                return {

                    results: $.map(data, function(obj) {

                        return {

                            id: obj.id,

                            text: obj.text

                        };

                    })

                };

            }

        }

    });

}

var DataTableReportsInit = function(elm) {
    var today = new Date();
    var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    var dateTime = date + ' ' + time;
    var filenameExport = 'Export_Data_';
    $('#' + elm).DataTable({
        "paging": true,
        // "lengthChange": false,
        // "searching": false,
		"order": [[ 0, "desc" ]],
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
        dom: 'lfBrtip',
        buttons: [
            // {
            //     extend: 'colvis',
            //     text: 'Choose columns',
            //     collectionLayout: 'fixed two-column',
            // },
            {
                extend: 'excel',
                //text: 'Excel',
                text:      '<i class="fa fa-file-excel-o"></i>',
                filename: filenameExport + dateTime,
                title: '',
                exportOptions: {
                    columns: ':not(.notexport)'
                }
                // exportOptions: {
                //     columns: [0, 1, 2, 3],
                // }
            },
            // {
            //     extend: 'copy',
            //     text: 'Copy to clipboard'
            // },
            {
                extend: 'csvHtml5',
                //text: 'CSV',
                text:      '<i class="fa fa-file-text-o"></i>',
                filename: filenameExport + dateTime,
                title: '',
                exportOptions: {
                    columns: ':not(.notexport)'
                }
                // exportOptions: {
                //     columns: [0, 1, 2, 3],
                // }
            }, {
                //text: 'PDF',
                text:      '<i class="fa fa-file-pdf-o"></i>',
                extend: 'pdf',
                footer: true,
                pageSize: 'A4',
                title: filenameExport + dateTime
                    // + '\n' + 'a new line'
                    ,
                message: '',
                orientation: 'landscape',
                exportOptions: {
                    columns: ':not(.notexport)'
                },
                // exportOptions: {
                //     columns: ':visible'
                // },
                customize: function(doc) {
                    doc.styles.title = {
                            color: 'black',
                            fontSize: '70',
                            //background: 'blue',
                            alignment: 'center'
                        },
                    doc.pageMargins = [10, 10, 10, 10];
                    doc.defaultStyle.fontSize = 7;
                    doc.styles.tableHeader.fontSize = 7;
                    doc.styles.title.fontSize = 9;
                    // Remove spaces around page title
                    doc.content[0].text = doc.content[0].text.trim();
                    // Create a footer
                    doc['footer'] = (function(page, pages) {
                        return {
                            columns: [
                                filenameExport + dateTime, {
                                    // This is the right column
                                    alignment: 'right',
                                    text: ['page ', {
                                        text: page.toString()
                                    }, ' of ', {
                                        text: pages.toString()
                                    }]
                                }
                            ],
                            margin: [10, 0]
                        }
                    });
                    // Styling the table: create style object
                    var objLayout = {};
                    // Horizontal line thickness
                    objLayout['hLineWidth'] = function(i) {
                        return .5;
                    };
                    // Vertikal line thickness
                    objLayout['vLineWidth'] = function(i) {
                        return .5;
                    };
                    // Horizontal line color
                    objLayout['hLineColor'] = function(i) {
                        return '#aaa';
                    };
                    // Vertical line color
                    objLayout['vLineColor'] = function(i) {
                        return '#aaa';
                    };
                    // Left padding of the cell
                    objLayout['paddingLeft'] = function(i) {
                        return 4;
                    };
                    // Right padding of the cell
                    objLayout['paddingRight'] = function(i) {
                        return 10;
                    };
                    // Inject the object in the document
                    doc.content[1].layout = objLayout;
                }
            }
        ],
    });
}

var deleteRecordAjax = function(elm, tableName) {
    if (confirm('Are you sure want to delete?')) {
        var thisval = elm;
        var id = thisval.data('id');
        var table = atob(tableName);
        var url = base_url() + "deleteRecordAjax ";
        var $post = {
            id: id,
            table: table
        };
        $.ajax({
            type: "POST",
            url: url,
            data: $post,
            cache: false,
            success: function(data) {
                var tt = data.trim();
                $('#tr_' + id).hide(200);
                toastr.success('Record deleted successfully.')
                return data;
            }
        });
    } else {
        return false;
    }
    return false;
}
