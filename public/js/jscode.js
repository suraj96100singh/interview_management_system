// const { ajax } = require("jquery");

// const { ajax } = require("jquery");

// const { split } = require("lodash");

// console.log("js file");

// function resizeCanvas() {
//     var oldContent = signaturePad.toData();
//     var ratio = Math.max(window.devicePixelRatio || 1, 1);
//     canvas.width = canvas.offsetWidth * ratio;
//     canvas.height = canvas.offsetHeight * ratio;
//     canvas.getContext("2d").scale(ratio, ratio);
//     signaturePad.clear();
//     signaturePad.fromData(oldContent);
// }

// function clearpad() {
//     signaturePad.clear();
// }
// $(".form").submit(function () {
//     var btn = $(this).find("input[type=submit]:focus" );
//     var btnName = btn.attr('name');
//     console.log(btnName);
// var input = $("<input>")
//       .attr("name", "btnName").val(btnName);
// $(this).append(input);
// return true;
// });
var formcheck = true;
function submitForm(event) {
    // console.log();

    // $("#candidate_name").attr("required", "required");
    // $("#candidate_name").get(0).setCustomValidity("");

    // const element = document.getElementById("subint");
    // let text = element.getAttribute("validationcheck");
    // console.log(text);
    // text++;
    // let main = element.setAttribute("validationcheck", text);
    // console.log(text);

    var formData = $(".form").serialize();
    $.ajax({
        type: "POST",
        data: formData,
        dataType: "json",
        url: "/interview/validate",
        success: function (reso) {
            // console.log("bhar diya pura");
            $("#errors").html("");
            $("#errors").removeClass("d-block");
            // console.log(reso.success);
            // console.log(errors);
            // console.log(errors);
            // errors = true;
            if (formcheck) {
                formcheck = false;
                alert("Please Check Your Complete Form");
                return;
                // formcheck.preventDefault();
            }
            // console.log(text);
            // if (text) {
            //     alert("Please Check Your All Details");
            //     text.preventDefault();
            //     text = 0;
            // }

            swal({
                title: `Are you sure you want to Save Detail and Start Test?`,
                text: "If you Proceed, it Can't Be UNDO.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willProceed) => {
                if (willProceed) {
                    //   form.submit();
                    var name = $("#subint").attr("name");
                    var fdata = $(".form").serialize();
                    fdata += `&name=${name}`;
                    // console.log(fdata);
                    $.ajax({
                        type: "POST",
                        data: fdata,
                        dataType: "json",
                        url: "/interviewers",

                        success: function (data) {
                            // console.log(data.test_question.length);
                            // console.log(data.encrypt_interviewer_id);

                            window.location.href =
                                "/interview/" + data.encrypt_interviewer_id;
                            // $("#testModal").modal({
                            //     backdrop: "static",
                            //     keyboard: false,
                            // });
                            // console.log(data);

                            // if (data.test_question.length) {
                            //     $("#testModal").modal({
                            //         backdrop: "static",
                            //         keyboard: false,
                            //     });
                            //     $("#testModal").modal("toggle");
                            // } else {
                            //     window.location.href = "/interviewers";
                            // }

                            // $("#question_show").html(
                            //     data.test_question[0].Question
                            // );
                            // var question_option = `<div class="card-body alert alert-primary h4" >
                            // <div  class="question_show"></div>
                            // <div id="option_show"></div>
                            // </div>`;

                            // for (
                            //     let i = 0;
                            //     i < data.test_question.length;
                            //     i++
                            // ) {

                            //     var question_option = `<div class="card-body h4" >
                            //     <div  id="question_show_${i}" class="bg-success h4">${
                            //         i + 1
                            //     }.${
                            //         data.test_question[i].Question
                            //     }<span class='ml-3'>&#63;</span></div>`;
                            //     for (
                            //         let j = 0;
                            //         j < data.test_question[i].options.length;
                            //         j++
                            //     ) {
                            //         question_option += `<li class="list-group-item list-group-item-action list-group-item-primary"> <input type="radio" name="option_selected_${i}[]" value=${data.test_question[i].options[j].id} class="d-inline mr-3 form-check-input" id="${data.test_question[i].options[j].id}"><label for="${data.test_question[i].options[j].id}">${data.test_question[i].options[j].options}</label></li>`;

                            //     }
                            //     question_option += `</div>`;

                            //     $("#all_question_show").append(question_option);
                            // }
                        },
                    });
                }
            });
        },

        error: function (xhr, status, error) {
            $("#candidate_name").removeClass("border-danger");
            $("#candidate_dob").removeClass("border-danger");
            $("#candidate_number").removeClass("border-danger");
            $("#candidate_permanent_address").removeClass("border-danger");
            $("#departmentunique_id").removeClass("border-danger");
            $("#candidate_Email").removeClass("border-danger");
            $("#candidate_expected_salary").removeClass("border-danger");
            $(".print-error-msg").html("");
            $(".print-error-msg").addClass("d-none");
            var errors = xhr.responseJSON;

            // console.log(errors);
            // errors.forEach((element) => {
            //     console.log(element);
            // });
            // console.log(errors.errors);
            if (errors) {
                $(".print-error-msg").addClass("alert alert-danger d-block");
                $.each(errors.errors, function (keys, err_value) {
                    $(".print-error-msg").append(
                        "<li>" + err_value[0] + "</li>"
                    );
                });
                // $("html,body").animate({ scrollTop: $(window).height(1) }, 800);
                $("html, body").animate({ scrollTop: 0 }, 600);
                // return false;
            }

            if (errors.errors.candidate_name) {
                $("#candidate_name").addClass("border-danger");

                // console.log(errors.errors.candidate_name);
                //overrite require alert by programmer
                // const name = errors.errors.candidate_name.toString();
                // console.log(name);
                // $("#candidate_name").attr(
                //     "oninvalid",
                //     `this.setCustomValidity('${name}')`
                // );
                // document.querySelector("#candidate_name").reportValidity();
                // $("#candidate_name").trigger("invalid");
            }

            if (errors.errors.candidate_dob) {
                $("#candidate_dob").addClass("border-danger");
            }
            if (errors.errors.candidate_number) {
                $("#candidate_number").addClass("border-danger");
            }
            if (errors.errors.candidate_permanent_address) {
                $("#candidate_permanent_address").addClass("border-danger");
            }
            if (errors.errors.department_id) {
                $("#departmentunique_id").addClass("border-danger");
            }
            if (errors.errors.candidate_Email) {
                $("#candidate_Email").addClass("border-danger");
            }
            if (errors.errors.expected_amount) {
                $("#expected_amount").addClass("border-danger");
            }
        },
    });
}
function examsubmit() {
    // var examname = $("#examid").attr("name");
    var examdata = $(".examsubmit").serializeArray();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        type: "POST",
        data: { examdata: examdata },
        dataType: "json",
        url: "/interview/examcalculation",
        success: function (examresponse) {
            // console.log("data chala gya kya");
            // console.log(examresponse);
            window.location.href = "/interviewers";
            // var dataResult = JSON.parse(examresponse);
            // console.log(dataResult);
        },
    });
}

