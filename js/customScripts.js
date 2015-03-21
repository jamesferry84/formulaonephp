/**
 * Created by James on 21/03/2015.
 */
var constructorNames = [];
var constructorPrices = [];
var driverPrices = [];
var driverNames = [];

var selectedPrices = [];
selectedPrices[0] = 0;
selectedPrices[1] = 0;
selectedPrices[2] = 0;
selectedPrices[3] = 0;

var startingWeeklyBudget = 55.00;

var carryOver = document.getElementById('carriedOver').value;
var elem = document.getElementById("remainingBudget");

if (carryOver < startingWeeklyBudget)
{
    elem.value = (startingWeeklyBudget + carryOver * 1); // multiply used to force integer addition instead of concatenation
}
else
{
    elem.value = carryOver;
}


var firstSelected = null;
var secondSelected = null;

var firstConstructorSelected = null;
var secondConstructorSelected = null;

function Update()
{
    var newValue = parseFloat(carryOver - selectedPrices[0] - selectedPrices[1] - selectedPrices[2] - selectedPrices[3]).toFixed(2);
    document.getElementById("remainingBudget").value = newValue;

    if (newValue < 0)
    {
        $('#submitButton').prop('disabled',true);
    }
    else
    {
        $('#submitButton').prop('disabled',false);
    }
}

$('#driver1DropDown').change(function() {
    var selectedValue = $('#driver1DropDown option:selected')
    var str = selectedValue.val();
    var result = str.split(",");
    selectedPrices[0] = result[1];
    Update();

    if (selectedValue.val() != "") {
        $('#driver2DropDown option[value="' + selectedValue.val() + '"]').remove();
    }
    else {
        selectedValue = null;
    }
    if (firstSelected != null) {
        $('#driver2DropDown').append($('<option>', { value : firstSelected.val() }).text(firstSelected.text()));

    }
    firstSelected = selectedValue;
});

$('#driver2DropDown').change(function() {
    var selectedValue = $('#driver2DropDown option:selected')

    var str = selectedValue.val();
    var result = str.split(",");
    selectedPrices[1] = result[1];
    Update();

    if (selectedValue.val() != "") {
        $('#driver1DropDown option[value="' + selectedValue.val() + '"]').remove();
    }
    else {
        selectedValue = null;
    }

    if (secondSelected != null) {
        $('#driver1DropDown').append($('<option>', { value : secondSelected.val() }).text(secondSelected.text()));

    }

    //save the currently selected value
    secondSelected = selectedValue;
});

$('#constructor1DropDown').change(function() {
    var selectedValue = $('#constructor1DropDown option:selected')

    var str = selectedValue.val();
    var result = str.split(",");
    selectedPrices[2] = result[1];
    Update();

    if (selectedValue.val() != "") {
        $('#constructor2DropDown option[value="' + selectedValue.val() + '"]').remove();
    }
    else {
        selectedValue = null;
    }
    if (firstConstructorSelected != null) {
        $('#constructor2DropDown').append($('<option>', { value : firstConstructorSelected.val() }).text(firstConstructorSelected.text()));

    }
    firstConstructorSelected = selectedValue;
});

$('#constructor2DropDown').change(function() {
    var selectedValue = $('#constructor2DropDown option:selected')

    var str = selectedValue.val();
    var result = str.split(",");
    selectedPrices[3] = result[1];
    Update();

    if (selectedValue.val() != "") {
        $('#constructor1DropDown option[value="' + selectedValue.val() + '"]').remove();
    }
    else {
        selectedValue = null;
    }

    if (secondConstructorSelected != null) {
        $('#constructor1DropDown').append($('<option>', { value : secondConstructorSelected.val() }).text(secondConstructorSelected.text()));

    }

    //save the currently selected value
    secondConstructorSelected = selectedValue;
});

$.getJSON("drivers.php", function(data) {
    $.each(data, function(key,val) {
        driverNames.push(val.Name);
        driverPrices.push(val.Price);
        $("#driver1DropDown").append($("<option />").val(val.Name + ", " + val.Price).text(val.Name + " £" + val.Price));
        $("#driver2DropDown").append($("<option />").val(val.Name + ", " + val.Price).text(val.Name + " £" + val.Price));
    })
});

$.getJSON("constructors.php", function(data) {
    $.each(data, function(key,val) {
        constructorNames.push(val.Name);
        constructorPrices.push(val.Price);
        $("#constructor1DropDown").append($("<option />").val(val.Name + ", " + val.Price).text(val.Name + " £" + val.Price));
        $("#constructor2DropDown").append($("<option />").val(val.Name + ", " + val.Price).text(val.Name + " £" + val.Price));
    })
});