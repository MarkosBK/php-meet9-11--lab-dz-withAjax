window.onload = function () {
    try {
        getCitiesByCountry(document.getElementById("countryHotelSelect").value, "countryHotelSelect")
    } catch (error) { }
    try {
        getCitiesByCountry(document.getElementById("countryTourSelect").value, "countryTourSelect")
    } catch (error) { }
    try {
        $("#imagesHotelSelect").change();
    } catch (error) { }

}

$(".checkboxCountry").click(function () {
    if ($('#adminCountries input:checkbox:checked').length > 0) {
        $("#deleteCountryInfo").css("color", "green");
        $("#deleteCountryInfo").val("Сlick to delete");
        $("#deleteCountry").prop("disabled", false);
    } else {
        $("#deleteCountryInfo").css("color", "orangered");
        $("#deleteCountryInfo").val("Select countries");
        $("#deleteCountry").prop("disabled", true);

    }
});

$(".checkboxCity").click(function () {
    if ($('#adminCities input:checkbox:checked').length > 0) {
        $("#deleteCityInfo").css("color", "green");
        $("#deleteCityInfo").val("Сlick to delete");
        $("#deleteCity").prop("disabled", false);
    } else {
        $("#deleteCityInfo").css("color", "orangered");
        $("#deleteCityInfo").val("Select cities");
        $("#deleteCity").prop("disabled", true);

    }
});

$(".checkboxHotel").click(function () {
    if ($('#adminHotels input:checkbox:checked').length > 0) {
        $("#deleteHotelInfo").css("color", "green");
        $("#deleteHotelInfo").val("Сlick to delete");
        $("#deleteHotel").prop("disabled", false);
    } else {
        $("#deleteHotelInfo").css("color", "orangered");
        $("#deleteHotelInfo").val("Select hotels");
        $("#deleteHotel").prop("disabled", true);

    }
});

$(".checkboxImage").click(function () {
    if ($('#adminImages input:checkbox:checked').length > 0) {
        $("#deleteImageInfo").css("color", "green");
        $("#deleteImageInfo").val("Сlick to delete");
        $("#deleteImage").prop("disabled", false);
    } else {
        $("#deleteImageInfo").css("color", "orangered");
        $("#deleteImageInfo").val("Select images");
        $("#deleteImage").prop("disabled", true);

    }
});

$("#cityHotelSelect").change(function () {
    $("#HotelsList").css("overflow", "auto");
    let sel = $("#HotelsList").find(".hotelsDiv");
    for (let i = 0; i < sel.length; i++) {
        const select = sel[i];
        let citySelector = "#cityHotelSelect" + $("#countryHotelSelect").val()
        if (("hotelsListSelector" + $(citySelector).val()) == $(select).attr("name")) {
            $(select).css("visibility", "visible");
            $(select).css("width", "100%");
            $(select).css("opacity", "1");
        } else {
            $(select).css("visibility", "hidden");
            $(select).css("width", "0");
            $(select).css("opacity", "0");
        }
    }
})


var input = document.getElementById("input__file");
var inputAvatar = document.getElementById("input__file__avatar");


$(input).change(function (e) {
    let submit = document.getElementById("addImage");
    let label = input.nextElementSibling,
        labelVal = label.querySelector('.input__file-button-text').innerText;
    let countFiles = '';
    if (this.files && this.files.length >= 1) {
        countFiles = this.files.length;
        submit.disabled = false;
    } else {
        submit.disabled = true;
    }


    if (countFiles)
        label.querySelector('.input__file-button-text').innerText = 'Выбрано файлов: ' + countFiles;
    else
        label.querySelector('.input__file-button-text').innerText = labelVal;
});


$(inputAvatar).change(function (e) {
    let submit = document.getElementById("addAvatar");
    let label = inputAvatar.nextElementSibling,
        labelVal = label.querySelector('.input__file-button-text').innerText;
    let countFiles = '';
    if (this.files && this.files.length >= 1) {
        countFiles = this.files.length;
        submit.disabled = false;
    } else {
        submit.disabled = true;
    }


    if (countFiles)
        label.querySelector('.input__file-button-text').innerText = 'Выбрано файлов: ' + countFiles;
    else
        label.querySelector('.input__file-button-text').innerText = labelVal;
});

$("#imagesHotelSelect").change(function () {
    let selDiv = $(".imageBlock");
    $('.inputsImage input:checkbox:checked').prop("checked", false);
    $("#deleteImageInfo").css("color", "orangered");
    $("#deleteImageInfo").val("Select images");
    $("#deleteImage").prop("disabled", true);

    for (let i = 0; i < selDiv.length; i++) {
        const selectDiv = selDiv[i];
        if ($("#imagesHotelSelect").val() == $(selectDiv).attr("id")) {
            $(selectDiv).css("visibility", "visible");
            $(selectDiv).css("opacity", "1");
        } else {
            $(selectDiv).css("visibility", "hidden");
            $(selectDiv).css("opacity", "0");
        }
    }

})


async function getHotelsByCity(cityId) {
    let formData = new FormData();
    formData.append("cityId", cityId);
    let response = await fetch("ajaxFunctions/getHotelsByCity.php", {
        method: "POST",
        body: formData
    });
    if (response.ok === true) {
        let content = await response.json();
        html = "<div class='container-fluid row hotelsDiv px-0'>";
        for (let i = 0; i < content['hotel'].length; i++) {
            let hotel = content['hotel'][i];
            let image;
            if (content['image'][i])
                image = content['image'][i]['imagepath'];
            else
                image = "files/no-photo.jpg";

            let stars = "";
            for (let j = 0; j < hotel['stars']; j++) {
                stars += "&#11088;";
            }
            html +=
                `<div class='col-lg-4 col-md-6 col-sm-6 p-1'>
                <div class='hotelDiv divImage position-relative'
                    style='background-image:url(${image})'>
                    <div class='hotelBackground hoverHotel text-center position-absolute'>
                        <a href="index.php?hotel=${hotel['id']}" class="hotelLink btn-link">
                            <h5 class="m-0 p-0">INFO</h5>
                        </a>
                    </div>
                    <div class='hotelBackground staticHotel position-absolute'>
                        <div class='d-flex flex-column justify-content-between' style="height: 100%;">
                            <h2>${hotel['hotel']}</h2>
                            <div class='container-fluid d-flex justify-content-between p-0'>
                                <div class='d-flex'>${stars}</div>
                                <h4>${hotel['cost']}$</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;
        }
        html += "</div>";
        $("#HotelsList").html(html);
    }
}



async function getCitiesByCountry(countryId, parent) {
    let formData = new FormData();
    formData.append("countryId", countryId);
    let response = await fetch("ajaxFunctions/getCitiesByCountry.php", {
        method: "POST",
        body: formData
    });
    if (response.ok === true) {
        let firstOption;
        let content = await response.text();
        if (parent === "countryTourSelect") {
            $("#cityHotelSelect").html(content);
            firstOption = $("#cityHotelSelect").find("option")[1];
        }
        else if (document.getElementById('citySelect')) {
            $("#citySelect").html(content);
            firstOption = $("#citySelect").find("option")[1];
        }


        $(firstOption).attr("selected", true);
        getHotelsByCity($(firstOption).val());
    }
}

async function validationLogin(login) {
    let formData = new FormData();
    formData.append("login", login);
    let resp = await fetch("ajaxFunctions/validationLogin.php", {
        method: "POST",
        body: formData
    });
    if (resp.ok === true) {
        let content = await resp.text();
        if (content == '0') {
            $("#loginError").text("");
        }
        else $("#loginError").text("This login is taken");
    }
}