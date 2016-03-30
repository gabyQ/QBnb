var table;
var validator;

$(document).ready(function(){
    initTable();
});

function initTable(){
    $.when(
        $.ajax({
            contentType: "application/json; charset=utf-8",
            url: "../controllers/MyPropertiesController.php",
            type: "POST",
            data: JSON.stringify({action: "viewAllProperties"})
        })
    ).done(function(data) {
        var d = JSON.parse(data);
        console.log(d);
        table = $("#property-table").DataTable({
            "dom": '<"toolbar">frt<"bottom"ilp><"clear">',
            'order': [[1, 'asc']],
            select: {
                style: 'single',
                blurable: true
            },
            columnDefs: [
                {
                    targets: 0,
                    orderable: false,
                    searchable: false,
                    className: 'dt-body-center',
                    render: function (data, type, full, meta) {
                        return '<span class="fa fa-pencil table-edit-icon"></span>';
                    }
                }
            ],
            "aaData": d,
            "aoColumns": [{
                "defaultContent": ""
            },
                {
                    "mDataProp" : "address",
                    "defaultContent": ""
                },
                {
                    "mDataProp": "nightlyRate",
                    "defaultContent": ""
                }, {
                    "mDataProp": "district",
                    "defaultContent": ""
                }, {
                    "mDataProp": "buildingType",
                    "defaultContent": ""
                },{
                    "mDataProp": "numBedrooms",
                    "defaultContent": ""
                }]
        });
        //$("div.toolbar").html('<button class="toolbar-button btn" data-function="Create" onclick="userVm.openUserModal(this)" data-function="Create"><span class="fa fa-plus"></span>  Create</button><button class="toolbar-button btn requires-select" onclick="userVm.openDeleteModal()"><span class="fa fa-trash-o"></span>  Delete</button>');


    });
}
