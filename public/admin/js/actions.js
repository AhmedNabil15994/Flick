// ADD FORM
$("#form,.create-form").on("submit", function (e) {
  var form = $(this);
  e.preventDefault();

  tinyMCE.triggerSave();

  var url = $(this).attr("action");
  var method = $(this).attr("method");

  $.ajax({
    xhr: function () {
      var xhr = new window.XMLHttpRequest();
      xhr.upload.addEventListener("progress", function (evt) {
        if (evt.lengthComputable) {
          var percentComplete = evt.loaded / evt.total;
          percentComplete = parseInt(percentComplete * 100);
          form.find(".progress-bar").width(percentComplete + "%");
          form.find("#progress-status").html(percentComplete + "%");
        }
      }, false);
      return xhr;
    },

    url: url,
    type: method,
    dataType: "JSON",
    data: new FormData(this),
    contentType: false,
    cache: false,
    processData: false,

    beforeSend: function () {
      form.find("#submit").prop("disabled", true);
      form.find(".progress-info").show();
      form.find(".progress-bar").width("0%");
      resetErrors(form);
    },
    success: function (data) {
      form.find("#submit").prop("disabled", false);
      form.find("#submit").text();

      if (data[0] == true) {
        successfully(data, form);
        resetForm(form);
        resetErrors(form);
      } else {
        displayMissing(data, form);
      }
    },
    error: function (data) {
      form.find("#submit").prop("disabled", false);
      displayErrors(data, form);
    }
  });
});

// Update
$("#updateForm,.update-form").on("submit", function (e) {
  var form = $(this);
  e.preventDefault();
  tinyMCE.triggerSave();

  var url = $(this).attr("action");
  var method = $(this).attr("method");

  $.ajax({
    xhr: function () {
      var xhr = new window.XMLHttpRequest();
      xhr.upload.addEventListener("progress", function (evt) {
        if (evt.lengthComputable) {
          var percentComplete = evt.loaded / evt.total;
          percentComplete = parseInt(percentComplete * 100);
          form.find(".progress-bar").width(percentComplete + "%");
          form.find("#progress-status").html(percentComplete + "%");
        }
      }, false);
      return xhr;
    },

    url: url,
    type: method,
    dataType: "JSON",
    data: new FormData(this),
    contentType: false,
    cache: false,
    processData: false,

    beforeSend: function () {
      form.find("#submit").prop("disabled", true);
      form.find(".progress-info").show();
      form.find(".progress-bar").width("0%");
      resetErrors(form);
    },
    success: function (data) {
      form.find("#submit").prop("disabled", false);
      form.find("#submit").text();

      if (data[0] == true) {
        successfully(data, form);
      
      } else {
        displayMissing(data, form);
      }
    },
    error: function (data) {
      form.find("#submit").prop("disabled", false);
      displayErrors(data, form);
    }
  });
});

// Alerts & Others
function displayErrors(data, form) {
  console.log($.parseJSON(data.responseText));

  var getJSON = $.parseJSON(data.responseText);

  jQuery.each(getJSON.errors, function (index, value) {
    console.log(getJSON.errors, index)
    if (value.length !== 0) {
      form.find('[data-name="' + index + '"]').parent().addClass("has-error");
      form.find('[data-name="' + index + '"]').closest(".form-group").find(".help-block").html(value);
    }
  });

  var output = "<div class='alert alert-danger'><ul>";
  for (var error in getJSON.errors) {
    output += "<li>" + getJSON.errors[error] + "</li>";
  }
  if (getJSON.message && !getJSON.errors) {
    output += "<li>" + getJSON.message + "</li>";
  }
  output += "</ul></div>";

  form.find("#result").slideDown("fast", function () {
    form.find("#result").html(output);
    form.find(".progress-info").hide();
    form.find(".progress-bar").width("0%");
  }).delay(5000).slideUp("slow");

  form.find(".progress-info").hide();
  form.find(".progress-bar").width("0%");
}

function displayMissing(data, form) {
  toastr["error"](data[1]);
  form.find(".progress-info").hide();
  form.find(".progress-bar").width("0%");
  if ($(".dataTable").length > 0) 
    $(".dataTable").DataTable().ajax.reload();
  }

function successfully(data, form) {
  console.log(form)
  toastr["success"](data[1]);
  form.find(".progress-info").hide();
  form.find(".progress-bar").width("0%");
  if ($(".dataTable").length > 0) 
    $(".dataTable").DataTable().ajax.reload();
  }

function resetForm(form) {
  // Clear Inputs
  form.find(".form-control").not(".ignore-reset").each(function () {
    $(this).val("");
  });

  // Clear tinyMCE Editor
  form.find("textarea").each(function (k, v) {
    if (tinyMCE.get(k)) 
      tinyMCE.get(k).setContent("");
    }
  );
  form.find(".emojionearea-editor").html("");
  // console.log( form.find("select.select2:not(.ignore-reset)"), "Dddd")

  // Clear Select2
  form.find("select.select2:not(.ignore-reset)").select2();
}

function resetErrors(form) {
  form.find(".has-error").each(function () {
    $(this).removeClass("has-error");
  });

  form.find(".help-block").each(function () {
    $(this).text("");
  });
}

// DATATABLE
function CheckAll(container = "") {
  var isChecked = $(`${container} input[name=ids]`).first().prop("checked");
  $(`${container} input[name=ids]`).prop("checked", !isChecked);
}

function getFormData($form) {
  var unindexed_array = $form.serializeArray();
  console.log(unindexed_array)
  var indexed_array = {};
  
  $.map(unindexed_array, function (n, i) {
    var parts = n.name.split("[");
    var resultIndex = parts[0]
    if( parts.length == 2){
      if(resultIndex in indexed_array){
        
        indexed_array[resultIndex][parts[1].replace("]","")] = n.value
      }else{
        var object = {}
        object[parts[1].replace("]","")] = n.value
        indexed_array[resultIndex] = object
      }

     
    }else{
      indexed_array[resultIndex] = n.value; 
    }
  });
  return indexed_array;
}

$(document).ready(function () {
  $("#search").click(function () {
    var $form = $("#formFilter");
    var data = getFormData($form);

    $("#dataTable").DataTable().destroy();

    tableGenerate(data);
  });

  $(".filter-cancel").click(function () {
    document.getElementById("formFilter").reset();

    $("#dataTable").DataTable().destroy();

    $(".select2").val(null).trigger("change");

    $(".select2-mult").val([]).trigger("change");

    tableGenerate();
  });
});

function generateRandomColor() {
  let maxVal = 0xFFFFFF; // 16777215
  let randomNumber = Math.random() * maxVal;
  randomNumber = Math.floor(randomNumber);
  randomNumber = randomNumber.toString(16);
  let randColor = randomNumber.padStart(6, 0);
  return `#${randColor.toUpperCase()}`
}

function generateColorArray(length) {
  var rgb = [];

  for (var i = 0; i < length; i++)
      rgb.push(generateRandomColor());
  return rgb
}