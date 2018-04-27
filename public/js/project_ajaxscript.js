
$(document).ready(function(){

    //get base URL *********************
    var url = $('#url').val();

    //display modal form for creating new product *********************
    $('#btn_add').click(function(){
        $('#btn-save').val("add");
        $('#frmProducts').trigger("reset");
        $('#myModal').modal('show');
    });



    //display modal form for product EDIT ***************************
    $(document).on('click','.open_modal',function(){
        var id = $(this).val();

        // Populate Data in Edit Modal Form
        $.ajax({
            type: "GET",
            url: url + '/' + id,
            success: function (data) {
                // console.log(data);
                $('#id').val(data.id);
                $('#project_id').val(data.project_id);
                $('#project_title').val(data.project_title);
                $('#project_description').val(data.project_description);
                $('#project_status_category').val(data.project_status_category);
                $('#status_date_updated').val(data.status_date_updated);
                $('#source_ballot_link').val(data.source_ballot_link);
                $('#win_text').val(data.win_text);
                $('#win_calculate').val(data.win_calculate);
                $('#votes').val(data.votes);
                $('#vote_date').val(data.vote_date);
                $('#pb_cycle').val(data.pb_cycle);
                $('#cost_text').val(data.cost_text);
                $('#cost_num').val(data.cost_num);
                $('#category_topic_committee_raw').val(data.category_topic_committee_raw);
                $('#category_type_topic_standardize').val(data.category_type_topic_standardize);
                $('#project_location_raw').val(data.project_location_raw);
                $('#project_address_clean').val(data.project_address_clean);
                $('#location_city').val(data.location_city);
                $('#state').val(data.state);
                $('#country').val(data.country);
                $('#zipcode').val(data.zipcode);
                $('#full_address').val(data.full_address);
                $('#latitude').val(data.latitude);
                $('#longitude').val(data.longitude);
                $('#neighborhood').val(data.neighborhood);
                $('#census_tract_or_local_id').val(data.census_tract_or_local_id);
                $('#bin').val(data.bin);
                $('#borough_code').val(data.borough_code);
                $('#name_dept_agency_cbo').val(data.name_dept_agency_cbo);
                $('#agency_project_code').val(data.agency_project_code);
                $('#project_budget_type').val(data.project_budget_type);
                $('#btn-save').val("update");
                $('#myModal').modal('show');
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });



    //create new product / update existing product ***************************
    $( "#myModal" ).submit(function(e) {
    // $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        e.preventDefault(); 
        var formData = {
            project_id: $('#project_id').val(),
            project_title: $('#project_title').val(),
            project_description: $('#project_description').val(),
            project_status_category: $('#project_status_category').val(),
            status_date_updated: $('#status_date_updated').val(),
            source_ballot_link: $('#source_ballot_link').val(),
            win_text: $('#win_text').val(),
            win_calculate: $('#win_calculate').val(),
            votes: $('#votes').val(),
            vote_date: $('#vote_date').val(),
            pb_cycle: $('#pb_cycle').val(),
            cost_text: $('#cost_text').val(),
            cost_num: $('#cost_num').val(),
            category_topic_committee_raw: $('#category_topic_committee_raw').val(),
            category_type_topic_standardize: $('#category_type_topic_standardize').val(),
            project_location_raw: $('#project_location_raw').val(),
            project_address_clean: $('#project_address_clean').val(),
            location_city: $('#location_city').val(),
            state: $('#state').val(),
            country: $('#country').val(),
            state: $('#state').val(),
            zipcode: $('#zipcode').val(),
            full_address: $('#full_address').val(),
            latitude: $('#latitude').val(),
            longitude: $('#longitude').val(),
            neighborhood: $('#neighborhood').val(),
            census_tract_or_local_id: $('#census_tract_or_local_id').val(),
            bin: $('#bin').val(),
            borough_code: $('#borough_code').val(),
            name_dept_agency_cbo: $('#name_dept_agency_cbo').val(),
            agency_project_code: $('#agency_project_code').val(),
            project_budget_type: $('#project_budget_type').val()
        }

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save').val();
        var type = "POST"; //for creating new resource
        var id = $('#id').val();
        var my_url = url;
        if (state == "update"){
            type = "PUT"; //for updating existing resource
            my_url += '/' + id;
        }

        // console.log(formData);
        $.ajax({
            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                // console.log(data);
                // var product = '<tr id="project' + data.id + '"><td class="text-center">' + data.project_projectid + '</td><td class="text-center">' + data.project_managingagency + '</td>';
                // product += '<td class="text-center"><button class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill open_modal" title="Edit details" value="' + data.bodystyleid + '"><i class="la la-edit"></i></button>';
                // product += ' <button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill delete-product" title="Delete" value="' + data.bodystyleid + '"><i class="la la-trash"></i></button></td></tr>';
                
                if (state == "add"){ //if user added a new record
                    $('#products-list').append(product);
                    $('.m-portlet.m-portlet--mobile').before(add_alert);
                   // $('.alert.alert-success.alert-dismissible.fade.show').hide(5000);
                }else{ //if user updated an existing record
                    $('#frmProducts').trigger("reset");
                    $('#myModal').modal('hide');
                    window.location.reload(); 
                    // $("#project" + project_id).replaceWith( product );
                   // $('.m-portlet.m-portlet--mobile').before(edit_alert);
                    //$('.alert.alert-brand.alert-dismissible.fade.show').hide(5000);
                }
                
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

     //display modal form for product EDIT ***************************
    $(document).on('click','.delete-product',function(){
        var product_id = $(this).val();
       
        // Populate Data in Edit Modal Form
        $.ajax({
            type: "GET",
            url: url + '/' + product_id,
            success: function (data) {
                console.log(data);
                $('#product_id').val(data.bodystyleid);
                $('#name').val(data.name);
                $('#price').val(data.abbrev);
                $('#btn-delete').val("delete");
                $('#deleteModal').modal('show');

            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    //delete product and remove it from TABLE list ***************************
    $(document).on('click','#btn-delete',function(){
        var product_id = $('#product_id').val();
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })
        $.ajax({
            type: "DELETE",
            url: url + '/' + product_id,
            success: function (data) {
                console.log(data);
                $("#product" + product_id).remove();
                $('#deleteModal').modal('hide');
                var delete_alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>You successfully deleted Bodystyle.</div>';
                $('.m-portlet.m-portlet--mobile').before(delete_alert);
               // $('.show').hide(5000);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
    
});