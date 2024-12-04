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
    function updateActiveButton(index) {
        const buttons = [pendButton, precButton, fpickButton, ocompButton, denButton];
        buttons.forEach((button, idx) => {
            if (idx === index - 1) {
                button.classList.add('active');   // Add active class
                button.classList.remove('inactive'); // Remove inactive class if previously set
                document.getElementById('pend').style.borderBottomColor = 'rgb(219, 219, 219) !important';
            } else {
                button.classList.remove('active'); 
                button.classList.add('inactive');  
            }
        });
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
                document.getElementById(prev).style.color = '#ffc107';
                document.getElementById(prev).style.fontWeight = '500';
                button.style.fontWeight = '200';
                document.getElementById('dLine').style.left = moveBack();
            }
        });
        button.addEventListener('click', function () {
            isActive = index;
            updateActiveButton(index);
        });
    }

    if (pendButton) addHoverEvents(pendButton, 1);
    if (precButton) addHoverEvents(precButton, 2);
    if (fpickButton) addHoverEvents(fpickButton, 3);
    if (ocompButton) addHoverEvents(ocompButton, 4);
    if (denButton) addHoverEvents(denButton, 5);

    // Reset stars when modal is closed
    const rateModal = document.getElementById('rateModal');
    rateModal.addEventListener('hidden.bs.modal', resetStars);
    
    // Clear stars when clear button is clicked
    clearButton.addEventListener('click', resetStars);

});

