$(function () {

    $("form#add-user").submit(function (e) {
        e.preventDefault();

        let form = $(this),
            form_id = form.attr('id'),
            url = form.attr('action'),
            form_data = get_form_data(form);

        /* Form validation */

        user_exists().then(data => {
            let input = $('#username');
            let uname_error = "Username already exists";


            //If all fields are filled and username is unique -->Submit form data
            if (!validateForm()) {
                displayAlert('Please fill all the fields','danger');
            }

            //Add feedback classes
            validate_obj.username = ajax_form_feedback(data,input,uname_error);

            if (validate_obj.username) {
                ajax_form_submit(url,form_data).then(data => {
                    document.getElementById(form_id).reset();
                    displayAlert(data.msg,"success");
                    add_user_table.ajax.reload();
                });
            }
        });
    });

    /**
     * Adds or removes invalid classes from form elements
     * @param {Object} data 
     * @param {Object} input 
     * @param {string} error_text 
     * @returns boolean
     */
    function ajax_form_feedback(data,input,error_text) {
        if (!data.status && input.val() !== "") {
            input.siblings('.helper-text').attr('data-error',error_text);
            input.addClass('invalid');
        } else if (data.status) {
            input.removeClass('invalid');
        }
        return data.status;
    }

    /**
     * @var {Object} validate_obj
     * Stores the state of the form 
     */
    let validate_obj = {
        username: false
    }


    /**
     * Ensures the form inputs are not null
     */
    function validateForm() {
        let input = {
            first_name: document.forms["user_details"]["first_name"].value,
            last_name: document.forms["user_details"]["last_name"].value,
            city_name: document.forms["user_details"]["city_name"].value,
            username: document.forms["user_details"]["username"].value,
            password: document.forms["user_details"]["password"].value,
        }

        let isValid = true;
        for (let key in input) {

            let val = input[key];
            let field = $("#" + key);

            if (val == "" || val == null) {
                field.addClass('invalid');
                field.siblings('.helper-text').attr('data-error','');
                isValid = false;
            } else {
                field.removeClass('invalid');
            }
        }
        return isValid;
    }

    /**
     * Ensures there are no duplicate usernames
     */
    function user_exists() {
        let username = document.getElementById('username').value;
        return ajax_form_submit("model/forms.php",{ user_exists: true,username: username });
    }

    /**
     * The users table
     */
    var add_user_table = data_table(
        "#users-table",
        "model/tables.php",
        { get_users: true },
        [
            {
                "data": "first_name",
                "render": function (data,type,row) {
                    var name = row['first_name'] + " " + row['last_name'];
                    return name;
                }
            },
            { "data": "user_city" },
        ]);


    /* Helper functions */

    /**
     * Initialize datatables plugin
     * @param {string} selector 
     * @param {string} url 
     * @param {Object} data data to be sent to server
     * @param {array} columns array with column objects
     * @returns {Object} datatables object  
     */
    function data_table(selector,url,data,columns) {
        console.log(selector,url,data)
        return $(selector).DataTable({
            "ajax": {
                "url": url,
                "type": "POST",
                "dataSrc": "",
                "data": data,
                "error": function (xhr,textStatus,errorThrown) {
                    console.error(xhr.responseText)
                }
            },
            "columns": columns
        })
    }

    /**
     * Gets the data for each from element with attribute 'name'
     * @param {Object} form 
     */
    function get_form_data(form) {
        let data = {};

        //Get elements with a _name_ attribute
        form.find('[name]').each(function () {
            let input = $(this),name = input.attr('name'),value = input.val();

            //Insert the form data into the object
            data[name] = value;
        });

        return data;
    }

    /**
    * To send asynchronous HTTP requests
    * @param {string} url Url to which the request is sent
    * @param {Object} data The POST data which will be sent along with the request
    * @returns jqXHR
    */
    function ajax_form_submit(url,data = null) {
        let btn = $('.submit-btn');
        let promise = $.ajax({
            url: url,
            method: 'POST',
            dataType: "JSON", //The format in which we expect the response 
            beforeSend: function () {
                btn.attr('disabled',true);
                btn.html('Please wait...');
            },
            data: data,
            error: function (xhr,textStatus,errorThrown) {
                console.error(xhr.responseText);
                displayAlert("An error occured. Please try again later","danger");
            },
            success: function () {
                btn.attr('disabled',false);
                btn.html('Save');
            }
        });

        return promise;
    }

    /**
     * Displays notification that slides down from the top of the page
     * @param {string} msg
     * @returns {undefined}
     */
    function displayAlert(msg,type) {
        let target = $("#page-feedback");
        let class_ = getClass(target);

        target.removeClass('d-none');
        target.removeClass(class_);
        target.addClass('alert-' + type);

        target.html(msg);
        target.slideDown().delay(6000).slideUp();
    }



    /**
     * Gets the current class that is assigned to the alert div
     * @param {string} target jQuery selector 
     */
    function getClass(target) {
        let classes = ['alert-success','alert-danger','alert-warning'];

        for (let class_ of classes) {
            if (target.hasClass(class_)) {
                return class_;
            }
        }
        return null;
    }

});