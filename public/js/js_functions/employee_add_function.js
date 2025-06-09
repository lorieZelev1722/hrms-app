import displayEmployeeWorkInfo from './employee_add_work_info';

function NewEmployee(){
    this.formdata = new FormData;
    this.employee_id = null;
    this.obj = {};
    this.departmentList = {};
    this.status_options = ["Single","Married","Widowed"];
    this.gender_options = ["Female","Male"];

}

NewEmployee.prototype.displayView=async function(){
    let contentWrapper = document.querySelector('.jsContentBody') || '';
    contentWrapper.innerHTML = '';

    await loader.start();
    const view = await fetchGlobal.fetchViewData('/new_employee_content');
    const div = new DOMParser().parseFromString(view,'text/html').querySelector('.add-new-employee-form');
    this.handleImageFunction(div);
    this.handleDropdownsFunction(div);
    this.handleSubmitFunction(div);
    this.handleNextPage(div);
    contentWrapper.appendChild(div);
    loader.stop();

}


NewEmployee.prototype.handleNextPage = async function(div){
  const nextBtn = div.querySelector('.jsNextPage');

  

  nextBtn.addEventListener('click',(e)=>{
    displayEmployeeWorkInfo(this.employee_id);
    return;

      if(this.employee_id){
        displayEmployeeWorkInfo(this.employee_id);
      }else{
        alert.normal_alert('alert-danger','Please fill up employee personal info!');
      }
  });

}


NewEmployee.prototype.handleImageFunction = function(div) {
    const image_container = div.querySelector('.add-new-employee-img-content') || '';
    const image_input = image_container.querySelector('input[type="file"]') || '';
    const image_preview = image_container.querySelector('img') || '';
    const image_label = image_container.querySelector('label') || '';
    const image_span = image_container.querySelector('small') || '';
    const self = this;
    let remove_img = document.createElement('span');
    remove_img.classList.add('remove-uploaded-image');
    remove_img.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24"><path d="M17,4V2a2,2,0,0,0-2-2H9A2,2,0,0,0,7,2V4H2V6H4V21a3,3,0,0,0,3,3H17a3,3,0,0,0,3-3V6h2V4ZM11,17H9V11h2Zm4,0H13V11h2ZM15,4H9V2h6Z"/></svg>`;

  
    // Trigger file input when container is clicked
    image_container.addEventListener('click', function () {
      image_input.click();
    });
  
    // Handle file selection
    image_input.addEventListener('change', function () {
      const file = image_input.files[0];
      
      if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
  
        reader.onload = function (e) {
          image_preview.src = e.target.result;
          image_preview.style.display = 'block';
          image_label.style.display = 'none';
          image_span.style.display = 'none';
          image_container.appendChild(remove_img);
          self.formdata.append('profile_filename',file);
  
        };
  
        reader.readAsDataURL(file);
      } else {
        alert('Please select a valid image file.');
      }
    });

    remove_img.addEventListener('click',(e)=>{
        e.stopPropagation();
        const el = e.currentTarget;
        const parent_element = el.parentElement;
        image_preview.src = '';
        image_preview.removeAttribute('style');
        image_label.removeAttribute('style');
        image_span.removeAttribute('style');
        image_input.value = '';
        self.formdata.delete('profile_filename');
        parent_element.querySelector('.remove-uploaded-image').remove();
        
    });
  };

  NewEmployee.prototype.handleDropdownsFunction = function(div) {
    const self = this;
  
    const inputs = {
      status: div.querySelector('.jsStatusInput'),
      gender: div.querySelector('.jsGenderInput'),
      nationality: div.querySelector('.jsNationalityInput'),
      country: div.querySelector('input[data-type="country"]'),
      province: div.querySelector('input[data-type="province"]'),
      municipality: div.querySelector('input[data-type="town"]'),
      baranggay: div.querySelector('input[data-type="baranggay"]')
    };
  
    // 🛠 Helper: remove error class if present
    const clearErrorIfNeeded = (el) => {
      if (el.classList.contains('error-empty-input')) {
        el.classList.remove('error-empty-input');
      }
    };
  
    // 🛠 Helper: set input to empty
    const resetInput = (input) => {
      input.value = '';
      input.dataset.code = '';
    };
  
    // Status Dropdown
    inputs.status.addEventListener('click', (e) => {
      dropdown.show(self.status_options, e.currentTarget);
    });

    inputs.gender.addEventListener('click',(e)=>{
      dropdown.show(self.gender_options,e.currentTarget);
    });

    //Nationalities Dropdown
    inputs.nationality.addEventListener('click',(e)=>{
      nationality_options.country_nationality(e.currentTarget);
    });

    inputs.country.addEventListener('click',(e)=>{
      nationality_options.country(e.currentTarget.closest('.jsDropdown'));
    });
  
    // Province Dropdown
    inputs.province.addEventListener('click', async (e) => {
      clearErrorIfNeeded(e.currentTarget);
      await address_options.provinces(e.currentTarget.parentElement);
      resetInput(inputs.municipality);
      resetInput(inputs.baranggay);
    });
  
    // Municipality Dropdown
    inputs.municipality.addEventListener('click', async (e) => {
      clearErrorIfNeeded(e.currentTarget);
  
      const code = inputs.province.dataset.code;
      if (!code) {
        inputs.province.classList.add('error-empty-input');
        return;
      }
  
      dropdown.hide(inputs.province.parentElement);
      await address_options.municipalities(code, e.currentTarget.parentElement);
      resetInput(inputs.baranggay);
    });
  
    // Barangay Dropdown
    inputs.baranggay.addEventListener('click', async (e) => {
      clearErrorIfNeeded(e.currentTarget);
  
      const code = inputs.municipality.dataset.code;
      if (!code) {
        inputs.municipality.classList.add('error-empty-input');
        return;
      }
  
      dropdown.hide(inputs.province.parentElement);
      dropdown.hide(inputs.municipality.parentElement);
      await address_options.baranggays(code, e.currentTarget.parentElement);
    });
  };
  

