const header = document.querySelector('header');
function fixedNavbar() {
    header.classList.toggle('scrolled', window.pageYOffset > 0)
}
fixedNavbar();
window.addEventListener('scroll', fixedNavbar);

let menu = document.querySelector('#menu-btn');
let userBtn = document.querySelector('#user-btn');

menu.addEventListener('click', function() {
    let nav = document.querySelector('.navbar');
    nav.classList.toggle('active');
})

userBtn.addEventListener('click', function(){
    let userBox = document.querySelector('.user-box');
    userBox.classList.toggle('active');
})
document.addEventListener('click', function(event) {

    let userBox = document.querySelector('.user-box');
    let userBtn = document.querySelector('#user-btn');

    if (!userBox.contains(event.target) && !userBtn.contains(event.target)) {
        userBox.classList.remove('active');
    }

});

// PHONE LIMIT 10 DIGIT
const phone = document.querySelector('input[name="number"]');
if(phone){
    phone.addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '').slice(0,10);
    });
}

// PIN LIMIT 6 DIGIT
const pin = document.querySelector('input[name="pin"]');
pin.addEventListener('input', function() {
    this.value = this.value.replace(/[^0-9]/g, '').slice(0,6);
});

//for country dropdown
const pinInput = document.getElementById("pin");
const countrySelect = document.getElementById("country");
const stateSelect = document.getElementById("state");
const citySelect = document.getElementById("city");

// ================= PIN AUTO FILL =================
pinInput.addEventListener("keyup", function(){

    let pin = this.value;

    if(pin.length === 6){

        fetch(`https://api.postalpincode.in/pincode/${pin}`)
        .then(res => res.json())
        .then(data => {

            if(data[0].Status === "Success"){

                let post = data[0].PostOffice[0];

                countrySelect.innerHTML = `<option selected>${post.Country}</option>`;
                stateSelect.innerHTML = `<option selected>${post.State}</option>`;
                citySelect.innerHTML = `<option selected>${post.District}</option>`;

                countrySelect.style.background = "#eaffea";
                stateSelect.style.background = "#eaffea";
                citySelect.style.background = "#eaffea";


                // ✅ use this instead
                countrySelect.style.pointerEvents = "none";
                stateSelect.style.pointerEvents = "none";
                citySelect.style.pointerEvents = "none";

            } else {
                alert("Invalid PIN ❌");
            }
        });
    }

    // agar user PIN hata de
    if(pin.length < 6){
        countrySelect.disabled = false;
        stateSelect.disabled = false;
        citySelect.disabled = false;
    }
});

// ================= LOAD COUNTRIES =================
fetch("https://countriesnow.space/api/v0.1/countries/positions")
.then(res => res.json())
.then(data => {

    data.data.forEach(c => {
        let opt = document.createElement("option");
        opt.value = c.name;
        opt.textContent = c.name;
        countrySelect.appendChild(opt);
    });
    // Default India
    countrySelect.value = "India";
    countrySelect.dispatchEvent(new Event("change"));
});
// ================= COUNTRY → STATE =================
countrySelect.addEventListener("change", function(){

    fetch("https://countriesnow.space/api/v0.1/countries/states", {
        method:"POST",
        headers:{"Content-Type":"application/json"},
        body: JSON.stringify({ country: this.value })
    })
    .then(res => res.json())
    .then(data => {

        stateSelect.innerHTML = "<option>Select State</option>";

        data.data.states.forEach(s => {
            let opt = document.createElement("option");
            opt.value = s.name;
            opt.textContent = s.name;
            stateSelect.appendChild(opt);
        });
    });
});


// ================= STATE → CITY =================
stateSelect.addEventListener("change", function(){

    fetch("https://countriesnow.space/api/v0.1/countries/state/cities", {
        method:"POST",
        headers:{"Content-Type":"application/json"},
        body: JSON.stringify({
            country: countrySelect.value,
            state: this.value
        })
    })
    .then(res => res.json())
    .then(data => {

        citySelect.innerHTML = "<option>Select City</option>";
        data.data.forEach(city => {
            let opt = document.createElement("option");
            opt.value = city;
            opt.textContent = city;
            citySelect.appendChild(opt);
        });
    });
});

//use current location
// ================= CURRENT LOCATION AUTO FILL =================
const locationBtn = document.getElementById("location-btn");

if(locationBtn){
    locationBtn.addEventListener("click", function(){

        if(navigator.geolocation){

            locationBtn.innerText = "Fetching location...";

            navigator.geolocation.getCurrentPosition(function(position){

                let lat = position.coords.latitude;
                let lon = position.coords.longitude;

                fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lon}&format=json`)
                .then(res => res.json())
                .then(data => {

                    let address = data.address;
                    let city = address.city || address.town || address.village || "";
                    let state = address.state || "";
                    let country = address.country || "";
                    let pin = address.postcode || "";

                    setSelectValue(countrySelect, country);
                    setSelectValue(stateSelect, state);
                    setSelectValue(citySelect, city);

                    countrySelect.style.pointerEvents = "auto";
                    stateSelect.style.pointerEvents = "auto";
                    citySelect.style.pointerEvents = "auto";
                    document.getElementById("pin").value = pin;
                    // STREET AUTO FILL
                    let street =
                        address.road ||
                        address.neighbourhood ||
                        address.suburb ||
                        "";

                    document.querySelector('input[name="street"]').value = street;

                    // FLAT AUTO (optional)
                    let flat =
                        address.house_number ||
                        address.building ||
                        "";

                    document.querySelector('input[name="flat"]').value = flat;

                    // HIGHLIGHT
                    countrySelect.style.background = "#eaffea";
                    stateSelect.style.background = "#eaffea";
                    citySelect.style.background = "#eaffea";

                    locationBtn.innerText = "Location Loaded ✅";

                });

            }, function(){
                alert("Permission denied ❌");
                locationBtn.innerText = "Use My Location 📍";
            });

        } else {
            alert("Geolocation not supported");
        }
    });
}

function setSelectValue(select, value){

    let found = false;

    for(let i=0; i<select.options.length; i++){
        if(select.options[i].value.toLowerCase() === value.toLowerCase()){
            select.selectedIndex = i;
            found = true;
            break;
        }
    }

    if(!found && value){
        let opt = document.createElement("option");
        opt.value = value;
        opt.textContent = value;
        opt.selected = true;
        select.appendChild(opt);
    }
}

