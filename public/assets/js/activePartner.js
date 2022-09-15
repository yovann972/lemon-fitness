const active = document.querySelector('#js-active');



document.querySelectorAll("#js-active input").forEach(input => {

    input.addEventListener('change', (e) => {
        e.preventDefault();
        let partnerId = input.value;
        const url = window.location.origin + "/partner/" + partnerId + "/actif"
         fetch(url)
         .then(response => response.json())
         .catch(e => console.log(e))
    })
})