function employeesubmit(candidate_id) {
    var element = $(`<div class="text-center">
        <div class="spinner-border text-success" role="status">
          <span class="sr-only">Loading...</span>
        </div>
      </div>
      <div class="text-center"><strong>Sending the offer later...</strong></div>`);

    $("#empty_div").html(element);
    $("#div_hide").hide();
    $("#empty_div").show();

    var employeedata = $(".employeesubmit").serialize();

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    var token = $('meta[name="csrf-token"]').attr("content");
    // console.log(token);
    $.ajax({
        type: "PUT",
        data: employeedata,
        dataType: "json",
        url: "/interviewers/" + candidate_id,
        // beforeSend: function () {
        //     // Show image container
        //     $("#empty_div").show();
        // },
        success: function (res) {
            // $("#empty_div").show();
            console.log(res);
            window.location.href = "/interviewers";
        },
        // complete: function (res) {
        //     // Hide image container
        //     $("#empty_div").hide();
        // },
        error: function (xhr, status, error) {
            $("#employee_role_selection_error").html("");
            $("#employee_offered_salary_error").html("");
            $("#employee_joining_date_error").html("");
            $("#employee_employement_type_error").html("");
            var errors = xhr.responseJSON;
            // console.log(errors.message);
            if (errors) {
                $("#employee_role_selection_error").html(
                    errors.errors.employee_role
                );
            }
            if (errors) {
                $("#employee_offered_salary_error").html(
                    errors.errors.offered_salary
                );
            }
            if (errors) {
                $("#employee_joining_date_error").html(
                    errors.errors.joining_date
                );
            }
            if (errors) {
                $("#employee_employement_type_error").html(
                    errors.errors.employment_type
                );
            }
        },
    });
}

