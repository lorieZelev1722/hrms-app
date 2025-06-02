function LoginForm(){
    this.formData = new FormData;
    this.objValue = [];
    this.response;
}

LoginForm.prototype.displayForm = async function(){
    const view = await fetchGlobal.fetchViewData('/login_form_view') || '';
    const form_container = document.querySelector('.jsLoginForm');

    const form = new DOMParser().parseFromString(view,'text/html').querySelector('.hrms-login-form-container');
    this.handleEventListener(form);
    
    if(form){
       form_container.appendChild(form);
    }
}

LoginForm.prototype.handleEventListener = async function(container){
    let self = this;
   const login_button = container.querySelector('.jsLoginButton') || '';
   const view_pass = container.querySelector('.hrms-reveal-password') || '';
   const inputs = container.querySelectorAll('input');
 
   inputs.forEach((input)=>{
    input.addEventListener('input',()=>{
        input.parentElement.classList.remove('error-input-border');
       });
   });
   
   login_button.addEventListener('click',async ()=>{
    
      if(self.checkInputValue(container) == 0){
       
         await self.loginSubmit();
      }
   });

   view_pass.addEventListener('click',(e)=>{
        const el = e.currentTarget;
        const passwordInput = el.previousElementSibling;

        if(el.classList.contains('hide-pass')){
           passwordInput.type = 'text';
           el.classList.remove('hide-pass');
           el.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24"><path d="M23.821,11.181v0C22.943,9.261,19.5,3,12,3S1.057,9.261.179,11.181a1.969,1.969,0,0,0,0,1.64C1.057,14.739,4.5,21,12,21s10.943-6.261,11.821-8.181A1.968,1.968,0,0,0,23.821,11.181ZM12,18a6,6,0,1,1,6-6A6.006,6.006,0,0,1,12,18Z"/><circle cx="12" cy="12" r="4"/></svg>'
           
        }else{
            passwordInput.type = 'password';
            el.classList.add('hide-pass');
            el.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g id="_01_align_center" data-name="01 align center"><path d="M23.821,11.181v0a15.736,15.736,0,0,0-4.145-5.44l3.032-3.032L21.293,1.293,18,4.583A11.783,11.783,0,0,0,12,3C4.5,3,1.057,9.261.179,11.181a1.969,1.969,0,0,0,0,1.64,15.736,15.736,0,0,0,4.145,5.44L1.293,21.293l1.414,1.414L6,19.417A11.783,11.783,0,0,0,12,21c7.5,0,10.943-6.261,11.821-8.181A1.968,1.968,0,0,0,23.821,11.181ZM2,12.011C2.75,10.366,5.693,5,12,5a9.847,9.847,0,0,1,4.518,1.068L14.753,7.833a4.992,4.992,0,0,0-6.92,6.92L5.754,16.832A13.647,13.647,0,0,1,2,12.011ZM15,12a3,3,0,0,1-3,3,2.951,2.951,0,0,1-1.285-.3L14.7,10.715A2.951,2.951,0,0,1,15,12ZM9,12a3,3,0,0,1,3-3,2.951,2.951,0,0,1,1.285.3L9.3,13.285A2.951,2.951,0,0,1,9,12Zm3,7a9.847,9.847,0,0,1-4.518-1.068l1.765-1.765a4.992,4.992,0,0,0,6.92-6.92l2.078-2.078A13.584,13.584,0,0,1,22,12C21.236,13.657,18.292,19,12,19Z"></path></g></svg>'
        }
   })
}



LoginForm.prototype.checkInputValue = function(container){
    const inputs = container.querySelectorAll('input');
    
    const self = this;
    let check = 0;

    inputs.forEach(input => {
        if(input.getAttribute("type") != "hidden"){
       
        if(input.value == ''){
            input.parentElement.classList.add('error-input-border');
            check +=1;
        }else{
            input.parentElement.classList.remove('error-input-border');
            self.objValue[input.name]=input.value;
        }
    }

    });

    return check;

}


LoginForm.prototype.loginSubmit = async function(){
     this.formData.append('username',this.objValue["username"]);
     this.formData.append('password',this.objValue["password"]);
     const previous_message = document.querySelector('.error-text-span') || '';
    if(previous_message) previous_message.remove();
    
     let error_message = document.createElement('small');

     await loader.start();
     let data = await fetchGlobal.fetchPostData("/login_submit",this.formData);
     
    if(data.status == 'error'){       
        error_message.classList.add('error-text-span');
        error_message.innerHTML = `Wrong Credentials <br> Invalid username or password.`;
        document.querySelector('.jsSpanContainer').appendChild(error_message);
    }else if(data.status == 'failed'){
        error_message.classList.add('error-text-span');
        error_message.innerHTML = `Notice <br> This account is already disabled.`;
        document.querySelector('.jsSpanContainer').appendChild(error_message);
    }   
    else{
        window.location.href= data.redirect;
    }



     loader.stop();
     
}

export default async function displayLoginForm(){
    const cc = new LoginForm();
    await cc.displayForm();
}