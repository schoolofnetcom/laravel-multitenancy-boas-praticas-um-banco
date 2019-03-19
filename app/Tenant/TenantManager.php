<?php
declare(strict_types=1);

namespace App\Tenant;


use App\Models\Company;
use Illuminate\Database\Schema\Blueprint;

class TenantManager
{
    private $tenant;
    private static $tenantTable = 'companies';
    private static $tenantField = 'company_id';
    private static $tenantModel = Company::class;

    /**
     * @return string
     */
    public function getTenantTable(): string
    {
        return self::$tenantTable;
    }

    /**
     * @return string
     */
    public function getTenantField(): string
    {
        return self::$tenantField;
    }

    /**
     * @return string
     */
    public function getTenantModel(): string
    {
        return self::$tenantModel;
    }

    /**
     * @return Company
     */
    public function getTenant(): ?Company //null or Company
    {
        return $this->tenant;
    }

    /**
     * @param Company $tenant
     */
    public function setTenant(?Company $tenant): void
    {
        $this->tenant = $tenant;
    }

    public function bluePrintMacros()
    {
        Blueprint::macro('tenant', function(){
            $this->integer(\Tenant::getTenantField())->unsigned();
            $this
                ->foreign(\Tenant::getTenantField())
                ->references('id')
                ->on(\Tenant::getTenantTable());
        });
    }

    public function ruleExists(){
        return "{$this->getTenantField()},{$this->getTenant()->id}";
    }
}