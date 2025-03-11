function loadCompleteEmployees(callback) {

    //https://stackoverflow.com/questions/8567114/how-can-i-make-an-ajax-call-without-jquery
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "http://localhost/run-php/competences-de-base-Hermocrate-main/api/getEmployees.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function () {

        //https://developer.mozilla.org/en-US/docs/Web/API/XMLHttpRequest/readyState
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.success) {
                callback(response.employees);
            } else {
                console.error("Erreur lors du chargement des employés : ", response.message);
            }
        }
    };

    xhr.send();
}


function addEmployee(employee, callback) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "http://localhost/run-php/competences-de-base-Hermocrate-main/api/addEmployee.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            callback(response);
        }
    };

    xhr.send(JSON.stringify(employee));
}