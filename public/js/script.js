

document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("employee-form");
    const employeeList = document.getElementById("employee-list");
    const completeEmployeeList = document.getElementById("complete-employee-list");

    let employees = []; 

    // Fonction pour afficher les employés dans la liste dynamique
    function renderEmployees() {
        employeeList.innerHTML = ""; 
        employees.sort((a, b) => a.nom.localeCompare(b.nom));
    
        employees.forEach(employe => {
            const newEmployee = document.createElement("li");
    
            const idPara = document.createElement("p");
            idPara.textContent = `Employé n°${employe.id}`;
    
            const nomPara = document.createElement("p");
            nomPara.textContent = employe.nom;
    
            const statutPara = document.createElement("p");
            statutPara.textContent = employe.statut;
    
            const datePara = document.createElement("p");
            datePara.textContent = employe.dateNaissance;
    
            const salairePara = document.createElement("p");
            salairePara.textContent = employe.salaire;
    
            const editLink = document.createElement("a");
            editLink.href = "#";
            editLink.textContent = "Modifier";
    
            const deleteLink = document.createElement("a");
            deleteLink.href = "#";
            deleteLink.textContent = "Supprimer";
            deleteLink.classList.add("delete-btn");
    
            const hr = document.createElement("hr");
    
            newEmployee.appendChild(idPara);
            newEmployee.appendChild(nomPara);
            newEmployee.appendChild(statutPara);
            newEmployee.appendChild(datePara);
            newEmployee.appendChild(salairePara);
            newEmployee.appendChild(editLink);
            newEmployee.appendChild(deleteLink);
            newEmployee.appendChild(hr);
    
            deleteLink.addEventListener("click", function (event) {
                event.preventDefault();
                employees = employees.filter(e => e.id !== employe.id);
                renderEmployees();
            });
    
            employeeList.appendChild(newEmployee);
        });
    }

    // Fonction pour afficher les employés dans la liste complète
    function renderCompleteEmployees(employees) {
        completeEmployeeList.innerHTML = ""; 
        employees.sort((a, b) => a.nom.localeCompare(b.nom));
    
        employees.forEach(employe => {
            const newEmployee = document.createElement("li");
    
            const idPara = document.createElement("p");
            idPara.textContent = `Employé n°${employe.id}`;
    
            const nomPara = document.createElement("p");
            nomPara.textContent = employe.nom;
    
            const statutPara = document.createElement("p");
            statutPara.textContent = employe.statut;
    
            const datePara = document.createElement("p");
            datePara.textContent = employe.dateNaissance;
    
            const salairePara = document.createElement("p");
            salairePara.textContent = employe.salaire;
    
            const hr = document.createElement("hr");
    
            newEmployee.appendChild(idPara);
            newEmployee.appendChild(nomPara);
            newEmployee.appendChild(statutPara);
            newEmployee.appendChild(datePara);
            newEmployee.appendChild(salairePara);
            newEmployee.appendChild(hr);
    
            completeEmployeeList.appendChild(newEmployee);
        });
    }

    // Charger tous les employés au démarrage
    loadCompleteEmployees(function (employees) {
        renderCompleteEmployees(employees);
    });

    // Gestion de la soumission du formulaire
    form.addEventListener("submit", function (event) {
        event.preventDefault();

        const nom = document.getElementById("EMPLOYE_NOM").value;
        const statut = document.getElementById("EMPLOYE_STATUT").value;
        const dateNaissance = document.getElementById("EMPLOYE_DATE_NAISSANCE").value;
        const salaire = document.getElementById("EMPLOYE_SALAIRE").value;
        const employeId = Math.floor(Math.random() * 1000);

        const newEmployee = {
            id: employeId,
            nom,
            statut,
            dateNaissance,
            salaire
        };

        // Ajouter l'employé via Ajax
        addEmployee(newEmployee, function (response) {
            if (response.success) {
                employees.push(newEmployee);
                renderEmployees();
                form.reset();
                loadCompleteEmployees(function (employees) {
                    renderCompleteEmployees(employees);
                });
            } else {
                alert("Erreur : " + response.message);
            }
        });
    });
});