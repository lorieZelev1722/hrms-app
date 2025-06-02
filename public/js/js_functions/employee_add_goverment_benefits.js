function EmployeeGovermentBenefits(){

}

EmployeeGovermentBenefits.prototype.displayView = async function(){
    const contentWrapper = document.querySelector('.jsContentBody');
    contentWrapper.innerHTML = '';

    await loader.start();
}