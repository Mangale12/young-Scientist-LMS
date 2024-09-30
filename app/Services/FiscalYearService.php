<?php

namespace App\Services;
use App\Models\FiscalYear;
class FiscalYearService
{
    public function getAll()
    {
        return FiscalYear::all();
    }

    public function getById($id)
    {
        return FiscalYear::findOrFail($id);
    }

    public function create(array $data)
    {
        try{
            return FiscalYear::create($data);
        }
        catch (Exception $e) {
            return false;
        }
        
    }

    public function update($id, array $data)
    {
        $fiscalYear = $this->getById($id);
        $fiscalYear->update($data);
        return $fiscalYear;
    }

    public function delete($id)
    {
        $fiscalYear = $this->getById($id);
        $fiscalYear->delete();
        return true;
    }
}
