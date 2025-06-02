<nav>
            <div class="nav-menu-container" id="openSideBar">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512">
                    <g>
                        <path d="M480,224H32c-17.673,0-32,14.327-32,32s14.327,32,32,32h448c17.673,0,32-14.327,32-32S497.673,224,480,224z"/>
                        <path d="M32,138.667h448c17.673,0,32-14.327,32-32s-14.327-32-32-32H32c-17.673,0-32,14.327-32,32S14.327,138.667,32,138.667z"/>
                        <path d="M480,373.333H32c-17.673,0-32,14.327-32,32s14.327,32,32,32h448c17.673,0,32-14.327,32-32S497.673,373.333,480,373.333z"/>
                    </g>
                    </svg>
            </div>
            <span>HRMS-System</span>
            <a href="#" class="logout-icon-container jsLogoutUser">
                <svg xmlns="http://www.w3.org/2000/svg" id="Isolation_Mode" data-name="Isolation Mode" viewBox="0 0 24 24"><path d="M3,3H8V0H3A3,3,0,0,0,0,3V21a3,3,0,0,0,3,3H8V21H3Z"/><path d="M22.948,9.525,18.362,4.939,16.241,7.061l3.413,3.412L5,10.5,5,13.5l14.7-.027-3.466,3.466,2.121,2.122,4.587-4.586A3.506,3.506,0,0,0,22.948,9.525Z"/></svg>  
            </a>
</nav>

<script>
  let sideBarMenu = document.getElementById('openSideBar') || '';
  let logoutBtn = document.querySelector('.jsLogoutUser') || '';
 
  if(sideBarMenu){
    sideBarMenu.addEventListener('click',()=>{
            sideBar.open();
    });
  }

  if(logoutBtn){
    logoutBtn.addEventListener('click',(e)=>{
        e.preventDefault();
        alert.alert_with_link('alert-warning','Click continue to logout','/logout');
    });
  }

 

</script>