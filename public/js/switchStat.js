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


    var star1 = document.getElementById('star-button1');
    var star2 = document.getElementById('star-button2');
    var star3 = document.getElementById('star-button3');
    var star4 = document.getElementById('star-button4');
    var star5 = document.getElementById('star-button5');
    var clearButton = document.getElementById('clear-stars');
    
    const stars = [
        star1,
        star2,
        star3,
        star4,
        star5
    ];
    
    let selectedIndex = -1; // Keep track of the selected star
    
    // Function to handle mouse enter
    function handleMouseEnter(index) {
        for (let i = 0; i < stars.length; i++) {
            stars[i].style.backgroundColor = i <= index ? '#E2B93B' : 'rgb(231, 231, 231)';
        }
    }
    
    // Function to handle mouse leave
    function handleMouseLeave() {
        for (let i = 0; i < stars.length; i++) {
            stars[i].style.backgroundColor = i <= selectedIndex ? '#E2B93B' : 'rgb(231, 231, 231)';
        }
    }
    
    // Function to handle click
    function handleClick(index) {
        selectedIndex = index; // Update selected index
        clearButton.style.display = 'block';
        handleMouseLeave(); // Update stars display based on selection
    }
    
    // Add event listeners for each star
    stars.forEach((star, index) => {
        star.addEventListener('mouseenter', () => handleMouseEnter(index));
        star.addEventListener('mouseleave', handleMouseLeave);
        star.addEventListener('click', () => handleClick(index));
    });
    
    function resetStars() {
        // Reset all stars to default color
        stars.forEach(star => {
            star.style.backgroundColor = 'rgb(231, 231, 231)';
        });
        clearButton.style.display = 'none';
        selectedIndex = -1; // Reset selected index
    }
    
    // Reset stars when modal is closed
    const rateModal = document.getElementById('rateModal');
    rateModal.addEventListener('hidden.bs.modal', resetStars);
    
    // Clear stars when clear button is clicked
    clearButton.addEventListener('click', resetStars);

    document.getElementById('submit-ratings').addEventListener('click', function(){
        const msgModal = new bootstrap.Modal(document.getElementById('msg-modal'));
        msgModal.show();
    })
    
    const rateOrderButton = document.getElementById('rate-order');
    
    // Function to open the rateModal
    function openRateModal() {
        const rateModal = new bootstrap.Modal(document.getElementById('rateModal'));
        rateModal.show(); // Open the modal
    }

    // Event listener for the Rate Order button
    rateOrderButton.addEventListener('click', function () {
        openRateModal(); // Call the function to open the modal
    });
});

