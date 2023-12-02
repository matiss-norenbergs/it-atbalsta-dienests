if(localStorage.getItem('fons') !== null && localStorage.getItem('burti') !== null && localStorage.getItem('kastes') !== null && localStorage.getItem('border') !== null) {
    let krasa = localStorage.getItem('krasa');
    let fons = localStorage.getItem('fons');
    let burti = localStorage.getItem('burti');
    let kastes = localStorage.getItem('kastes');
    let border = localStorage.getItem('border');
    document.documentElement.style.setProperty('--main-color', krasa);
    document.documentElement.style.setProperty('--bg', fons);
    document.documentElement.style.setProperty('--black', burti);
    document.documentElement.style.setProperty('--white', kastes);
    document.documentElement.style.setProperty('--border', border);
}

function aktivs(lapa){
    var aktivaLapa = document.getElementById(lapa);
    aktivaLapa.classList.add("active");
    console.log(aktivaLapa);
}

function aktivs2(lapa){
    var aktivaLapa = document.getElementById(lapa);
    aktivaLapa.classList.add("active2");
    console.log(aktivaLapa);
}