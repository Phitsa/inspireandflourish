(function() {
    var openPopup = document.getElementById('openRegisterPopup');
    var modal = document.getElementById('RegisterMemberDialog');
    var closePopup = document.getElementById('closePopup');

    openPopup.addEventListener('click', function() {
        modal.showModal();
    });

    modal.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.close();
        }
    });

    closePopup.addEventListener('click', function() {
        modal.close();
    });
})();

