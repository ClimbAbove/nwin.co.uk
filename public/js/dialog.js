function showDialog(dialog)
{
    if(dialog.dataset.dialogAllowMultiple !== 'true') {
        closeAlreadyOpenDialogs();
    }


    dialog.showModal();
    dialog.addEventListener('click', function (event) {
        let rect = dialog.getBoundingClientRect();
        let isInDialog = (rect.top <= event.clientY && event.clientY <= rect.top + rect.height &&
            rect.left <= event.clientX && event.clientX <= rect.left + rect.width);
        if (!isInDialog) {
            closeDialog(dialog);
        }
    });
}

function closeAlreadyOpenDialogs()
{
    let dialogs = document.getElementsByTagName('dialog');
    for(let d= 0; d < dialogs.length; d++) {
        closeDialog(dialogs[d]);
    }
}

function closeDialog(dialog)
{
    let permission = dialog.getElementsByClassName('permission');

    if(permission.length) {
        let emailButtons = document.getElementsByClassName('button_email_quote');
        let sent = dialog.getElementsByClassName('sent');
        permission[0].classList.remove('display_none');
        sent[0].classList.add('display_none');
        for(let i = 0; i < emailButtons.length; i++) {
            resetDoubleClick(emailButtons[i]);
        }
    }

    dialog.close();
}
window.addEventListener("load", function(event) {
    addDialogEventListeners();
});

function addDialogEventListeners()
{
    const openers = document.getElementsByClassName("open_dialog");
    const closers = document.getElementsByClassName("close_dialog");

    for (let i = 0; i < openers.length; i++) {

        openers[i].addEventListener('click', function (event) {
            if(parseInt(window.innerWidth) <= 720) {
                return true;

            }
            const dialog = document.getElementById(this.dataset.dialog);
            if(dialog.dataset.mode == 'form') {
                return true;
            }
            event.preventDefault();
            showDialog(dialog);

        });

    }

    for (let i = 0; i < closers.length; i++) {
        closers[i].addEventListener('click', function (e) {
            const dialog = this.closest('dialog');
            closeDialog(dialog);
        });
    }
}
