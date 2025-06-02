
const fetchGlobal = {
    // Fetch view data (GET request for HTML content)
    fetchViewData: async function(url) {
        try {
            const response = await fetch(url);
            const view = await response.text();
            if (view) {
                return view;
            }
        } catch (error) {
            console.error("This view has error:", error);
        }
    },

    // Fetch GET data (GET request for JSON data)
    fetchGetData: async function(url) {
        try {
            const response = await fetch(url);
            if (!response.ok) {
                throw new Error('Not found');
            }
            const data = await response.json();
            if (data) {
                return data;
            }
        } catch (error) {
            console.error("Error, please check:", error);
        }
    },

    // Fetch POST data (POST request with form data)
    fetchPostData: async function(url, formData) {
        try {
            const response = await fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    // Do not set Content-Type here, let FormData handle it automatically
                },
                credentials: 'same-origin' // Important for Laravel session + CSRF
            });
    
            if (response.status === 302) {
                const location = response.headers.get('Location');
                console.log('Redirected to:', location);
                window.location.href = location; // or handle it as needed
            } else {
                const contentType = response.headers.get('content-type');
                if (contentType && contentType.includes('application/json')) {
                    const data = await response.json();
                    return data;
                } else {
                    const text = await response.text();
                    console.warn('Got non-JSON response:', text);
                }
            }
        } catch (error) {
            console.error('Error:', error);
           
        }
    }
    
};


const loader = {
    start: async function(){
       try{
        const loader_view = await fetchGlobal.fetchViewData('/loader');
        if(loader_view){
            document.body.appendChild(new DOMParser().parseFromString(loader_view,'text/html').querySelector('.loader-container'));
        }
       }catch{
            console.log('Error:',error);
       }
    },

    stop: function(){
        const loader_view = document.querySelector('.loader-container') || '';

        // console.log(loader_view);

        if(loader_view){
            loader_view.remove();
        }
    }
};

const sideBar = {
    open:function(){
        let sideBarContainer = document.querySelector('.sidebar-container') || '';
        sideBarContainer.classList.remove('close-sidebar');
    },
    close:function(){
        let sideBarContainer = document.querySelector('.sidebar-container') || '';
        sideBarContainer.classList.add('close-sidebar');
    }
}

const alert = {
      
    alert_with_link: function(type,message,link = null){
        let obj = alert_icon(type);
       const alert_wrapper = document.createElement('div');
       alert_wrapper.classList.add('alert-container-wrapper');
       let content = `<div class="alert-box ${type}">
       <div class="alert-box-icon-message">
           <div class="alert-box-icon-image">
            ${obj.icon}
           </div>
           <h3>${obj.message}</h3>
           <span class="alert-box-message">
               ${message}
           </span>
       </div>
       <span class="alert-box-btn ${obj.btn} jsAlertBtn">Continue</span>
        </div>`;
        alert_wrapper.appendChild(new DOMParser().parseFromString(content,'text/html').querySelector('.alert-box'));
        document.body.appendChild(alert_wrapper);

        alert_wrapper.querySelector('.jsAlertBtn').addEventListener('click',()=>{
                alert_wrapper.remove();
                if(link){
                    window.location.href = link;
                }
        });


    },
    alert_with_callback: function(type,message,callback = null){
        let obj = alert_icon(type);
       const alert_wrapper = document.createElement('div');
       alert_wrapper.classList.add('alert-container-wrapper');
       let content = `<div class="alert-box ${type}">
       <div class="alert-box-icon-message">
           <div class="alert-box-icon-image">
            ${obj.icon}
           </div>
           <h3>${obj.message}</h3>
           <span class="alert-box-message">
               ${message}
           </span>
       </div>
       <span class="alert-box-btn ${obj.btn} jsAlertBtn">Continue</span>
        </div>`;
        alert_wrapper.appendChild(new DOMParser().parseFromString(content,'text/html').querySelector('.alert-box'));
        document.body.appendChild(alert_wrapper);

        alert_wrapper.querySelector('.jsAlertBtn').addEventListener('click',()=>{
                alert_wrapper.remove();
                if(callback){
                    callback();
                }
        });


    },
    normal_alert: function(type,message){
        let obj = alert_icon(type);
        const alert_wrapper = document.createElement('div');
        alert_wrapper.classList.add('alert-container-wrapper');
        let content = `<div class="alert-box ${type}">
        <div class="alert-box-icon-message">
            <div class="alert-box-icon-image">
             ${obj.icon}
            </div>
            <h3>${obj.message}</h3>
            <span class="alert-box-message">
                ${message}
            </span>
        </div>
        <span class="alert-box-btn ${obj.btn} jsAlertBtn">Ok</span>
         </div>`;
         alert_wrapper.appendChild(new DOMParser().parseFromString(content,'text/html').querySelector('.alert-box'));
         document.body.appendChild(alert_wrapper);

         alert_wrapper.querySelector('.jsAlertBtn').addEventListener('click',()=>{
            alert_wrapper.remove();
        });
    }

}


