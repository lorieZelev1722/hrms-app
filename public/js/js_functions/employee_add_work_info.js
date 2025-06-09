
function EmployeeWorkInfo(employee_id){
  this.employee_id = employee_id;
  this.formdata = new FormData();
  this.departmentList = {};
  this.headList = {};
  this.teamList = {};
  this.employment_type = ['Full Time','Part-Time Employment','Temporary Employment','Contract Employment','Internships','Apprenticeship','Seasonal Employment','Remote Employment'];
  this.job_status = ['Active','On Leave','Probation','Terminated','Resigned','Retired','Suspended','Contract Ended','Pending Start','Pending Termination','Transferred','Deceased','Laid off'];
}

EmployeeWorkInfo.prototype.displayView = async function(){
    let contentWrapper = document.querySelector('.jsContentBody') || '';
    contentWrapper.innerHTML = '';

    await loader.start();
    const view = await fetchGlobal.fetchViewData('/new_employee_content_p3');
    const data = await fetchGlobal.fetchGetData('/department_list');
    this.departmentList = data.department_list || {};
    this.headList = data.head_list || {};
    this.teamList = data.team_list || {};

    const div = new DOMParser().parseFromString(view,'text/html').querySelector('.add-new-employee-form');
    
    this.handleDropdown(div);

    contentWrapper.appendChild(div);
    loader.stop();

    

}

EmployeeWorkInfo.prototype.handleDropdown = function(div){
    const departmentInput = div.querySelector('.jsDepartmentInput') || '';
    const employmentInput = div.querySelector('.jsEmploymentTypeInput') || '';
    const jobStatusInput = div.querySelector('.jsJobStatusInput') || '';
    const teamIDInput = div.querySelector('.jsAssignedTeam') || '';

    departmentInput.addEventListener('click',(e)=>{
        dropdown.show(this.departmentList,e.currentTarget);
    });

    employmentInput.addEventListener('click',(e)=>{
        dropdown.show(this.employment_type,e.currentTarget);
    });

    jobStatusInput.addEventListener('click',(e)=>{
        dropdown.show(this.job_status,e.currentTarget);
    });

    teamIDInput.addEventListener('click',(e)=>{
        dropdown.show(this.teamList,e.currentTarget);
    });
}


export default function displayEmployeeWorkInfo(employee_id){
    const cc = new EmployeeWorkInfo(employee_id);
    cc.displayView();

}