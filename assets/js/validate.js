$(function () {

    $("form#add-user").submit(function (e) {
        e.preventDefault();

        let form = $(this),
            form_id = form.attr('id'),
            url = form.attr('action'),
            data = get_form_data(form);

        //Form validation
        if (validateForm()) {
            ajax_form_submit(url,data).then(data => {
                document.getElementById(form_id).reset();
                displayAlert(data.msg,"success");
                add_user_table.ajax.reload();
            });
        } else {
            displayAlert("Some fields are empty","danger");
        }
    });

    /**
     * Ensures the form inputs are not null
     */
    function validateForm() {
        var input = {
            fname: document.forms["user_details"]["first_name"].value,
            lname: document.forms["user_details"]["last_name"].value,
            city: document.forms["user_details"]["city_name"].value,
        }

        for (let key in input) {
            if (input[key] == "") {
                return false;
            }
        }
        return true;
    }

    /**
     * The users table
     */
    var add_user_table = data_table(
        "#users-table",
        "tables/Tables.php",
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



    /**
     * Initialize datatables plugin
     * @param {string} selector 
     * @param {string} url 
     * @param {object} data data to be sent to server
     * @param {array} columns array with column objects
     * @returns {datatables object}  
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


    /* Helper functions */
    /**
     * Gets the data for each from element with attribute 'name'
     * @param {object} form 
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
    * @param {string} url
    * @param {string} data
    * @returns {jqXHR}
    */
    function ajax_form_submit(url,data = null) {
        let btn = $('.submit-btn');
        let promise = $.ajax({
            url: url, // Url to which the request is send
            method: 'POST',
            dataType: "JSON", //The format in which we expect the response 
            beforeSend: function () {
                btn.attr('disabled',true);
                btn.html('Please wait...');
            },
            data: data,
            error: function (xhr,textStatus,errorThrown) {
                console.error(xhr.responseText);
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
        target.slideDown().delay(5000).slideUp();
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