function ageFind(dateString) {
    var today = new Date();
    var birthDate = new Date(dateString);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    document.getElementById("candidate_age").value = age;
}

function bgchange(checked_id, question_id) {
    $("li[id^='" + question_id + "_']").removeClass("bg-info");
    if (document.getElementById(checked_id).checked) {
        $(`.main_${checked_id}_${question_id}`).addClass("bg-info");
    }
}
// function printsss() {
//     window.print();
// }
// var wrapper = document.getElementById("signature-pad"),
//     canvas = wrapper.querySelector("canvas"),
//     signaturePad;

// var signaturePad = new SignaturePad(canvas);
// signaturePad.minWidth = 2;
// signaturePad.maxWidth = 3;
// signaturePad.penColor = "rgb(0, 0, 0)";
// signaturePad.minWidth = 1; //minimale Breite des Stiftes
// signaturePad.maxWidth = 5; //maximale Breite des Stiftes
// signaturePad.penColor = "#000000"; //Stiftfarbe
// signaturePad.backgroundColor = "#FFFFFF"; //Hintergrundfarbe
// window.onresize = resizeCanvas;
// resizeCanvas();

function print_detail(elem) {
    var domClone = elem.cloneNode(true);

    var $printSection = document.getElementById("printSection");
    console.log($printSection);

    if (!$printSection) {
        var $printSection = document.createElement("div");
        $printSection.id = "printSection";
        document.body.appendChild($printSection);
    }

    $printSection.innerHTML = "";
    $printSection.appendChild(domClone);
    window.print();
}

$(document).ready(function () {
    $(".tbl").DataTable({
        dom: "Bfrtip",
        buttons: ["excel", "pdf"],
    });
});
// $(document).ready(function () {
//     $(".interview_tbl").DataTable({
//         dom: "Bfrtip",
//         buttons: ["excel", "pdf"],
//     });
// });

