<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Domain\DomainManagers\CompaniesManager;

class CompanyController extends Controller
{
    public function deleteCompany($id){
        $domainMannager = CompaniesManager::getInstance();
        $status = $domainMannager->delete($id);
        return redirect('loadAccounts')->with('status', $status);
    }
}
