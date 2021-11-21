<?php
session_start();
require_once ('../../includes/DatabaseManager.php');
$dbm = new DatabaseManager();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Dashboard</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../images/02_ROCvF_logo_PLAT_RGB%201.png" /> <!--needs a favicon here (roc-dev logo or software dev opleiding logo)-->
<!--    <link rel="stylesheet" href="../../styles/universal.css">-->
    <link rel="stylesheet" href="../../styles/admin-page.css"
</head>

<body>

<div class="container">

    <div class="header color-roc-orange">
        <img class="logo" alt="ROC Logo" src="../../images/02_ROCvF_logo_PLAT_RGB%201.png">
        <img class="hamburger" alt="hamburger" src="../../images/hamburger.png">
        <div class="profile"></div>
    </div>

    <div class="hamburger-menu color-roc-orange">
        <a class="color-roc-white-text text-center-margin" href="#">Stage</a>
        <br>
        <a class="color-roc-white-text" href="#">Studievoortgang</a>
        <br>
        <a class="color-roc-white-text" href="#">Cijfers</a>
        <br>
        <a class="color-roc-white-text" href="#">Vakken</a>
    </div>

    <div class="profile-menu">
        <a class="color-roc-white-text" href="#">Stage</a>
        <br>
        <a class="color-roc-white-text" href="#">Studievoortgang</a>
        <br>
        <a class="color-roc-white-text" href="#">Cijfers</a>
        <br>
        <a class="color-roc-white-text" href="#">Vakken</a>
    </div>

    <div class="flex-container">

        <div class="flex-child magenta">
            <div class="search-bar">
                <input type="text" class="input-field" id="searchInput" onkeyup="searchFunction()" placeholder="Zoek een vak...">
            </div>
            <ul id="myUL">
                <script>
                    fetch('server_get_names.php', {
                        method: 'POST',
                        headers: {
                            'Content-type': 'application/json'
                        },
                    }).then((response) => response.json())
                        .then(data => {
                            const subjects_array = [];
                            for (i = 0; i < data.length; i++) {
                                subjects_array.push({name: data[i]['name'], id: data[i]['subject_id']})
                            }
                            const subjectElement = document.querySelector('#myUL');

                            for (let i = 0; i < subjects_array.length; i++) {
                                const html = `<li><button onclick="getDatabaseData(${subjects_array[i]['id']})" class="subject">${subjects_array[i]['name']}</button></li>`; //template literal

                                subjectElement.insertAdjacentHTML('beforeend', html);
                            }
                        });
                </script>
            </ul>
        </div>

        <div class="flex-child result">
        </div>

    </div>

    <script>

        function getDatabaseData(DBid) {
              fetch('server.php', {
                method: 'POST',
                headers: {
                    'Content-type': 'application/json'
                },
                body: JSON.stringify(DBid)
            })
                .then((response) => response.json())
                .then(data => {
                    const html = `
<form name="update-data" action="javascript:saveToDatabase(subjectName.value, hours.value, ${DBid})" method="POST">
<label for="name">Naam van vak</label>
<br />
<input class="input-field" type="text" id="subjectName" name="name" placeholder="Naam van vak" value="${data['name']}">
<br />
<label for="hours">Verwacht aantal uur</label>
<br />
<input class="input-field" type="number" id="hours" name="hours" placeholder="Aantal uur" value="${data['hours']}">
<br />
<button type="submit" class="subject">Opslaan</button>
</form>
            `
                    document.getElementsByClassName('result')[0].innerHTML = html;
                });
        }

        function saveToDatabase(name, hours, id) {
            const data = {name: name, hours: hours, id: id}
            const resultElement = document.querySelector('.result');
            fetch('server_update_data.php', {
                method: 'POST',
                body: JSON.stringify(data),
                headers: {
                    'Content-type': 'application/json'
                },
            })
                .then((response) => response.json())
                .then(data => {
                    console.log(data);
                    if (data === true) {
                        const html = '<div id="savedMessage">Opgeslagen</div>';
                        resultElement.insertAdjacentHTML('beforeend', html);
                    } else {
                        const html = '<p id="notSavedMessage">Er ging iets mis</p>';
                        resultElement.insertAdjacentHTML('beforeend', html);
                    }
                });
        }


        function searchFunction() {
            // Declare variables
            var input, filter, ul, li, a, i, txtValue;
            input = document.getElementById('searchInput');
            filter = input.value.toUpperCase();
            ul = document.getElementById("myUL");
            li = ul.getElementsByTagName('li');

            // Loop through all list items, and hide those who don't match the search query
            for (i = 0; i < li.length; i++) {
                a = li[i].getElementsByTagName("button")[0];
                txtValue = a.textContent || a.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "";
                } else {
                    li[i].style.display = "none";
                }
            }
        }
    </script>
</html>

