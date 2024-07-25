// function to handle response and display error messages
export function handleResponse(ErrorMessage) {
    const messageContainer = jQuery('#messages-container');

    const message = jQuery('<div></div>').addClass('message error');

    ErrorMessage.forEach(error => {
        const translatedError = error;
        message.html(translatedError);
    });

    messageContainer.append(message);

    setTimeout(() => {
        message.addClass('hide');
        setTimeout(() => {
            message.remove();
        }, 400);
    }, 5000);
}

// function to display custom messages
export function customMessage(text, type) {
    const messageContainer = jQuery('#messages-container');
    const messageType = type ? type : 'error';
    const message = jQuery('<div></div>').addClass('message').addClass(messageType).html(text);

    messageContainer.append(message);

    setTimeout(() => {
        message.addClass('hide');
        setTimeout(() => {
            message.remove();
        }, 400);
    }, 5000);
}