function alert_icon(alert_type){
    let obj = {
        icon : '',
        message : '',
        btn : '',
    }

    switch(alert_type){

        case 'alert-success':
            obj.btn = 'alert-btn-success',
            obj.message = 'Success!';
            obj.icon =  '<svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24"><path d="m12,0C5.383,0,0,5.383,0,12s5.383,12,12,12,12-5.383,12-12S18.617,0,12,0Zm-.091,15.419c-.387.387-.896.58-1.407.58s-1.025-.195-1.416-.585l-2.782-2.696,1.393-1.437,2.793,2.707,5.809-5.701,1.404,1.425-5.793,5.707Z"/></svg>';
        break;
        case 'alert-warning':
            obj.btn = 'alert-btn-warning',
            obj.message = 'Warning!';
            obj.icon = '<svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24"><path d="M24,12A12,12,0,1,1,12,0,12.013,12.013,0,0,1,24,12ZM13,14.257a1.982,1.982,0,0,1,.93-1.752A4,4,0,1,0,8,9h2a2,2,0,0,1,2.371-1.967,2.024,2.024,0,0,1,1.6,1.595,2,2,0,0,1-1,2.125A3.954,3.954,0,0,0,11,14.257V15h2ZM13,17H11v2h2Z"/></svg>';
        break;
        case 'alert-danger':
            obj.btn = 'alert-btn-danger',
            obj.message = 'Danger!';
            obj.icon = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><path d="M256,0C114.615,0,0,114.615,0,256s114.615,256,256,256s256-114.615,256-256C511.847,114.678,397.322,0.153,256,0z    M341.333,311.189c8.669,7.979,9.229,21.475,1.25,30.144c-7.979,8.669-21.475,9.229-30.144,1.25c-0.434-0.399-0.85-0.816-1.25-1.25   L256,286.165l-55.168,55.168c-8.475,8.185-21.98,7.95-30.165-0.525c-7.984-8.267-7.984-21.373,0-29.64L225.835,256l-55.168-55.168   c-8.185-8.475-7.95-21.98,0.525-30.165c8.267-7.984,21.373-7.984,29.64,0L256,225.835l55.189-55.168   c7.979-8.669,21.475-9.229,30.144-1.25c8.669,7.979,9.229,21.475,1.25,30.144c-0.399,0.434-0.816,0.85-1.25,1.25L286.165,256   L341.333,311.189z"/></g> </svg>';
        break;
        case 'alert-secondary':
            obj.btn = 'alert-btn-secondary',
            obj.message = 'Notice!';
            obj.icon = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><path d="M256,0C114.615,0,0,114.615,0,256s114.615,256,256,256s256-114.615,256-256C511.847,114.678,397.322,0.153,256,0z M256,448   c-106.039,0-192-85.961-192-192S149.961,64,256,64s192,85.961,192,192C447.882,361.99,361.99,447.882,256,448z"/><path d="M256,321.941c17.673,0,32-14.327,32-32V140.608c0-17.673-14.327-32-32-32s-32,14.327-32,32v149.333   C224,307.614,238.327,321.941,256,321.941z"/><circle cx="256.107" cy="373.333" r="32"/></g> </svg>';
        break;
        default:
            obj.btn = 'alert-btn-primary',
            obj.message = 'Notice!';
            obj.icon = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><path d="M256,0C114.615,0,0,114.615,0,256s114.615,256,256,256s256-114.615,256-256C511.847,114.678,397.322,0.153,256,0z M256,448   c-106.039,0-192-85.961-192-192S149.961,64,256,64s192,85.961,192,192C447.882,361.99,361.99,447.882,256,448z"/><path d="M256,321.941c17.673,0,32-14.327,32-32V140.608c0-17.673-14.327-32-32-32s-32,14.327-32,32v149.333   C224,307.614,238.327,321.941,256,321.941z"/><circle cx="256.107" cy="373.333" r="32"/></g> </svg>';

    }

    return obj;

}

