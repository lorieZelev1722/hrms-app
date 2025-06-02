import displayLoginForm from "../../public/js/js_functions/login_function";
import displayDashboard from "../../public/js/js_functions/dashboard_function";
import displayEmployeeList from "../../public/js/js_functions/employee_list_function";
import displayAddNewEmployeeView from "../../public/js/js_functions/employee_add_function";




document.addEventListener("DOMContentLoaded",async function() {
    let url = window.location.pathname;
    let links = document.querySelectorAll('.link-anchor') || '';
    let dropdownlinks = document.querySelectorAll('.sidebar-link-dropdown') || '';
   
    links.forEach((link)=>{
            if(url === link.dataset.url) link.classList.add('active-link-li');
            
            link.addEventListener('click',async (e)=>{
                e.preventDefault();
                const el = e.currentTarget;
                if(el.dataset.url){
                links.forEach((l) => l.classList.remove('active-link-li'));
                el.classList.add('active-link-li');
                await RedirectUrlAndGetView(el.dataset.url);
                }
            });
    });

    dropdownlinks.forEach((link)=>{
        link.addEventListener('click',(e)=>{
            const el = e.currentTarget;
            const urlLinks = el.querySelectorAll('.link-anchor') || '';
            urlLinks.forEach((item)=>{
                item.addEventListener('click',async (e)=>{
                    e.preventDefault();
                    const el = e.currentTarget;
                    links.forEach((l) => l.classList.remove('active-link-li'));
                    urlLinks.forEach((l) => l.classList.remove('active-link-li'));
                    link.classList.add('active-link-li');                
                    await RedirectUrlAndGetView(el.dataset.url);
                });
                
            });
        });
       
    });
    
   
    await RedirectUrlAndGetView(url); 
     
  });

  
  async function RedirectUrlAndGetView(url){
    window.history.pushState({}, '', url);


    switch(url){
    
        case '/login':
            try{
                displayLoginForm();
                }catch(error){
                await fetchGlobal.fetchViewData('/403') || '';
                }
        break;
        case '/dashboard':
            try{
                displayDashboard();
                sideBar.close();
                }catch(error){
                   await fetchGlobal.fetchViewData('/403') || '';
                }
        break;
        case '/employee/employee_list':
            try{
                displayEmployeeList();
                 sideBar.close();
                }catch(error){
                   await fetchGlobal.fetchViewData('/403') || '';
                }           
        break;
        case '/employee/add_employee':
            try{
                displayAddNewEmployeeView();
                sideBar.close();
            }catch(error){
                await fetchGlobal.fetchViewData('/403') || '';
             }   
        default:
            console.log("no view yet");

    }
  }
