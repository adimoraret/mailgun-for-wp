/**
 * Created by Adrian Moraret on 3/23/2017.
 */
export class Spinner{

    constructor(htmlSpinnerId){
        this.spinnerElement = document.getElementById(htmlSpinnerId);
        this.showSpinner = this.showSpinner.bind(this);
        this.hideSpinner = this.hideSpinner.bind(this);
    }

    showSpinner(){
        this.spinnerElement.classList.toggle('is-active', true);
    }

    hideSpinner(){
        this.spinnerElement.classList.toggle('is-active', false);
    }
}
