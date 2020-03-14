<?php

namespace Tenancy\Tests\Mocks\Tenants;

use Illuminate\Http\Request;
use Symfony\Component\Console\Input\InputInterface;
use Tenancy\Identification\Drivers\Console\Contracts\IdentifiesByConsole;
use Tenancy\Identification\Drivers\Http\Contracts\IdentifiesByHttp;
use Tenancy\Identification\Drivers\Queue\Contracts\IdentifiesByQueue;
use Tenancy\Testing\Mocks\Tenant;
use Tenancy\Identification\Contracts\Tenant as TenantContract;
use Tenancy\Identification\Drivers\Environment\Contracts\IdentifiesByEnvironment;
use Tenancy\Identification\Drivers\Queue\Events\Processing;

class NullMixedTenant extends Tenant implements IdentifiesByHttp, IdentifiesByConsole, IdentifiesByQueue, IdentifiesByEnvironment
{

    public function tenantIdentificationByHttp(Request $request): ?TenantContract
    {
        event('mock.tenant.identification.http', [
            'tenant' => $this
        ]);
        return null;
    }

    public function tenantIdentificationByQueue(Processing $event): ?TenantContract
    {
        event('mock.tenant.identification.queue', [
            'tenant' => $this
        ]);
        return null;
    }

    public function tenantIdentificationByConsole(InputInterface $input): ?TenantContract
    {
        event('mock.tenant.identification.console', [
            'tenant' => $this
        ]);
        return null;
    }

    public function tenantIdentificationByEnvironment(): ?TenantContract
    {
        event('mock.tenant.identification.environment', [
            'tenant' => $this
        ]);
        return null;
    }
}
