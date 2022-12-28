const btnSwitch = document.querySelector('#switch');

btnSwitch.addEventListener('click', () => {
    document.body.classList.toggle('dark');
    btnSwitch.classList.toggle('active');
});dark

//$('body').addClass('bg-pink').removeClass('dark');

$('#switch').on('click', function () {
    if ($(this).hasClass('active')) {
        $('#svg-footer-1').attr('fill', '#070707');
    } else {
        $('#svg-footer-1').attr('fill', '#FEFEFE');
    } 
});

