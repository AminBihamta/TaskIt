//changes themes of page to pink, cyan, orange or back to purple
//changes to light theme

//change to Pink
document.addEventListener('DOMContentLoaded', (event) => {
    const changeToPinkButton = document.getElementsByClassName('changeToPink')[0];

    changeToPinkButton.addEventListener('click', () => {
        document.documentElement.style.setProperty('--Primary-color', '#E531C8'); 
        document.documentElement.style.setProperty('--Light-Purple-Text-Color', '#FDAFFF'); 
        document.documentElement.style.setProperty('--Done-Background-color', '#7B1A60'); 
        document.documentElement.style.setProperty('--Purple-Background-Fill', '#2A1622'); 
        document.documentElement.style.setProperty('--Primary-Text-Color', '#FFF');
        document.documentElement.style.setProperty('--Background-color', '#111111');
    });
});

//change to cyan
document.addEventListener('DOMContentLoaded', (event) => {
    const changeToPinkButton = document.getElementsByClassName('changeToCyan')[0];

    changeToPinkButton.addEventListener('click', () => {
        document.documentElement.style.setProperty('--Primary-color', '#2CB6A5'); 
        document.documentElement.style.setProperty('--Light-Purple-Text-Color', '#AFE7FF'); 
        document.documentElement.style.setProperty('--Done-Background-color', '#1A697B'); 
        document.documentElement.style.setProperty('--Purple-Background-Fill', '#162A25'); 
        document.documentElement.style.setProperty('--Primary-Text-Color', '#FFF');
        document.documentElement.style.setProperty('--Background-color', '#111111');
    });
});

//change to orange
document.addEventListener('DOMContentLoaded', (event) => {
    const changeToPinkButton = document.getElementsByClassName('changeToOrange')[0];

    changeToPinkButton.addEventListener('click', () => {
        document.documentElement.style.setProperty('--Primary-color', '#B67F2C'); 
        document.documentElement.style.setProperty('--Light-Purple-Text-Color', '#FFD6AF'); 
        document.documentElement.style.setProperty('--Done-Background-color', '#784B16'); 
        document.documentElement.style.setProperty('--Purple-Background-Fill', '#2A2316'); 
        document.documentElement.style.setProperty('--Primary-Text-Color', '#FFF');
        document.documentElement.style.setProperty('--Background-color', '#111111');
    });
});

//change to purple
document.addEventListener('DOMContentLoaded', (event) => {
    const changeToPinkButton = document.getElementsByClassName('changeToPurple')[0];

    changeToPinkButton.addEventListener('click', () => {
        document.documentElement.style.setProperty('--Primary-color', '#5531E5'); 
        document.documentElement.style.setProperty('--Light-Purple-Text-Color', '#BFAFFF'); 
        document.documentElement.style.setProperty('--Done-Background-color', '#2D1A7B'); 
        document.documentElement.style.setProperty('--Purple-Background-Fill', '#16172A'); 
    });
});

//change to light theme
document.addEventListener('DOMContentLoaded', (event) => {
    const changeToPinkButton = document.getElementsByClassName('changeToLight')[0];

    changeToPinkButton.addEventListener('click', () => {
        document.documentElement.style.setProperty('--Primary-color', '#5531E5'); 
        document.documentElement.style.setProperty('--Light-Purple-Text-Color', '#BFAFFF'); 
        document.documentElement.style.setProperty('--Done-Background-color', '#2D1A7B'); 
        document.documentElement.style.setProperty('--Purple-Background-Fill', '#16172A'); 
        document.documentElement.style.setProperty('--Primary-Text-Color', '#111111');
        document.documentElement.style.setProperty('--Background-color', '#FFF');
    });
});