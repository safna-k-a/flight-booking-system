// author:JOMOL GEORGE
// Date:16-03-2023
//Registrationform

console.log("hello");
function validate() {
    let vname = /^[a-z A-Z]+$/;
    var phoneno = /^\d{10}$/;
    let n = document.getElementById("name").value;

    let mregx =
        /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    let em = document.getElementById("email").value;
    let p = document.getElementById("password").value;
    let c_p = document.getElementById("c_password").value;
    let phone = document.getElementById("phone").value;
    let passlen = c_p.length;
    let phlen = phone.length;

    if (n == "") {
        document.getElementById("name").innerHTML;
        alert("empty feild, please enter the name");
        return false;
    } else if (!vname.test(n)) {
        document.getElementById("name").innerHTML;
        alert("Please enter your fullname");
        return false;
    } else if (em == "") {
        document.getElementById("email").innerHTML;
        alert("enter your email id");
        return false;
    } else if (!mregx.test(em)) {
        document.getElementById("email").innerHTML;
        alert("Please include an '@' in the email address. ");
        return false;
    } else if (p != c_p) {
        alert("Passwords do not match.");
        return false;
    } else if (passlen <= 7) {
        document.getElementById("c_password").innerHTML;
        alert("Password length must be atleast 8 characters");
        return false;
    } else if (phone == "") {
        document.getElementById("phone").innerHTML;
        alert("empty feild, please enter the phone number");
        return false;
    } else if (!phoneno.test(phone)) {
        document.getElementById("phone").innerHTML;
        alert("Enter valid phone number");
        return false;
    } else if (phlen != 10) {
        document.getElementById("phone").innerHTML;
        alert("Please enter 10 digit phone number");
        return false;
    } else {
        return true;
    }
}

//Author : ANJALI SOMAN
//validation in searching flights form in index page
function svalidate() {
    let from = document.getElementById("departure").value;
    let to = document.getElementById("arrival").value;
    var date = document.getElementById("date").value;
    var varDate = new Date(date); //dd-mm-YYYY
    var today = new Date();
    today.setHours(0, 0, 0, 0);
    if (from == "") {
        alert("Select a departure airport!");
        return false;
    } else if (to == "") {
        alert("Select an arrival airport");
        return false;
    } else if (date == "") {
        alert("Select a date");
        return false;
    } else if (!(varDate >= today)) {
        alert("Please select a date after today!");
        return false;
    } else {
        return true;
    }
}

/*author:SAFNA K A*/
let count = 1;
$("#passenger2").hide();
$("#passenger3").hide();
function addPassenger() {
    if (count < 3) count++; // Increment passenger count by 1
    document.getElementById("passengerCount").innerHTML = count;
}

function subtractpassenger() {
    if (count > 1) {
        count--; // decrement passenger count by 1
        document.getElementById("passengerCount").innerHTML = count;
    }
}

$(document).ready(() => {
    count = 1;

    $("#plus").click(() => {
        if (count == 2) {
            $("#passenger2").show(2000);
        }
        if (count == 3) {
            $("#passenger3").show(2000);
        }
    });

    $("#minus").click(() => {
        if (count == 1) {
            $("#passenger2").hide(2000);
            // $("#passenger3").hide(2000);
        }
        if (count == 2) {
            $("#passenger3").hide(2000);
        }
    });
});

// author:JOMOL GEORGE
// Date:19-03-2023
//login page

function log_validate() {
    let mr =
        /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    let e = document.getElementById("eml").value;
    let pass = document.getElementById("pwd").value;
    if (e == "") {
        document.getElementById("eml").innerHTML;
        alert("enter your email id");
        return false;
    } else if (!mr.test(e)) {
        document.getElementById("eml").innerHTML;
        alert("Please enter valid email address. ");
        return false;
    } else if (pass == "") {
        document.getElementById("pwd").innerHTML;
        alert("please fill the password field");
        return false;
    } else {
        return true;
    }
}

// author:JOMOL GEORGE
// Date:19-03-2023
//airport-add
alert("hello");
function airport_validate() {
    let air = document.getElementById("name").value;
    let abr = document.getElementById("abbr").value;
    if (air == "") {
        document.getElementById("name").innerHTML;
        alert("please add the airportname");
        return false;
    } else if (abr == "") {
        document.getElementById("abbr").innerHTML;
        alert("enter the abbr name ");
        return false;
    } else {
        return true;
    }
}

// author:JOMOL GEORGE
// Date:19-03-2023
//flight-add

function flight_validate() {
    alert("hello");

    let flight = document.getElementById("name").value;
    let id = document.getElementById("airline_id").value;
    let seat = document.getElementById("total_seat").value;
    if (flight == "") {
        document.getElementById("name").innerHTML;
        alert("Field is empty! Please enter the flight name");
        return false;
    } else if (id == "") {
        document.getElementById("arline_id").innerHTML;
        alert("Empty field");
        return false;
    } else if (seat == "") {
        document.getElementById("total_seat").innerHTML;
        alert("Empty field");
        return false;
    } else {
        return true;
    }
}

// author:JOMOL GEORGE
// Date:19-03-2023
//flight-add

function flight_validate() {
    alert("hello");

    let flight = document.getElementById("name").value;
    let id = document.getElementById("airline_id").value;
    let seat = document.getElementById("total_seat").value;
    if (flight == "") {
        document.getElementById("name").innerHTML;
        alert("Field is empty! Please enter the flight name");
        return false;
    } else if (id == "") {
        document.getElementById("arline_id").innerHTML;
        alert("Empty field");
        return false;
    } else if (seat == "") {
        document.getElementById("total_seat").innerHTML;
        alert("Empty field");
        return false;
    } else {
        return true;
    }
}
