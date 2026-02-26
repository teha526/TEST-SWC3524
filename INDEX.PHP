<!DOCTYPE html>
<html>
<head>
    <title>Travel Information</title>
    <meta charset="UTF-8">
</head>
<body>

<h2>Travel Information</h2>

<table border="1" id="travelTable">
    <tr>
        <th>User Name</th>
        <th>Destination</th>
        <th>Travel Date</th>
        <th>Temperature (°C)</th>
        <th>Exchange Rate (USD → Local)</th>
    </tr>
</table>

<script>
async function loadData() {

    // 1️⃣ Get database data
    const response = await fetch("getTrips.php");
    const trips = await response.json();

    const table = document.getElementById("travelTable");

    for (let trip of trips) {

        // 2️⃣ Weather API (OpenWeather)
        let weatherResponse = await fetch(
             const apiKey = "6bac423d87e3bb5f9345a479062bd1cc";
    const url = `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}&units=metric`;
        let weatherData = await weatherResponse.json();
        let temperature = weatherData.main?.temp ?? "N/A";

        // 3️⃣ Exchange Rate API
        let exchangeResponse = await fetch(
            `https://v6.exchangerate-api.com/v6/YOUR_EXCHANGE_API_KEY/latest/USD`
        );
        let exchangeData = await exchangeResponse.json();
        let rate = exchangeData.conversion_rates[trip.currency] ?? "N/A";

        // 4️⃣ Insert into table
        let row = table.insertRow();

        row.insertCell(0).innerText = trip.name;
        row.insertCell(1).innerText = trip.city;
        row.insertCell(2).innerText = trip.travel_date;
        row.insertCell(3).innerText = temperature;
        row.insertCell(4).innerText = rate;
    }
}

loadData();
</script>

</body>
</html>
