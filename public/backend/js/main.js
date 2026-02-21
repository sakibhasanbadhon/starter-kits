/***********************
 * Pre Defined
 */

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

const CSRF_TOKEN = $("head meta[name=csrf-token]").attr("content");

/***********************
 * Alert Modal Show
 */
function alertModalShow(method, url, title, message, target = null) {
  $('#alert-modal .top-title').text(title);

  let modal_body = `<form action="${url}" method="${method}">
                        <input type="hidden" name="_token" value="${CSRF_TOKEN}">
                        <p class="mb-0 alert-title">${message}</p>
                        <div class="alert-confirm-modal text-right mt-4">
                            <input type="hidden" name="target" value="${target}">
                            <button class="btn btn-warning shadow-none" data-dismiss="modal" type="button">Cancel</button>
                            <button id="confirm-btn" class="btn btn-danger shadow-none" type="submit">Yes! <i class="fa fa-spinner fa-pulse fa-fw btn-loading d-none"></i></button>
                        </div>
                    </form>`;

  $('#alert-modal .modal-body').html(modal_body);
  $('#alert-modal').modal('show');
}

/***********************
 * Global Search
 */

function globalSearch(text, route, table_class) {
  $.ajax({
    url: route, // action route
    type: "POST", // type
    data: { text: text, _token: CSRF_TOKEN }, // request data
    dataType: 'JSON',
    cache: false,
    success: function (response) {
      $('.' + table_class).html(response.data);
    },
    error: function (error) {
      console.log(error);
      flashMessage('error', 'Something Went Wrong, Please Try Again!');
    }
  })
}


/***********************
 * Jquery Document Ready
 */

$(document).ready(function () {
  // Select 2
  $('.select2').select2();

  // Toggle Password
  $(document).on('click', '.toggle-password', function () {
    $(this).toggleClass('fa-eye fa-eye-slash');
    var input = $($(this).attr('toggle'));
    if (input.attr('type') == 'password') {
      input.attr('type', 'text');
    } else {
      input.attr('type', 'password');
    }
  });
});


/***********************
 * Get All Countries
 */
var allCountries = "";
function getAllCountries(hitUrl, targetElement = $(".country-select"), errorElement = $(".country-select").siblings(".select2")) {
  if (targetElement.length == 0) {
    return false;
  }
  $.get(hitUrl, function () {
    // success
    $(errorElement).removeClass("is-invalid");
    $(targetElement).siblings(".invalid-feedback").remove();
  }).done(function (response) {
    // Place Countries to dropdown
    var options = "<option selected disabled>Select Country</option>";
    var selected_old_data = "";
    if ($(targetElement).attr("data-old") != null) {
      selected_old_data = $(targetElement).attr("data-old");
    }
    $.each(response, function (index, item) {
      options += `<option value="${item.name}" data-id="${item.id}" data-mobile-code="${item.mobile_code}" data-currency-name="${item.currency_name}" data-currency-code="${item.currency}" data-currency-symbol="${item.currency_symbol}" ${selected_old_data == item.name ? "selected" : ""}>${item.name}</option>`;
    });

    allCountries = response;
    $(targetElement).html(options);

    // Re-init select2 after populating to ensure it renders
    if ($(targetElement).hasClass("select2")) {
      $(targetElement).select2("destroy").select2();
    }
  }).fail(function (response) {
    var faildMessage = "Something went wrong! Please try again.";
    var faildElement = `<span class="invalid-feedback" role="alert">
                              <strong>${faildMessage}</strong>
                          </span>`;
    $(errorElement).addClass("is-invalid");
    if ($(targetElement).siblings(".invalid-feedback").length != 0) {
      $(targetElement).siblings(".invalid-feedback").text(faildMessage);
    } else {
      errorElement.after(faildElement);
    }
  });
}