window.onscroll = function() {pasleptKrasas()};

document.getElementById("krasas-btn").addEventListener("click", paraditKrasas);

function paraditKrasas(){
    var krasas = document.querySelector("#krasas-dropdown");
    if(krasas.style.display == "none"){
        krasas.style.display = "block";
    }else{
        krasas.style.display = "none";
    }
}

function pasleptKrasas(){
    var krasas = document.querySelector("#krasas-dropdown");
    if(krasas.style.display == "block"){
        krasas.style.display = "none";
    }
}

function balts(){
    document.documentElement.style.setProperty('--main-color', '#32ABBC');
    document.documentElement.style.setProperty('--bg', '#e6e6e6');
    document.documentElement.style.setProperty('--black', '#111');
    document.documentElement.style.setProperty('--white', '#fff');
    document.documentElement.style.setProperty('--border', '3px solid rgba(0, 0, 0, 0.2)');
    localStorage.setItem('krasa', '#32ABBC');
    localStorage.setItem('fons', '#e6e6e6');
    localStorage.setItem('burti', '#111');
    localStorage.setItem('kastes', '#fff');
    localStorage.setItem('border', '3px solid rgba(0, 0, 0, 0.2)');
    pasleptKrasas();
}

function melns(){
    document.documentElement.style.setProperty('--main-color', '#29909e');
    document.documentElement.style.setProperty('--bg', '#111');
    document.documentElement.style.setProperty('--black', '#e6e6e6');
    document.documentElement.style.setProperty('--white', '#333');
    document.documentElement.style.setProperty('--border', '3px solid rgba(255, 255, 255, 0.2)');
    localStorage.setItem('krasa', '#29909e');
    localStorage.setItem('fons', '#111');
    localStorage.setItem('burti', '#e6e6e6');
    localStorage.setItem('kastes', '#333');
    localStorage.setItem('border', '3px solid rgba(255, 255, 255, 0.2)');
    pasleptKrasas();
}

function dzeltens(){
    document.documentElement.style.setProperty('--main-color', '#000');
    document.documentElement.style.setProperty('--bg', '#fcde67');
    document.documentElement.style.setProperty('--black', '#3d3d3d');
    document.documentElement.style.setProperty('--white', '#ad973d');
    document.documentElement.style.setProperty('--border', '3px solid rgba(0, 0, 0, 0.2)');
    localStorage.setItem('krasa', '#000');
    localStorage.setItem('fons', '#fcde67');
    localStorage.setItem('burti', '#3d3d3d');
    localStorage.setItem('kastes', '#ad973d');
    localStorage.setItem('border', '3px solid rgba(0, 0, 0, 0.2)');
    pasleptKrasas();
}

function zils(){
    document.documentElement.style.setProperty('--main-color', '#B23850');
    document.documentElement.style.setProperty('--bg', '#21218a');
    document.documentElement.style.setProperty('--black', '#E7E3D4');
    document.documentElement.style.setProperty('--white', '#444');
    document.documentElement.style.setProperty('--border', '3px solid rgba(18, 18, 71, 0.2)');
    localStorage.setItem('krasa', '#B23850');
    localStorage.setItem('fons', '#21218a');
    localStorage.setItem('burti', '#E7E3D4');
    localStorage.setItem('kastes', '#444');
    localStorage.setItem('border', '3px solid rgba(18, 18, 71, 0.2)');
    pasleptKrasas();
}