$(function () {
    var table = $(".interview_tbl").DataTable({
        dom: "Bfrtip",
        buttons: ["excel", "pdf"],
        processing: true,
        serverSide: true,
        ajax: {
            url: "/interviewers",
            data: function (d) {
                (d.status = $("#status").val()),
                    (d.search = $('input[type="search"]').val());
            },
            // success: function (res) {
            //     console.log(res);
            // },
        },
        columns: [
            // { data: "DT_RowIndex", name: "DT_RowIndex" },

            { data: "id", name: "id" },
            // { data: "candidate_current_address", name: "candidate_dob" },

            { data: "candidate_name", name: "candidate_name" },
            { data: "candidate_number", name: "candidate_number" },

            {
                data: "department_name.department_name",
                name: "department_name.department_name",
            },

            // { data: "department_id", name: "department_id" },
            { data: "candidate_email", name: "candidate_email" },
            { data: "candidate_permanent_address", name: "candidate_dob" },
            { data: "distance_btw_office", name: "distance_btw_office" },
            {
                data: "candidate_form_filling_date",
                name: "candidate_form_filling_date",
            },
            { data: "total_question", name: "total_question" },
            { data: "total_correct_question", name: "total_correct_question" },

            // { data: "candidate_status", name: "candidate_status" },

            { data: "status", name: "status" },
            { data: "action", name: "action" },
            // ----------------------
            // {
            //     data: "candidate_10th_institution_name",
            //     name: "candidate_10th_institution_name",
            // },
            // { data: "candidate_10th_marks", name: "candidate_10th_marks" },
            // { data: "candidate_10th_medium", name: "candidate_10th_medium" },
            // { data: "candidate_12th_institution_name", name: "candidate_dob" },
            // { data: "candidate_12th_marks", name: "candidate_dob" },
            // { data: "candidate_12th_medium", name: "candidate_dob" },
            // { data: "candidate_12th_subject_name", name: "candidate_dob" },
            // { data: "candidate_age", name: "candidate_dob" },
            // { data: "candidate_any_habits", name: "candidate_dob" },
            // { data: "candidate_any_medical_problem", name: "candidate_dob" },
            // { data: "candidate_any_special_knowledge", name: "candidate_dob" },
            // { data: "candidate_dob", name: "candidate_dob" },
            // { data: "candidate_expected_salary", name: "candidate_dob" },
            // {
            //     data: "candidate_graduation_institution_name",
            //     name: "candidate_dob",
            // },
            // { data: "candidate_graduation_medium", name: "candidate_dob" },
            // { data: "candidate_graduation_percentages", name: "candidate_dob" },
            // { data: "candidate_graduation_subject", name: "candidate_dob" },
            // { data: "candidate_have_DL_status", name: "candidate_dob" },
            // { data: "candidate_have_PAN_status", name: "candidate_dob" },
            // {
            //     data: "candidate_if_ready_to_go_outside_bikaner",
            //     name: "candidate_dob",
            // },
            // { data: "candidate_marriage_status", name: "candidate_dob" },
            // { data: "candidate_pdf", name: "candidate_dob" },
            //
            // {
            //     data: "candidate_pg_or_deploma_institution_name",
            //     name: "candidate_dob",
            // },
            // { data: "candidate_pg_or_deploma_medium", name: "candidate_dob" },
            // {
            //     data: "candidate_pg_or_deploma_percentages",
            //     name: "candidate_dob",
            // },
            // { data: "candidate_pg_or_deploma_subject", name: "candidate_dob" },
            // { data: "candidate_reference_person_name", name: "candidate_dob" },
            // { data: "candidate_signature", name: "candidate_dob" },
            // { data: "candidate_soft_skills", name: "candidate_dob" },
            // { data: "created_at", name: "candidate_dob" },
            // { data: "deleted_at", name: "candidate_dob" },
            // { data: "earlier_tour", name: "candidate_dob" },
            // { data: "employee_date_of_joining", name: "candidate_dob" },
            // { data: "employee_offered_salary", name: "candidate_dob" },
            // { data: "employee_remarks", name: "candidate_dob" },
            // { data: "employement_type", name: "candidate_dob" },
            // { data: "updated_at", name: "candidate_dob" },
        ],
    });

    $("#status").change(function () {
        table.draw();
    });
    // $(".myselect").change(function () {
    //     table.draw();
    // });
});

$(document).ready(function (url) {
    var url_string = window.location;
    var url = new URL(url_string);
    var url_id = url.searchParams.get("filter");
    // var tvid = url.searchParams.get("id");
    if (url_id == 0 || url_id == 2 || url_id == 3) {
        document.getElementById("status").selectedIndex = url_id;
        document.getElementById("status").dispatchEvent(new Event("change"));
    }

    // geocode
});

// ----

