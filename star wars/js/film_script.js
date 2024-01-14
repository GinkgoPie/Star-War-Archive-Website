
var showingAllPeople = false;

var showingAllPlanets = false;

var showingAllVehicles = false;

var showingAllStarships = false;


function togglePeople() {
var container = document.getElementById("people-container");
var button = document.getElementById("people-toggle-button");

showingAllPeople = !showingAllPeople;
var max = showingAllPeople ? peopleData.length : 12;


container.innerHTML = '';


for (var i = 0; i < max; i++) {
var person = peopleData[i];
var card = document.createElement("div");
card.className = "col-md-2";
card.innerHTML = `
            <a href="people.php?person_id=${person.person_id}" class="card mb-sm-3" style="background-color: darkgoldenrod; height: 150px">
                <div class="card-header-tabs text-center text-dark">${person.people_name}</div>
                <div class="card-body text-primary d-flex justify-content-center">
                    <img src="${person.image_url}" onerror="this.src='img/default_image.jpg'" style="max-width:100%; max-height: 100%" alt="${person.people_name}">
                </div>
            </a>`;
container.appendChild(card);
}

button.innerHTML = showingAllPeople ? "Show Less" : "Show More";
}

function togglePlanet() {
var container = document.getElementById("planet-container");
var button = document.getElementById("planet-toggle-button");

showingAllPlanets = !showingAllPlanets;
var max = showingAllPlanets ? planetsData.length : 6;
console.log(max.toString())
container.innerHTML = '';

for (var i = 0; i < max; i++) {
var planet = planetsData[i];
var card = document.createElement("div");
card.className = "col-md-2";
card.innerHTML = `
            <a href="planets.php?planet_id=${planet.planet_id}" class="card mb-sm-3" style="background-color: darkgoldenrod; height: 150px">
                        <div class="card-header-tabs text-center text-dark">${planet.planet_name}</div>
                        <div class="card-body text-primary d-flex justify-content-center">
                            <img src="${planet.image_url.replace(/\/revision\/latest$/, '')}" onerror="this.src='img/default_image.jpg'" style="max-width:100%; max-height: 100%" alt="${planet.planet_name}">
                        </div>
                    </a>`;
container.appendChild(card);
}

button.innerHTML = showingAllPlanets ? "Show Less" : "Show More";
}

function toggleVehicle() {
var container = document.getElementById("vehicle-container");
var button = document.getElementById("vehicle-toggle-button");

showingAllVehicles = !showingAllVehicles;
var max = showingAllVehicles ? vehiclesData.length : 6;
container.innerHTML = '';

for (var i = 0; i < max; i++) {
var vehicle = vehiclesData[i];
var card = document.createElement("div");
card.className = "col-md-2";
card.innerHTML = `
            <a href="planets.php?planet_id=${vehicle.vehicle_id}" class="card mb-sm-3" style="background-color: darkgoldenrod; height: 150px">
                        <div class="card-header-tabs text-center text-dark">${vehicle.vehicle_name}</div>
                        <div class="card-body text-primary d-flex justify-content-center">
                            <img src="${vehicle.image_url.replace(/\/revision\/latest$/, '')}" onerror="this.src='img/default_image.jpg'" style="max-width:100%; max-height: 100%" alt="${vehicle.vehicle_name}">
                        </div>
                    </a>`;
container.appendChild(card);
}

button.innerHTML = showingAllVehicles ? "Show Less" : "Show More";
}

function toggleStarship() {
    var container = document.getElementById("starship-container");
    var button = document.getElementById("starship-toggle-button");

    showingAllStarships = !showingAllStarships;
    var max = showingAllStarships ? starshipsData.length : 6;
    container.innerHTML = '';

    for (var i = 0; i < max; i++) {
        var starship = starshipsData[i];
        var card = document.createElement("div");
        card.className = "col-md-2";
        card.innerHTML = `
            <a href="planets.php?planet_id=${starship.starship_id}" class="card mb-sm-3" style="background-color: darkgoldenrod; height: 150px">
                        <div class="card-header-tabs text-center text-dark">${starship.starship_name}</div>
                        <div class="card-body text-primary d-flex justify-content-center">
                            <img src="${starship.image_url.replace(/\/revision\/latest$/, '')}" onerror="this.src='img/default_image.jpg'" style="max-width:100%; max-height: 100%" alt="${starship.starship_name}">
                        </div>
                    </a>`;
        container.appendChild(card);
    }

    button.innerHTML = showingAllStarships ? "Show Less" : "Show More";
}
