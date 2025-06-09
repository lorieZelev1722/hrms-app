@php
    $user = session('user');
@endphp

<div class="add-new-employee-form">
    <h3>Work Informations</h3>
    <div class="add-new-employee-grid-container add-new-employee-flex-container">
   
    <!-- input list -->
    <div>
    <div class="add-new-employee-section jsWorkInfo"  data-id="workInfo">
    <span class="section-title">Work Infos</span>
    <span class="add-new-employee-btn employee-disable-btn">Save</span>
    <div class="add-new-employee-input-wrapper">
        <input type="hidden" name="addedbyID" value="{{$user['id']}}" required>
        <div class="add-new-employee-input-content jsDepartmentInput jsDropdown">
            <label>Department</label>
            <input type="text" name="department_id" placeholder="Department" required readonly>
        </div>
        <div class="add-new-employee-input-content jsEmploymentTypeInput jsDropdown">
            <label>Employment Type</label>
            <input type="text" name="employment_type" placeholder="Employment Type" required readonly>
        </div>
        <div class="add-new-employee-input-content">
            <label>Start Date</label>
            <input type="date" name="start_date" placeholder="Start Date" required>
        </div>
        <div class="add-new-employee-input-content jsJobStatusInput jsDropdown">
            <label>Job Status</label>
            <input type="text" name="status" placeholder="Job Status" required readonly>
        </div>
        <div class="add-new-employee-input-content jsSupervisorInput jsDropdown">
            <label>Supervisor</label>
            <input type="text" name="supervisor_id" placeholder="Supervisor" required readonly>
        </div>
        <div class="add-new-employee-input-content jsAssignedTeam jsDropdown">
            <label>Assign Team</label>
            <input type="text" name="team_id" placeholder="Team ID" readonly required/>     
        </div>
       
    </div>
</div>

    <!-- end -->

  
</div>

        <span class="employee-next-btn employee-disable-btn jsNextPage">Next</span>

</div>
</div>