// state and city code
var auth_token;
function dropdown_state() {
    $.ajax({
        type: "GET",
        url: "https://www.universal-tutorial.com/api/getaccesstoken",
        success: function (data) {
            auth_token = data.auth_token;
            get_state(data.auth_token);
        },
        headers: {
            Accept: "application/json",
            "api-token":
                "D-FpCSCxWG7D2BjTHw7fu6AG4NJLVdTsPy-quvPKpXt-hfNo8xwOvacZauakrYwsGvY",
            "user-email": "monikabothra1996@gmail.com",
        },
    });
}
function get_data() {
    get_city(false);
}
dropdown_state();
function get_state(auth_token) {
    var country_name = "India";
    $.ajax({
        type: "GET",
        url: "https://www.universal-tutorial.com/api/states/" + country_name,
        success: function (data) {
            $("#state").empty();
            data.forEach((element) => {
                $("#state").append(
                    '<option value="' +
                        element.state_name +
                        '">' +
                        element.state_name +
                        "</option>"
                );
            });
        },
        headers: {
            Authorization: "Bearer " + auth_token,
            Accept: "application/json",
        },
    });
}

function get_city(city) {
    var state_name = $("#state").val();

    // console.log(state_name);
    $.ajax({
        type: "GET",
        url: "https://www.universal-tutorial.com/api/cities/" + state_name,
        success: function (data) {
            $("#city").empty();
            var unique = [...new Set(data.map((item) => item.city_name))];
            if (city) {
                unique.forEach((element) => {
                    $("#city")
                        .append(
                            '<option value="' +
                                element +
                                '">' +
                                element +
                                "</option>"
                        )
                        .val(city);
                });
            } else {
                unique.forEach((element) => {
                    $("#city").append(
                        '<option value="' +
                            element +
                            '">' +
                            element +
                            "</option>"
                    );
                });
            }
        },
        headers: {
            Authorization: "Bearer " + auth_token,
            Accept: "application/json",
        },
    });
}

// distance calculate from office to candidate address
// radius of the given data
var rad = function (x) {
    return (x * Math.PI) / 180;
};
function getLatLongFromAddress() {
    var address = document.getElementById("candidate_permanent_address").value;
    var city = document.getElementById("city").value;
    // console.log(city);
    var state = document.getElementById("state").value;
    var full_address = address + ", " + city + ", " + state;
    document.getElementById("candidate_permanent_address").value = full_address;
    var office_lat = 28.0058335;
    var office_long = 73.3059022;

    // console.log(full_address);

    // console.log(state);
    fetch(
        `https://api.distancematrix.ai/maps/api/geocode/json?address=${full_address}&key=FRdLgsW7bjYl5ZtWp0g0xLmPjtdUb`
    )
        .then((response) => {
            return response.json();
        })
        .then((jsonData) => {
            // console.log(jsonData.result[0].geometry.location); // {lat: 45.425152, lng: -75.6998028}
            $("#lat").val(jsonData.result[0].geometry.location.lat);
            $("#long").val(jsonData.result[0].geometry.location.lng);

            // experiment start
            var R = 6378137; // Earth’s mean radius in meter
            var destination_lat = jsonData.result[0].geometry.location.lat;
            var distiination_long = jsonData.result[0].geometry.location.lng;

            var dLat = rad(
                office_lat - jsonData.result[0].geometry.location.lat
            );
            var dLong = rad(
                office_long - jsonData.result[0].geometry.location.lng
            );
            var a =
                Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(rad(jsonData.result[0].geometry.location.lat)) *
                    Math.cos(rad(office_lat)) *
                    Math.sin(dLong / 2) *
                    Math.sin(dLong / 2);
            var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            var d = (R * c) / 1000;

            // console.log(d.toFixed(2));
            $("#distance_btw_office").val(d.toFixed(2));

            // experiment end
        })
        .catch((error) => {
            console.log(error);
        });
}

// $(".select_all_checkbox").on("click", function () {
//     alert("hello");
// this.checked
//     ? $(".selected_question").prop("checked", true)
//     : $(".selected_question").prop("checked", false);
// });
$(document).on("click", "#select_all_checkbox", function () {
    this.checked
        ? $(".selected_question").prop("checked", true)
        : $(".selected_question").prop("checked", false);
});
