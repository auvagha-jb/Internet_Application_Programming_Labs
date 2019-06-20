$(function () {

    getUserOrders();

    $("form#add-user").submit(function (e) {
        e.preventDefault();

        let form = $(this),
            form_id = form.attr('id'),
            url = form.attr('action'),
            context = this;

        /* Form validation */

        //Ensure all fields are filled
        if (!validateForm()) {
            displayAlert('Please fill all the fields','danger');
        } else {
            //Check that the username is unique/
            user_exists().then(data => {
                let input = $('#username');
                let username_error = "Username already exists";
                console.log(data)
                data = JSON.parse(data)
                //If the feedback is positive i.e. status == true -->Submit the form
                if (ajax_form_feedback(data,input,username_error)) {
                    ajax_submit_form_with_image(url,context).then(data => {
                        console.log(data);
                        let alert_type = (data.status) ? "success" : "danger";
                        let input = $('.file-path-wrapper').children('.file-path');
                        let text = $('.file-path-wrapper').children('.helper-text');

                        if (!data.status) {
                            if (data.target == "file") {
                                input.addClass('invalid');
                                text.attr('data-error',data.msg);

                            } else {
                                input.removeClass('invalid');
                                displayAlert(data.msg,alert_type);
                            }

                        } else {
                            displayAlert(data.msg,alert_type);
                            document.getElementById(form_id).reset();
                            add_user_table.ajax.reload();
                        }
                    });
                }
            });
        }
    });

    /**onCLick: Generate API key*/
    $("#api-key-btn").click(function () {
        //Check whether the user has an API key
        getApiKey().then(api_key => {
            //If the user has no API key
            console.log(api_key)
            api_key = JSON.parse(api_key)
            if (api_key.num_rows == 0) {
                //Generate a new API key
                generateApi($(this)).then(function (data) {
                    console.log(data)
                    //Check whether the key was generated successfully
                    if (data.status) {
                        //Display the api key in the textarea
                        $('#api_key').html(data.msg)
                    }
                    else {
                        //Alert the user that they already have an APi 
                        displayAlert(data.msg,"danger");
                    }
                })

                //If user has API key, notify them and disable the button to prevent more requests
            } else {
                $("#api_exists").removeClass("hide")
                $(this).attr('disabled','true')
                displayAlert("You already have an API key","warning")
            }
        })
    })

    /**onSubmit: Place order */
    $("#order_form").submit(function (e) {
        e.preventDefault();
        let form = $(this),url = form.attr('action'),form_data = get_form_data(form)
        let btn = $('.submit-btn')
        getApiKey().then(api_data => {
            //If the user has no API key
            console.log(api_data)
            api_data = JSON.parse(api_data)
            let api_key = api_data.api_key;

            $.ajax({
                url: url,
                method: "POST",
                data: form_data,
                headers: { "Authorization": api_key },
                beforeSend: function () {
                    disable_btn(btn);
                },
                success: function (data) {
                    enable_btn(btn);
                    console.log(data)
                    data = JSON.parse(data)
                    let alert_type = data.status ? "success" : "danger"
                    //User feedback
                    displayAlert(data.message,alert_type)
                    //refill the select 
                    getUserOrders();
                },
                error: function (xhr,textStatus,errorThrown) {
                    console.error(xhr.responseText);
                    console.error(textStatus);
                    console.error(errorThrown);
                    displayAlert("An error occured. Please try again later","danger");
                }
            });
        })

    })

    $("#order_status_form").submit(function (e) {
        e.preventDefault();

        let form = $(this),url = form.attr('action')
        let order_id = $("#orders").val()
        ajax_form_submit(url,{ order_id,get_order_status: true }).then(data => {
            data = JSON.parse(data)
            $("#order_status_check").text("Order " + data.order_id + " status: " + data.order_status);
        })
    })

    /** Populates the user orders select  */
    function getUserOrders() {
        let user_id = $("#user_id").text();
        ajax_form_submit("model/Orders.php",{ "user_id": user_id,"get_orders": true }).then(orders => {
            console.log(orders);
            orders = JSON.parse(orders);
            let alt_message = '<option value="">No orders have been made</option>';
            let orders_list = orders.num_rows > 0 ? orders.orders_list : alt_message
            $("#orders").html(orders_list)
        });
    }

    function generateApi(btn) {
        let promise = $.ajax({
            url: "model/Forms.php",
            method: 'POST',
            dataType: "JSON",
            data: { generate_api_key: true },
            beforeSend: function () {
                btn.html("Generating...")
            },
            success: function () {
                btn.html("Generated")
            },
            error: function (xhr,textStatus,errorThrown) {
                console.error(xhr.responseText);
                console.error(textStatus);
                console.error(errorThrown);
                displayAlert("An error occured. Please try again later","danger");
            }
        });
        return promise;
    }

    function getApiKey() {
        return ajax_form_submit("model/Forms.php",{ has_api_key: true })
    }

    /**
     * Adds or removes invalid class from form elements
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
     * Ensures the form inputs are not null
     */
    function validateForm() {
        let input = {
            first_name: document.forms["user_details"]["first_name"].value,
            last_name: document.forms["user_details"]["last_name"].value,
            city_name: document.forms["user_details"]["city_name"].value,
            username: document.forms["user_details"]["username"].value,
            password: document.forms["user_details"]["password"].value,
            image: document.forms["user_details"]["image"].value,
        }

        let valid = true;

        for (let key in input) {
            let val = input[key];
            let field = (key == "image") ? $("#" + key).parents('.file-field')
                .children('.file-path-wrapper').children('.validate')
                : $("#" + key);

            if (val == "") {
                field.addClass('invalid');
                field.siblings('.helper-text').attr('data-error','');
                valid = false;

            }

            // else if (key != "password" && contains_specialchar(val)) {
            //     field.addClass('invalid');
            //     field.siblings('.helper-text').attr('data-error','Only alphanumeric characters are allowed on this field');
            //     valid = false;

            // } 
            else {
                field.removeClass('invalid');
            }
        }
        return valid;
    }

    /**
     * Evaluates whether the input contains special characters
     * A defense against server side scripting
     * @param {string} value 
     */
    function contains_specialchar(value) {
        let regex = new RegExp(/[!@$%\^&()_+\-=\[\]{};':"\|,\.<>\/?]/,"i");
        return !regex.test(value);
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
                //Join the first name and last name columns 
                "data": "first_name",
                "render": function (data,type,row) {
                    var name = row['first_name'] + " " + row['last_name'];
                    return name;
                }
            },
            { "data": "username" },
            { "data": "user_city" }
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
        //console.log(selector,url,data)
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
        data["button_text"] = form.children('.submit-btn').text();

        return data;
    }



    /**
    * To send asynchronous HTTP requests
    * @param {string} url Url to which the request is sent
    * @param {Object} form_data The POST data which will be sent along with the request
    * @returns jqXHR
    */
    function ajax_form_submit(url,form_data = null) {
        let btn = $('.submit-btn')
        btn.attr('text',form_data.button_text)
        let promise = $.ajax({
            url: url,
            method: 'POST',
            data: form_data,
            beforeSend: function () {
                disable_btn(btn);
            },
            success: function () {
                enable_btn(btn);
            },
            error: function (xhr,textStatus,errorThrown) {
                console.error(xhr.responseText);
                console.error(textStatus);
                console.error(errorThrown);
                displayAlert("An error occured. Please try again later","danger");
            }
        });

        return promise;
    }


    /**
     * Submits forms of enctype = "multipart/form-data" 
     * @param {string} url 
     * @param {context} context lexical this 
     */
    function ajax_submit_form_with_image(url,context) {
        let btn = $('.submit-btn');
        let promise = $.ajax({
            url: url, // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            dataType: "JSON",
            data: new FormData(context), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData: false,
            beforeSend: function () {
                disable_btn(btn);
            },
            success: function (data) {
                enable_btn(btn);
            },
            error: function (xhr,textStatus,errorThrown) {
                console.error(xhr.responseText);
                console.error(textStatus);
                console.error(errorThrown);
            }
        });
        return promise;
    }

    /**
     * Test upload
     */
    $("#test-form").submit(function (e) {
        e.preventDefault();
        let url = $(this).attr('action'),context = this;

        ajax_submit_form_with_image(url,context).then(data => {
            console.log(data);
        });

        return false;
    })

    function disable_btn(btn) {
        btn.attr('disabled',true);
        // btn.html('Please wait...');
    }

    function enable_btn(btn) {
        let text = btn.attr('text')
        btn.attr('disabled',false);
        //btn.html(text);
    }
    /**
     * Displays notification that slides down from the top of the page
     * @param {string} msg
     * @param {string} type
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