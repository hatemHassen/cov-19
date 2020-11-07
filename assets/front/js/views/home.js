import Chart from 'chart.js'
let firstChartCtxL = document.getElementById("firstChart").getContext('2d');
let firstChart = new Chart(firstChartCtxL, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: JSON.parse(document.getElementById("firstChart").dataset.label),
        datasets: [{
            label: 'Nb. total de cas',
            backgroundColor: 'rgb(51, 102, 255)',
            borderColor: 'rgb(51, 102, 204)',
            data: JSON.parse(document.getElementById("firstChart").dataset.data)
        }]
    },

    // Configuration options go here
    options: {}
});
let secondChartCtxL = document.getElementById("secondChart").getContext('2d');
let secondChart = new Chart(secondChartCtxL, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: JSON.parse(document.getElementById("secondChart").dataset.label),
        datasets: [{
            label: 'Nb. de décès',
            backgroundColor: 'rgb(255, 51, 51)',
            borderColor: 'rgb(221, 51, 51)',
            data: JSON.parse(document.getElementById("secondChart").dataset.data)
        }]
    },

    // Configuration options go here
    options: {}
});
let thirdChartCtx = document.getElementById("thirdChart").getContext('2d');
let thirdChart = new Chart(thirdChartCtx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: JSON.parse(document.getElementById("thirdChart").dataset.label),
        datasets: [{
            label: 'Nb. de cas journaliers',
            backgroundColor: 'rgb(255, 153, 51)',
            borderColor: 'rgb(221, 153, 51)',
            data: JSON.parse(document.getElementById("thirdChart").dataset.data)
        }]
    },

    // Configuration options go here
    options: {}
});