NewEmployee.prototype.handleSubmitFunction = function(div){
  const submit_btn = div.querySelectorAll('.add-new-employee-btn');
  const input_parentElem = div.querySelectorAll('.add-new-employee-input-wrapper');

  submit_btn.forEach((btn)=>{
    btn.addEventListener('click',async (e)=>{
      this.removeErrorMessage(div);
      await this.saveByTypeFunction(e.currentTarget);
    });
  })

  
}

NewEmployee.prototype.removeErrorMessage = function(div){
  const error_message = div.querySelectorAll('.display-error') || null;

  if(error_message){
    error_message.forEach((message)=>{
        message.remove();
    });
  }
}


NewEmployee.prototype.saveByTypeFunction = async function(btn) {
  const type = btn.closest('.add-new-employee-section').dataset.id;
  const inputParentElem = btn.nextElementSibling;

  // Helper to create the edit button
  const createEditButton = () => {
    const editBtn = document.createElement('span');
    editBtn.classList.add('update-employee-btn', 'employee-disable-btn');
    editBtn.textContent = 'Edit';
    return editBtn;
  };

  // Helper to handle API save logic
  const handleSave = async (url) => {
    if (this.checkInputValue(inputParentElem) !== 0) return;

    await loader.start();
    const data = await fetchGlobal.fetchPostData(url, this.formdata);
    loader.stop();

    if (data.status_code === 200) {
      alert.normal_alert('alert-success', 'Save Successfully!');
      btn.remove();
      this.employee_id = data.employee?.id || data.employee;
      this.formdata = new FormData();
      if (this.employee_id) {
        this.formdata.append('employee_id', this.employee_id);
      }
      
      this.disableInput(inputParentElem);
      inputParentElem.appendChild(createEditButton());
    }
    else if(data.status_code === 422 && data.errors){
      this.displayValidationError(data.errors,inputParentElem);
    } 
    else {
      alert.normal_alert('alert-danger', 'Something went wrong, please try again later!');
    }
  };

  switch (type) {
    case 'personalInfo':
      await handleSave('/save_personal_info');
      break;

    case 'contactInfo':
      if (!this.employee_id) {
        alert.normal_alert('alert-warning', 'Please fill up personal information first.');
        return;
      }
      await handleSave('/save_contact_info');
      break;

    case 'addressInfo':
      console.log(this.employee_id);
      if (!this.employee_id) {
        alert.normal_alert('alert-warning', 'Please fill up personal information first.');
        return;
      }
      await handleSave('/save_address_info');
      break;

    default:
      console.warn(`Unknown type: ${type}`);
  }
};


NewEmployee.prototype.displayValidationError = function(errors, inputParentElem) {
  const inputs = inputParentElem.querySelectorAll('input');

  Object.entries(errors).forEach(([key, messages]) => {
      messages.forEach((message) => {
          inputs.forEach((input) => {
              if (input.name === key) {
                  const label = input.previousElementSibling;

                  // Check if label exists and doesn't already have the error
                  if (label && !label.querySelector('.display-error')) {
                      const errorMessage = document.createElement('small');
                      errorMessage.classList.add('display-error');
                      errorMessage.textContent = message;

                      label.appendChild(errorMessage);
                  }

                  input.classList.add('error-empty-input');
              }
          });
      });
  });
};



NewEmployee.prototype.disableInput = function(inputParentElem){
  inputParentElem.querySelectorAll('input').forEach((item)=>{
        item.disabled = true;
  });
}


NewEmployee.prototype.checkInputValue = function(inputParentElem){
  let error = 0;
  inputParentElem.querySelectorAll('input').forEach((element)=>{
    if(element.required && element.value || !element.required && element.value)
    {
        this.formdata.append(element.name,element.value);
        element.classList.remove('error-empty-input');
    }else if (element.required && !element.value){
        element.classList.add('error-empty-input');
        error += 1;
    }
  });
  return error;

}

  

export default function displayAddNewEmployeeView(){
    const cc = new NewEmployee();
    cc.displayView();
}