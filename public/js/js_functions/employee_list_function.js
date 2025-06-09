function EmployeeList(){
   this.employee_list = {};
   this.department = '';
   this.obj = {};
   this.searchbydepartment = [];
   this.search_employeelist = {};
  
}

EmployeeList.prototype.displayView = async function(){
    let contentWrapper = document.querySelector('.jsContentBody') || '';
  
    await loader.start();
    const view = await fetchGlobal.fetchViewData('/employee_view_content') || '';
    const {data}= await fetchGlobal.fetchGetData('/employee_list_data') || '';
    const div = new DOMParser().parseFromString(view,'text/html').querySelector('.employee-wrapper-container');
     
    if(data){
      this.employee_list = data.employee_list;
      this.department = data.departments;
      this.obj = data.department.department_list.map(item => ({
        id: item.id,
        name: item.name
    }));
     
    }


    
    contentWrapper.innerHTML = '';
    contentWrapper.appendChild(div);
    this.handleEvents(div);   
    this.displayData();
    loader.stop();
}

EmployeeList.prototype.displayData = function(){
  const container = document.querySelector('.jsEmployeeTable') || '';
  const totalWrapper = document.querySelector('.jsTotalWrapper') || '';
  container.innerHTML = ''; totalWrapper.innerHTML = '';

  totalWrapper.innerHTML = `
  <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24"><path d="M12,17a4,4,0,1,1,4-4A4,4,0,0,1,12,17Zm6,4a3,3,0,0,0-3-3H9a3,3,0,0,0-3,3v3H18ZM18,8a4,4,0,1,1,4-4A4,4,0,0,1,18,8ZM6,8a4,4,0,1,1,4-4A4,4,0,0,1,6,8Zm0,5A5.968,5.968,0,0,1,7.537,9H3a3,3,0,0,0-3,3v3H6.349A5.971,5.971,0,0,1,6,13Zm11.651,2H24V12a3,3,0,0,0-3-3H16.463a5.952,5.952,0,0,1,1.188,6Z"/></svg>
  ${this.employee_list.length}
  `;
  if(this.employee_list.length > 0){
  this.employee_list.forEach((item)=>{
      container.appendChild(this.parseContentItem(item));
  })
  }else{
    container.innerHTML = `<span class="no-data-found">No Data</span>`;
  }


}

EmployeeList.prototype.displayDataSearch = function(){
  const container = document.querySelector('.jsEmployeeTable') || '';
  const totalWrapper = document.querySelector('.jsTotalWrapper') || '';
  container.innerHTML = ''; totalWrapper.innerHTML = '';

  totalWrapper.innerHTML = `
  <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24"><path d="M12,17a4,4,0,1,1,4-4A4,4,0,0,1,12,17Zm6,4a3,3,0,0,0-3-3H9a3,3,0,0,0-3,3v3H18ZM18,8a4,4,0,1,1,4-4A4,4,0,0,1,18,8ZM6,8a4,4,0,1,1,4-4A4,4,0,0,1,6,8Zm0,5A5.968,5.968,0,0,1,7.537,9H3a3,3,0,0,0-3,3v3H6.349A5.971,5.971,0,0,1,6,13Zm11.651,2H24V12a3,3,0,0,0-3-3H16.463a5.952,5.952,0,0,1,1.188,6Z"/></svg>
  ${this.employee_list.length} / ${this.search_employeelist.length}
  `;

  if(this.search_employeelist.length > 0){
  this.search_employeelist.forEach((item)=>{
      container.appendChild(this.parseContentItem(item));
  })
  }else{
    container.innerHTML = `<span class="no-data-found">No Employee Found</span>`;
  }


}

EmployeeList.prototype.parseContentItem = function(item){
  const div = `
  <div class="employee-list-tr">
      <div class="employee-image-profile">
          <img src="/images/employee.png" alt="employee">
      </div>
      <span class="employee-name-container">
        ${item.firstname+' '+item.lastname}
          <small>${item.department_name || 'Not Assigned'}</small>
      </span>
      <small></small>
      <div class="employee-view-info jsEmployeeBtn close-dropdown" data-id="${item.id}">
              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
              <g>
                  <circle cx="256" cy="53.333" r="53.333"/>
                  <circle cx="256" cy="256" r="53.333"/>
                  <circle cx="256" cy="458.667" r="53.333"/>
              </g>
              </svg>
      </div>
  </div>`;

  let parseItem = new DOMParser().parseFromString(div,'text/html').querySelector('.employee-list-tr');
  this.handleDropdownEditandViewWrapper(parseItem);
  return parseItem;

}

