var isActive = 1;

document.addEventListener('DOMContentLoaded', () => {
    const pendButton = document.getElementById('pend');
    const precButton = document.getElementById('prec');
    const fpickButton = document.getElementById('fpick');
    const ocompButton = document.getElementById('ocomp');
    const denButton = document.getElementById('den');

    function clicker() {
        switch (isActive) {
            case 1: return 'pend';
            case 2: return 'prec';
            case 3: return 'fpick';
            case 4: return 'ocomp';
            case 5: return 'den';
        }
    }

    function moveBack() {
        switch (isActive) {
            case 1: return '0px';
            case 2: return '200px';
            case 3: return '400px';
            case 4: return '600px';
            case 5: return '800px';
        }
    }

    function updateTables(indexNum){
        switch(indexNum){
            case 1: 
                document.getElementById('pendTab').style.display = 'table';
                document.getElementById('precTab').style.display = 'none';
                document.getElementById('fpickTab').style.display = 'none';
                document.getElementById('ocompTab').style.display = 'none';
                document.getElementById('denTab').style.display = 'none';
                break;
            case 2: 
                document.getElementById('pendTab').style.display = 'none';
                document.getElementById('precTab').style.display = 'table';
                document.getElementById('fpickTab').style.display = 'none';
                document.getElementById('ocompTab').style.display = 'none';
                document.getElementById('denTab').style.display = 'none';
                break;
            case 3: 
                document.getElementById('pendTab').style.display = 'none';
                document.getElementById('precTab').style.display = 'none';
                document.getElementById('fpickTab').style.display = 'table';
                document.getElementById('ocompTab').style.display = 'none';
                document.getElementById('denTab').style.display = 'none';
                break;
            case 4: 
                document.getElementById('pendTab').style.display = 'none';
                document.getElementById('precTab').style.display = 'none';
                document.getElementById('fpickTab').style.display = 'none';
                document.getElementById('ocompTab').style.display = 'table';
                document.getElementById('denTab').style.display = 'none';
                break;    
            case 5: 
                document.getElementById('pendTab').style.display = 'none';
                document.getElementById('precTab').style.display = 'none';
                document.getElementById('fpickTab').style.display = 'none';
                document.getElementById('ocompTab').style.display = 'none';
                document.getElementById('denTab').style.display = 'table';
                break;
        }
    }
    function addHoverEvents(button, index) {
        button.addEventListener('mouseenter', () => {
            if (isActive !== index) { // Check isActive during hover
                button.style.color = '#ffc107';
                button.style.fontWeight = '500';
                var prev = clicker();
                console.log(prev);
                document.getElementById('dLine').style.left = `${(index - 1) * 200}px`; // Move dLine based on the index
                document.getElementById(prev).style.color = 'gray';
                document.getElementById(prev).style.fontWeight = '200';
            }
        });

        button.addEventListener('mouseleave', () => {
            if (isActive !== index) { // Check isActive during hover
                button.style.color = 'gray';
                var prev = clicker();
                document.getElementById('dLine').style.left = moveBack();
                document.getElementById(prev).style.color = '#ffc107';
                document.getElementById(prev).style.fontWeight = '500';
                button.style.fontWeight = '200';
            }
        });

        button.addEventListener('click', function () {
            isActive = index;
            updateTables(index);
        });
    }

    if (pendButton) addHoverEvents(pendButton, 1);
    if (precButton) addHoverEvents(precButton, 2);
    if (fpickButton) addHoverEvents(fpickButton, 3);
    if (ocompButton) addHoverEvents(ocompButton, 4);
    if (denButton) addHoverEvents(denButton, 5);
});
