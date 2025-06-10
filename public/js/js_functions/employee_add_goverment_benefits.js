function EmployeeGovermentBenefits(){
   this.formdata = new FormData();
}

EmployeeGovermentBenefits.prototype.displayView = async function(){
    const contentWrapper = document.querySelector('.jsContentBody');
    contentWrapper.innerHTML = '';

    await loader.start();
    const view = await fetchGlobal.fetchViewData('/new_employee_content_p2') || '';

    if(view){
        const div = new DOMParser().parseFromString(view,'text/html').querySelector('.add-new-employee-form');
        contentWrapper.appendChild(div);
    }

    loader.stop();

}

export default function displayGovermentBenefits(){
     const cc = new EmployeeGovermentBenefits();
     cc.displayView();
}