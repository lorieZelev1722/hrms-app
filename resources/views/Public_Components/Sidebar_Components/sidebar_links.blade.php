<div class="sidebar-content">
    @php
    $user = session('user');
     @endphp
                    <div class="sidebar-profile-wrapper">
                        <div class="sidebar-profile-image-wrapper">
                            <img src="{{ asset('images/user.png') }}" alt="default_user_image">
                        </div>
                        <span class="sidebar-profile-user-name">{{ $user['fullname'] }}
                            <p class="sidebar-profile-user-type">{{ $user['user_role'] }}</p>
                        
                        </span>
                        <span class="sidebar-close-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" id="Bold" viewBox="0 0 24 24"><path d="M14.121,12,18,8.117A1.5,1.5,0,0,0,15.883,6L12,9.879,8.11,5.988A1.5,1.5,0,1,0,5.988,8.11L9.879,12,6,15.882A1.5,1.5,0,1,0,8.118,18L12,14.121,15.878,18A1.5,1.5,0,0,0,18,15.878Z"/></svg>
                        </span>
                    </div>
                    <div class="sidebar-link-ul">

                                 
                    @foreach($user['permissions'] as $permission)
                         @if(!$permission['module'])
                            <a class="sidebar-link-li link-anchor" href="#" data-id="{{ $permission['id'] }}" data-url="{{$permission['route']}}">
                                <i>{!! $permission['icons'] !!}</i>
                                <span>{{ $permission['name'] }}</span>
                            </a>
                        @endif
                      
                    @endforeach
                    @foreach($user['module_labels'] as $label)
                            @switch($label['module'])
                                @case('employee')
                                    <a class="sidebar-link-li link-anchor sidebar-link-dropdown display-sidebar" href="#" data-type="employee">
                                        <i>
                                        <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24">
                                        <path d="m21,14.051v-.051c0-1.103-.897-2-2-2h-3c-1.103,0-2,.897-2,2v.051c-1.692.245-3,1.691-3,3.449v3c0,1.93,1.57,3.5,3.5,3.5h6c1.93,0,3.5-1.57,3.5-3.5v-3c0-1.758-1.308-3.204-3-3.449Zm0,6.449c0,.276-.224.5-.5.5h-6c-.276,0-.5-.224-.5-.5v-3c0-.276.224-.5.5-.5h1.5v.5c0,.829.671,1.5,1.5,1.5s1.5-.671,1.5-1.5v-.5h1.5c.276,0,.5.224.5.5v3Zm-12-8.5c3.309,0,6-2.691,6-6S12.309,0,9,0,3,2.691,3,6s2.691,6,6,6Zm0-9c1.654,0,3,1.346,3,3s-1.346,3-3,3-3-1.346-3-3,1.346-3,3-3Zm-.03,12.201c.165.812-.359,1.604-1.171,1.769-2.587.526-4.596,2.894-4.777,5.629-.052.793-.712,1.401-1.495,1.401-.997.029-1.553-.772-1.498-1.599.268-4.061,3.284-7.581,7.172-8.371.811-.163,1.604.359,1.769,1.171Z"/>
                                        </svg>
                                        </i>
                                        <span>Employees</span>
                                        <div class="sidebar-link-dropdown-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" id="Bold" viewBox="0 0 24 24">
                                                <path d="M6.414,9H17.586a1,1,0,0,1,.707,1.707l-5.586,5.586a1,1,0,0,1-1.414,0L5.707,10.707A1,1,0,0,1,6.414,9Z"/>
                                            </svg>
                                        </div>
                                    </a>
                                    @break
                            @endswitch
                    @endforeach


                      
                       
                    </div>
</div>

<script>
     const closeSideBarBtn = document.querySelector('.sidebar-close-btn');
     const dropdowns = document.querySelectorAll('.sidebar-link-dropdown');

     if(closeSideBarBtn){
    closeSideBarBtn.addEventListener('click',()=>{
            sideBar.close();
    });

    dropdowns.forEach((dropdown)=>{
        dropdown.addEventListener('click',(e)=>{
            e.preventDefault();
            let el = e.currentTarget;
            el.querySelector('.sidebar-link-dropdown-icon').classList.toggle('rotate-up');
            if(el.classList.contains('display-sidebar')){
                el.append(displayDropdown(el.dataset.type));
                el.classList.remove('display-sidebar');         
            }else{
                el.querySelector('.sidebar-link-dropdown-container').remove();
                el.classList.add('display-sidebar');

            }
 
        });
    });

    function displayDropdown(type){
        const dropdownContainer = document.createElement('div');
        dropdownContainer.classList.add('sidebar-link-dropdown-container');
        const {permissions} = @json($user);
        // console.log(permissions);
        let content = '<div class="sidebar-link-dropdown-content">';

        switch(type){
            
            case 'employee': 
                permissions.forEach(item=>{
                  if(item.module == 'employee'){
                    content += ` <a class="sidebar-link-li link-anchor" href="#" data-id="${item.id}" data-url=${item.route}>
                                <i>${item.icons}</i>
                                <span class="dropdown-li-span">${item.name}</span>
                            </a>`;
                  }
                });
            break;
            default:
            break;
        }

        content += '</div>';
        dropdownContainer.appendChild(new DOMParser().parseFromString(content,'text/html').querySelector('.sidebar-link-dropdown-content'));
        return dropdownContainer;
    }
  }
</script>