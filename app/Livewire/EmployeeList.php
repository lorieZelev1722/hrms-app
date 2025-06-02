<?php

namespace App\Livewire;

use Livewire\Component;

class EmployeeList extends Component
{
    public $employee_list;
    public $result;
    public $searchValue;
    public $searched_list;

    public function mount($employee_list,$result)
    {
        $this->employee_list = $employee_list;
        $this->searched_list = $this->employee_list;
        $this->result = $result;
    }

    public function render()
    {
        return view('livewire.employee_list');
    }

    public function sample(){
        dd($searchValue);
    }

    public function searchEmployee(){
       
    }

  
}
