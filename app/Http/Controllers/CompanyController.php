<?php

namespace App\Http\Controllers;

use App\Model\Domain\DomainManagers\CompaniesManager;

class CompanyController extends Controller
{
    /*
     * Utiliza el Manager de empresas, para borrar la empresa seleccionada.
     */
    public function deleteCompany($id){
        $domainMannager = CompaniesManager::getInstance();
        $status = $domainMannager->delete($id);
        return redirect('companyList')->with('status', $status);
    }
}
