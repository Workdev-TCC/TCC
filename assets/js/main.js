document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('perfilModal');
    const modalDialog = modal.querySelector('.modal-dialog');
    const closeIcon = modal.querySelector('.close-icon');

    modal.addEventListener('show.bs.modal', function() {
        gsap.fromTo(modalDialog, {
            x: '-100%'
        }, {
            x: 0,
            duration: 0.3,
            ease: 'power2.out'
        });
    });

    modal.addEventListener('hide.bs.modal', function() {
        gsap.to(modalDialog, {
            x: '100%',
            duration: 0.3,
            ease: 'power2.in',
            onComplete: function() {
                modalDialog.style.transform = 'none';
            }
        });
    });

    closeIcon.addEventListener('click', function() {
        const modalInstance = bootstrap.Modal.getInstance(modal);
        modalInstance.hide();
    });
});
