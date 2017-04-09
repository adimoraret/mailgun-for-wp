import './emailsender.scss';

export class EmailSender{

    constructor(){
        this.sendEmail= this.sendEmail.bind(this);
    }

    sendEmail(){
        console.log("Email sent");
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const emailSender = new EmailSender();
    document.getElementById('emailSender').onclick = emailSender.sendEmail;
});

