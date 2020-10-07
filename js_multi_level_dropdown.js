console.log("JavaScript Multi Level Dropdown");

var state_dropdown = document.getElementById("state");
var district_dropdown = document.getElementById("district");
var address_dropdown = document.getElementById("city");
var district_div = document.getElementById("district_div");
var city_div = document.getElementById("city_div");

district_div.style.display = "none";
city_div.style.display = "none";

async function getStates() {
  var response = await fetch("http://localhost/api_data.php");

  var json_data = await response.json();

  console.log(json_data);

  state_dropdown.innerHTML = "";
  json_data.forEach((item, index) => {
    var option = document.createElement("option");
    option.text = item.state;
    option.value = item.id;

    state_dropdown.appendChild(option);
  });
}

async function getDistrict(state_id) {
  district_div.style.display = "none";
  var response = await fetch(
    "http://localhost/api_data.php?type=district&state_id=" + state_id
  );

  var json_data = await response.json();

  console.log(json_data);

  district_dropdown.innerHTML = "";
  json_data.forEach((item, index) => {
    var option = document.createElement("option");
    option.value = item.id;
    option.text = item.district;

    district_dropdown.appendChild(option);
  });
  district_div.style.display = "block";
}

async function getAddress(district_id) {
  city_div.style.display = "none";
  var response = await fetch(
    "http://localhost/api_data.php?type=address&district_id=" + district_id
  );

  var json_data = await response.json();

  console.log(json_data);

  address_dropdown.innerHTML = "";
  json_data.forEach((item, index) => {
    var option = document.createElement("option");
    option.value = item.id;
    option.text = item.address + " Pin : " + item.pincode;

    address_dropdown.appendChild(option);
  });
  city_div.style.display = "block";
}

getStates();

state_dropdown.onchange = function () {
  getDistrict(state_dropdown.value);
};

district_dropdown.onchange = function () {
  getAddress(district_dropdown.value);
};