EmployeeList.prototype.handleDropdownEditandViewWrapper = function(div){
  const employeeBtn = div.querySelector('.jsEmployeeBtn') || '';

  if(employeeBtn){
    employeeBtn.addEventListener('click',(e)=>{
      const el = e.currentTarget;
      const div = document.createElement('div');
      const content_div = document.createElement('template');
  
      if(el.classList.contains('close-dropdown')){
          div.classList.add('dropdown-container');
          content_div.innerHTML = `
              <a class="dropdown-link-li dropdown-plain-link-li" href="/">
              <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24">
                <path d="M21,11h-5c-1.654,0-3,1.346-3,3v7c0,1.654,1.346,3,3,3h5c1.654,0,3-1.346,3-3v-7c0-1.654-1.346-3-3-3Zm-1,9h-3c-.553,0-1-.448-1-1s.447-1,1-1h3c.553,0,1,.448,1,1s-.447,1-1,1Zm0-4.003h-3c-.553,0-1-.448-1-1s.447-1,1-1h3c.553,0,1,.448,1,1s-.447,1-1,1ZM3,6C3,2.691,5.691,0,9,0s6,2.691,6,6-2.691,6-6,6S3,9.309,3,6ZM12.026,24H1c-.557,0-1.001-.46-1-1.017,.009-4.955,4.043-8.983,9-8.983h0c.688,0,1.356,.085,2,.232v6.768c0,1.13,.391,2.162,1.026,3Z"/>
              </svg>
              <span>View Details</span>
              </a>
              <a class="dropdown-link-li dropdown-plain-link-li" href="/">
              <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24"><path d="M9,12c3.309,0,6-2.691,6-6S12.309,0,9,0,3,2.691,3,6s2.691,6,6,6Zm0-9c1.654,0,3,1.346,3,3s-1.346,3-3,3-3-1.346-3-3,1.346-3,3-3Zm2,14.341c-.64-.226-1.313-.341-2-.341-3.16,0-5.796,2.459-6.003,5.599-.052,.793-.711,1.401-1.495,1.401-.033,0-.066,0-.1-.003-.827-.054-1.453-.769-1.398-1.595,.31-4.711,4.262-8.401,8.997-8.401,1.029,0,2.038,.172,3,.513,.781,.276,1.19,1.133,.914,1.914-.276,.781-1.132,1.19-1.914,.914Zm12.26-1.325l-6.715,6.715c-.813,.813-1.915,1.269-3.064,1.269h-.955c-.276,0-.5-.224-.5-.5v-.955c0-1.149,.457-2.252,1.269-3.064l6.808-6.808c.953-.953,2.534-.894,3.409,.176,.761,.93,.598,2.317-.252,3.167Z"/></svg>
              <span>Edit Details</span>
              </a>
          `;
  
          div.appendChild(content_div.content.cloneNode(true));
          el.appendChild(div);
          el.classList.remove('close-dropdown');
      }else{
          el.classList.add('close-dropdown');
          el.querySelector('.dropdown-container').remove();
      }
      
    });
  }
  
  
}



EmployeeList.prototype.handleEvents = function(div){
  const filterBtn = div.querySelector('.jsSearchByDepartment') || '';
  const searchInput = div.querySelector('.jsSearchEmployee') || '';
 
    if(filterBtn){
          filterBtn.addEventListener('click',(e)=>{
              const el = e.currentTarget;
              dropdown_filter.show(this.obj,(result)=>{
                 this.searchbydepartment = result;
                  console.log(this.searchbydepartment);
              });
            
          });
      }

    if(searchInput){
          searchInput.addEventListener('input',(e)=>{
              this.search_employeelist = {}; let el=e.currentTarget;
              this.search_employeelist = this.employee_list.filter((employee)=>{
                let firstName = employee.firstname.toLowerCase().indexOf(el.value.toLowerCase())>= 0;
                let lastName = employee.lastname.toLowerCase().indexOf(el.value.toLowerCase())>=0;

                return firstName || lastName;
              });

              if(this.search_employeelist){
                  this.displayDataSearch();
              }
          });

         
    }



}





// }


export default function displayEmployeeList(){
  const cc = new EmployeeList();
  cc.displayView();

}