const dropdown_filter = {

    show: function(data,callback=null,input_type=null){
        const dropdownContainer = document.createElement('div');
        const parentElement = document.querySelector('.jsDropdown');
        dropdownContainer.classList.add('dropdown-container');
        let content = '';

        if(!parentElement.classList.contains('show-dropdown')){
            parentElement.classList.add('show-dropdown');
            data.forEach((item)=>{
                content = `
                <span class="dropdown-link-li">
                <input type="radio" value="${item.id}" class="no-check">
                <small>${item.name}</small>
                </span>
                `;
                let itemParse = new DOMParser().parseFromString(content,'text/html').querySelector('span'); 
                dropdownContainer.appendChild(itemParse);
                content = '';
                
            });
            const inputFilters = dropdownContainer.querySelectorAll('input[type="radio"]');
            inputFilters.forEach((input)=>{
                input.addEventListener('click',(e)=>{
                    e.stopPropagation();
                    const el = e.currentTarget;
                        if(el.classList.contains('no-check')){
                           
                            inputFilters.forEach((input)=>{
                                if(!input.classList.contains('no-check')){
                                    input.classList.add('no-check');
                                    input.checked = false;
                                }
                            });
                            el.checked = true;
                            el.classList.remove('no-check');
                            
                            if(callback){
                                callback(el.value);
                            }  
                        }else{
                            el.classList.add('no-check');
                            el.checked = false;
                        }
    
                });
            });

            parentElement.appendChild(dropdownContainer);
           
        }else{
            this.hide();
        }
       
      
    },
    hide:function(){
        const parentElement = document.querySelector('.jsDropdown');
        parentElement.querySelector('.dropdown-container').remove();
        parentElement.classList.remove('show-dropdown');
    }
}

const dropdown = {
    show: function(data, parentElement) {
        const self = this;
        const inputElement = parentElement.querySelector('input');
        let searchOptions = {};
      
        // Remove any existing dropdowns
        document.querySelectorAll('.dropdown-container').forEach(item => {
          item.parentElement.classList.remove('show-dropdown');
          item.remove();
        });
      
        // Toggle dropdown
        if (parentElement.classList.contains('show-dropdown')) {
          self.hide(parentElement);
          return;
        }
      
        parentElement.classList.add('show-dropdown');
      
        const dropdownContainer = document.createElement('div');
        dropdownContainer.classList.add('dropdown-container', 'full-width-dropdown-container');
      
        function displayOptions(dataToShow) {
          dropdownContainer.innerHTML = '';
      
          if (dataToShow.length === 0) {
            dropdownContainer.innerHTML = '<div class="no-results">No results found</div>';
            return;
          }
      
          dataToShow.forEach(item => {
            const content = `
              <span class="dropdown-link-li dropdown-link-li-no-grid dropdown-option" data-value="${item.name || item}" data-code="${item.code || 0}">
                <small>${item.name || item}</small>
              </span>
            `;
            const itemNode = new DOMParser().parseFromString(content, 'text/html').querySelector('span');
            dropdownContainer.appendChild(itemNode);
          });
      
          dropdownContainer.querySelectorAll('.dropdown-option').forEach(option => {
            option.addEventListener('click', (e) => {
              e.stopPropagation();
              inputElement.value = e.currentTarget.dataset.value;
              inputElement.dataset.code = e.currentTarget.dataset.code;
      
              inputElement.classList.remove('error-empty-input');
              self.hide(parentElement);
            });
          });
        }
      
        // Initial render
        displayOptions(data);
      
        // Append to DOM
        parentElement.appendChild(dropdownContainer);
      
        // Bind input filtering
        inputElement.addEventListener('input', (e) => {
          const search = e.currentTarget.value.toLowerCase();
          searchOptions = data.filter(option => {
            const name = option.name || option;
            return name.toLowerCase().includes(search);
          });
      
          displayOptions(searchOptions);
        });
      },   
    hide:function(parentElement){
        parentElement.classList.remove('show-dropdown');
    
        const dropdown = parentElement.querySelector('.dropdown-container');
        if (dropdown) {
            dropdown.remove(); // This removes the dropdown from the DOM
        }
    }
    
}

const address_options = {
    provinces : async function(parentElement){
        const data = await fetchGlobal.fetchGetData('https://psgc.cloud/api/provinces');
        dropdown.show(data,parentElement);
    },

    municipalities: async function(province_id,parentElement){
        const data = await fetchGlobal.fetchGetData(`https://psgc.cloud/api/provinces/${province_id}/cities-municipalities`);
        dropdown.show(data,parentElement);
    },

    baranggays: async function(municpality_id,parentElement){
        const data = await fetchGlobal.fetchGetData(`https://psgc.cloud/api/cities-municipalities/${municpality_id}/barangays`);
        dropdown.show(data,parentElement);
    }
}

const nationality_options = {
     country_nationality: async function(parentElement){
        const data = await fetchGlobal.fetchGetData('https://restcountries.com/v3.1/all');
        const countries = data.map(country => ({
            code: country.name?.common,
            name: country.demonyms?.eng?.m || "Not available"
          }));
        dropdown.show(countries,parentElement);
     },
     country: async function(parentElement){
        const data = await fetchGlobal.fetchGetData('https://restcountries.com/v3.1/all');
        const countries = data.map(country => ({
            code: country.demonyms?.eng?.m || "Not available",
            name: country.name?.common,
          }));
        dropdown.show(countries,parentElement);
     },

}




