function valaszok() {
    document.getElementById('valaszok').innerHTML = "";
    document.getElementById('eredmenyek').innerHTML = "";
    let szam = document.getElementById('valaszokSzama').value

    for (let i = 0; i < szam; i++) {
        let div = document.createElement('div')
        div.classList.add('form-group')
        div.setAttribute("id", "valasz"+i);
        let label = document.createElement('label')
        label.innerText = "Válasz " + (i+1)
        let input = document.createElement('input')
        input.type = "text"
        input.name = "valasz" + (i+1)
        input.placeholder = "Válasz" + (i+1) + '...'
        input.classList.add('form-control')
        document.getElementById('valaszok').appendChild(div)
        document.getElementById('valasz'+i).appendChild(label)
        document.getElementById('valaszok').appendChild(input)
    }

    for (let i = 0; i < szam; i++) {
        let input = document.createElement('input')
        input.type = "number"
        input.name = "eredmeny" + (i+1)
        input.value = 0;
        input.classList.add('hide');
        document.getElementById('eredmenyek').appendChild(input)
    }
}

function mutat(id) {
    console.log('hali')
    document.getElementById('users'+id).classList.toggle('hide')
}