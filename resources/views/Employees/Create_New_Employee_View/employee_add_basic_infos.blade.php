@php
    $user = session('user');
@endphp

<div class="add-new-employee-form">
    <h3>Employee Basic Infos</h3>
    <div class="add-new-employee-grid-container">
    <div class="add-new-employee-img-content">
        <input type="file" name="employee_img" accept="image/*" value="">
        <img src="" alt="uploaded employee image" >
        <label>
            <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24">
            <path d="m12,21c0,.553-.448,1-1,1h-6c-2.757,0-5-2.243-5-5V5C0,2.243,2.243,0,5,0h12c2.757,0,5,2.243,5,5v6c0,.553-.448,1-1,1s-1-.447-1-1v-6c0-1.654-1.346-3-3-3H5c-1.654,0-3,1.346-3,3v6.959l2.808-2.808c1.532-1.533,4.025-1.533,5.558,0l5.341,5.341c.391.391.391,1.023,0,1.414-.195.195-.451.293-.707.293s-.512-.098-.707-.293l-5.341-5.341c-.752-.751-1.976-.752-2.73,0l-4.222,4.222v2.213c0,1.654,1.346,3,3,3h6c.552,0,1,.447,1,1ZM15,3.5c1.654,0,3,1.346,3,3s-1.346,3-3,3-3-1.346-3-3,1.346-3,3-3Zm0,2c-.551,0-1,.448-1,1s.449,1,1,1,1-.448,1-1-.449-1-1-1Zm8,12.5h-3v-3c0-.553-.448-1-1-1s-1,.447-1,1v3h-3c-.552,0-1,.447-1,1s.448,1,1,1h3v3c0,.553.448,1,1,1s1-.447,1-1v-3h3c.552,0,1-.447,1-1s-.448-1-1-1Z"/>
            </svg>
        </label>
        <small>Employee Photo</small>
    </div>
    <!-- input list -->
    <div>
    <div class="add-new-employee-section jsPersonalInfo"  data-id="personalInfo">
    <span class="section-title">Personal Infos</span>
    <span class="add-new-employee-btn employee-disable-btn">Save</span>
    <div class="add-new-employee-input-wrapper">
        <input type="hidden" name="addedbyID" value="{{$user['id']}}" required>
        <div class="add-new-employee-input-content">
            <label>First Name</label>
            <input type="text" name="firstname" placeholder="Firstname" required>
        </div>
        <div class="add-new-employee-input-content">
            <label>Middle Name (not required)</label>
            <input type="text" name="middlename" placeholder="Middlename">
        </div>
        <div class="add-new-employee-input-content">
            <label>Last Name</label>
            <input type="text" name="lastname" placeholder="LastName" required>
        </div>
        <div class="add-new-employee-input-content">
            <label>Suffix (not required)</label>
            <input type="text" name="suffix" placeholder="Suffix">
        </div>
        <div class="add-new-employee-input-content">
            <label>Birthdate</label>
            <input type="date" name="birthdate" placeholder="Birthdate" required>
        </div>
        <div class="add-new-employee-input-content jsGenderInput jsDropdown">
            <label>Gender</label>
            <input id="gender" name="gender" placeholder="Gender" readonly required/>     
        </div>
        <div class="add-new-employee-input-content jsStatusInput jsDropdown">
            <label>Civil Status</label>
            <input id="civil_status" name="civil_status" placeholder="Status" readonly required/>     
        </div>
        <div class="add-new-employee-input-content jsNationalityInput jsDropdown">
            <label>Nationality</label>
            <input id="nationality" name="nationality" placeholder="Nationality" required/>     
        </div>
    
    </div>
</div>

    <!-- end -->

     <!-- input list -->
     <div class="add-new-employee-section jsContactInfo"  data-id="contactInfo">
    <span class="section-title">Contact Infos</span>
    <span class="add-new-employee-btn employee-disable-btn">Save</span>
    <div class="add-new-employee-input-wrapper">
        <input type="hidden" name="addedbyID" value="{{$user['id']}}" required>
        <div class="add-new-employee-input-content">
            <label>Mobile Number</label>
            <input type="number" name="mobile_no" placeholder="Mobile Number" required>
        </div>
        <div class="add-new-employee-input-content">
            <label>Landline Number (not required)</label>
            <input type="number" name="landline_no" placeholder="Mobile Number">
        </div>
        <div class="add-new-employee-input-content">
            <label>Email Address</label>
            <input type="email" name="email_address" placeholder="Email" required>
        </div>
      
    </div>
</div>

    <!-- end -->

      <!-- input list -->
    <div class="add-new-employee-section jsAddressInfo"  data-id="addressInfo">
            <span class="section-title">Address Infos</span>
            <span class="add-new-employee-btn employee-disable-btn">Save</span>
        <div class="add-new-employee-input-wrapper">   
            <input type="hidden" name="addedbyID" value="{{$user['id']}}" required>
            <div class="add-new-employee-input-content jsDropdown">
                    <label>Country</label>
                    <input type="text" name="country" placeholder="Country"  data-type="country" required>
            </div>
            <div class="add-new-employee-input-content jsDropdown">
                    <label>Zipcode</label>
                    <input type="text" name="zipcode" placeholder="Zipcode"  data-type="zipcode" required>
            </div>
            <div class="add-new-employee-input-content jsDropdown">
                    <label>Province</label>
                    <input type="text" name="province" placeholder="Province"  data-type="province" required>
            </div>
            <div class="add-new-employee-input-content jsDropdown" >
                    <label>Municipality/City</label>
                    <input type="text" name="town" placeholder="Municipality/City" data-type="town" required>
            </div>
            <div class="add-new-employee-input-content jsDropdown">
                    <label>Baranggay</label>
                    <input type="text" name="baranggay" placeholder="Baranggay" data-type="baranggay" required>
            </div>
            <div class="add-new-employee-input-content">
                    <label>Current Address</label>
                    <input type="text" name="current_address" placeholder="Current Address" required>
            </div>
            <div class="add-new-employee-input-content">
                    <label>Temporary Address (not required)</label>
                    <input type="text" name="temporary_address" placeholder="Temporary Address">
            </div>
       
        </div>
    </div>

    <!-- end -->


</div>

        <span class="employee-next-btn employee-disable-btn jsNextPage">Next</span>

</div>
</div>
