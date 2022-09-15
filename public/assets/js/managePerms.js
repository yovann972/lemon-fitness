
document.querySelectorAll('input[type="checkbox"]').forEach(input => {
    input.addEventListener('change', (e) => {
        e.preventDefault();

        if (input.id == 'sellDrinks') {
            let structureId = input.value;
            const url = window.location.origin + "/active/" + structureId + "/vente-de-boisson";
    
            fetch(url)
            .then(response => response.json())
            .catch(e => console.log(e))
            
        } else if(input.id == 'memberStat') {
            let structureId = input.value;
            const url= window.location.origin + "/active/" + structureId + "/statistique-des-membres";
    
            fetch(url)
            .then(response => response.json())
            .catch(e => console.log(e))

        } else if(input.id == 'paymentSchedule') {
            let structureId = input.value;
            const url = window.location.origin + "/active/" + structureId + "/calendrier-de-payement";
    
            fetch(url)
            .then(response => response.json())
            .catch(e => console.log(e))
        } else if(input.id == 'employeePlanning') {
            let structureId = input.value;
            const url = window.location.origin + "/active/" + structureId + "/planning-employes";
    
            fetch(url)
            .then(response => response.json())
            .catch(e => console.log(e))

        }


    })
})

